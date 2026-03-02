<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\ExpenseDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ColocationMemberController extends Controller
{

    public function destroy(Colocation $colocation, User $user)
    {
        $authUser = Auth::user();


        $role = $colocation->memberships()
            ->where('user_id', $authUser->id)
            ->whereNull('left_at')
            ->value('role');

        if ($role !== 'owner') {
            abort(403, 'Only owner can remove members.');
        }

        if ($user->id === $authUser->id) {
            abort(403, 'Owner cannot remove himself.');
        }

        DB::transaction(function () use ($colocation, $user, $authUser) {


            $debts = ExpenseDetail::with('expense')
                ->where('status', 'unpaid')
                ->whereHas('expense', function ($q) use ($colocation) {
                    $q->where('colocation_id', $colocation->id);
                })
                ->get()
                ->filter(function ($debt) use ($user) {
                    return $debt->debtor_id == $user->id
                        || $debt->expense->payer_id == $user->id;
                });

            foreach ($debts as $debt) {

                // Removed Émember was debtor
                if ($debt->debtor_id === $user->id) {
                    $debt->debtor_id = $authUser->id;
                    $debt->save();
                }

                // Removed member was payer
                if ($debt->expense->payer_id === $user->id) {
                    $expense = $debt->expense;
                    $expense->payer_id = $authUser->id;
                    $expense->save();
                }
            }

            $colocation->memberships()
                ->where('user_id', $user->id)
                ->update([
                    'left_at' => now()
                ]);
        });

        return back()->with('success', 'Member removed and debts transferred to owner.');
    }

}