<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalColocations = Colocation::count();
        $totalExpenses = Expense::sum('amount');
        $activeBans = User::where('is_banned', true)->count();
        $users = User::latest()->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalColocations',
            'totalExpenses',
            'activeBans',
            'users'
        ));
    }

    public function ban(User $user)
    {
        if ($user->id === Auth::user()->id) {
            return back()->with('error', 'You cannot ban yourself.');
        }
        
        $user->update([
            'is_banned' => true
        ]);

        return back()->with('success', 'User banned successfully');
    }

    public function unban(User $user)
    {
        $user->update([
            'is_banned' => false
        ]);

        return back()->with('success', 'User unbanned successfully');
    }
}