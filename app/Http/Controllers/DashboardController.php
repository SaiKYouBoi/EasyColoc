<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();


        $membership = $user->memberships()
            ->whereNull('left_at')
            ->with('colocation')
            ->first();

        $totalExpenses = 0;
        $recentExpenses = collect();
        $yourBalance = 0;
        $youOwe = 0;
        $youAreOwed = 0;
        $colocation = null;

        if ($membership) {

            $colocation = $membership->colocation;


            $totalExpenses = $colocation->expenses()->sum('amount');


            $recentExpenses = $colocation->expenses()
                ->with(['payer', 'category'])
                ->latest()
                ->take(5)
                ->get();


            $memberCount = $colocation->memberships()
                ->whereNull('left_at')
                ->count();

            $yourPaid = $colocation->expenses()
                ->where('payer_id', $user->id)
                ->sum('amount');

            $yourShare = $memberCount > 0 ? $totalExpenses / $memberCount : 0;

            $yourBalance = $yourPaid - $yourShare;

            $youOwe = $yourBalance < 0 ? abs($yourBalance) : 0;
            $youAreOwed = $yourBalance > 0 ? $yourBalance : 0;
        }

        return view('userdashboard', compact(
            'colocation',
            'totalExpenses',
            'recentExpenses',
            'yourBalance',
            'youOwe',
            'youAreOwed'
        ));
    }
}
