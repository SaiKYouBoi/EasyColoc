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
}