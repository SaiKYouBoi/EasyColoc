<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
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

        $colocation->load([
            'categories',
            'expenses.payer',
            'expenses.category',
            'memberships' => function ($q) {
                $q->whereNull('left_at');
            }
        ]);

        $totalExpenses = $colocation->expenses()->sum('amount');

        return view('colocation.coloc_detail', compact(
            'colocation',
            'totalExpenses'
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
