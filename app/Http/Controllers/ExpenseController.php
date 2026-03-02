<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\Expense;
use App\Models\ExpenseDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function store(Request $request ,Colocation $colocation)
    {
        $request->validate([
            'expenseTitle' => ['required', 'string', 'max:255'],

            'amount' => ['required', 'numeric', 'min:0.01'],

            'categoryId' => [
                'nullable',
                'exists:categories,id'
            ],

            'payerId' => [
                'required',
                'exists:users,id'
            ],

            'expenseDate' => [
                'required',
                'date'
            ],
        ]);

        $expense = Expense::create([
            'colocation_id' => $colocation->id,
            'payer_id' => $request->payerId,
            'category_id' => $request->categoryId,
            'title' => $request->expenseTitle,
            'amount' => $request->amount,
            'date' => $request->expenseDate,
        ]);

        $members = $colocation->memberships()->whereNull('left_at')->get();

        $splitAmount = $request->amount / $members->count();

        foreach ($members as $member) {
            ExpenseDetail::create([
                'expense_id' => $expense->id,
                'debtor_id' => $member->user_id,
                'amount' => $splitAmount,
                'status' => $member->user_id == $request->payerId ? 'paid' : 'unpaid',
            ]);
        }

        return redirect()->route('colocations.show', $colocation)->with('success', 'Expense created successfully.');
    }

    public function destroy(Colocation $colocation, Expense $expense)
    {
        if ($expense->colocation_id !== $colocation->id) {
            abort(404);
        }

        $role = $colocation->memberships()
            ->where('user_id', Auth::user()->id)
            ->whereNull('left_at')
            ->value('role');

        if ($role !== 'owner' && $expense->payer_id !== Auth::user()->id) {
            abort(403);
        }

        $expense->delete();
        return back()->with('success', 'Expense deleted permanently.');
    }

    public function show(Expense $expense)
    {
        $expense->load([
            'payer',
            'splits.debtor'
        ]);

        return view('expense.expense_detail', compact('expense'));
    }

    public function markPaid(ExpenseDetail $split)
    {
        $expense = $split->expense;

        $isOwner = Auth::user()->id === $expense->payer_id;
        $isSelf = Auth::user()->id === $split->debtor_id;

        if (!$isOwner && !$isSelf) {
            abort(403);
        }

        $split->update([
            'status' => 'paid'
        ]);

        return back()->with('success', 'Payment marked as paid.');
    }
}