<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\ExpenseDetail;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ColocationController extends Controller
{
    public function colocation()
    {
        $user = Auth::user();

        $colocations = $user->colocations()
            ->wherePivotNull('left_at')
            ->withCount([
                'memberships as active_members_count' => function ($query) {
                    $query->whereNull('left_at');
                },
                'expenses'
            ])
            ->get();

        return view('colocation.colocation', compact('colocations'));
    }

    public function show(Colocation $colocation)
    {
        if (
            !$colocation->memberships()
                ->where('user_id', Auth::id())
                ->whereNull('left_at')
                ->exists()
        ) {

            abort(403);
        }

        $expensesQuery = $colocation->expenses()->with(['payer', 'category']);

        if ($month = request('monthFilter')) {
            [$year, $monthNum] = explode('-', $month);
            $expensesQuery->whereYear('date', $year)
                ->whereMonth('date', $monthNum);
        }

        $expenses = $expensesQuery->get();

        $colocation->load([
            'categories',
            'memberships' => function ($q) {
                $q->whereNull('left_at');
            }
        ]);

        $totalExpenses = $colocation->expenses()->sum('amount');

        //user balance
        $user = Auth::user();

        $details = ExpenseDetail::with('expense')
            ->whereHas('expense', function ($q) use ($colocation) {
                $q->where('colocation_id', $colocation->id);
            })
            ->get();

        $balance = 0;

        foreach ($details as $detail) {
            $expense = $detail->expense;

            if ($expense->payer_id == $user->id) {
                // Others owe him
                if ($detail->debtor_id != $user->id) {
                    $balance += $detail->amount;
                }
            }

            if ($detail->debtor_id == $user->id && $expense->payer_id != $user->id) {
                // He owes others
                $balance -= $detail->amount;
            }
        }


        $members = $colocation->memberships()
            ->with('user')
            ->get()
            ->pluck('user', 'user_id');


        $details = ExpenseDetail::with(['expense.payer', 'debtor'])
            ->whereHas('expense', function ($q) use ($colocation) {
                $q->where('colocation_id', $colocation->id);
            })
            ->where('status', 'unpaid')
            ->get();

        $balances = [];

        foreach ($details as $detail) {

            $payerId = $detail->expense->payer_id;
            $debtorId = $detail->debtor_id;
            $amount = $detail->amount;

            // Skip if it doesn't involve me
            if ($payerId != $user->id && $debtorId != $user->id) {
                continue;
            }

            $otherUserId = $payerId == $user->id ? $debtorId : $payerId;

            if (!isset($balances[$otherUserId])) {
                $balances[$otherUserId] = 0;
            }

            if ($payerId == $user->id) {
                // They owe me
                $balances[$otherUserId] += $amount;
            } else {
                // I owe them
                $balances[$otherUserId] -= $amount;
            }
        }



        return view('colocation.coloc_detail', compact(
            'colocation',
            'totalExpenses',
            'expenses',
            'balance',
            'members',
            'balances',
        ));
    }

    public function colocDetail()
    {
        return view('colocation.coloc_detail');
    }

    public function store(Request $request)
    {

        $request->validate([
            'colocName' => ['required', 'string', 'max:255'],
        ]);

        $hasActiveMembership = Membership::where('user_id', Auth::id())->whereNull('left_at')->exists();

        if ($hasActiveMembership) {
            return back()->with('error', 'You are already in an active colocation.');
        }

        DB::transaction(function () use ($request) {

            $coloc = Colocation::create([
                'title' => $request->colocName,
                'description' => $request->description,
                'status' => 'active',
            ]);

            Membership::create([
                'user_id' => Auth::id(),
                'colocation_id' => $coloc->id,
                'role' => 'owner',
            ]);
        });

        return redirect()->route('colocations')
            ->with('success', 'Colocation created successfully.');
    }

}