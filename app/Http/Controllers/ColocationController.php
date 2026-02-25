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
        return view('colocation.colocation');
    }

    public function store(Request $request){

        $request->validate([
            'colocName' => ['required','string', 'max:255']
        ]);

        $hasActiveMembership = Membership::where('user_id', Auth::id())->whereNull('left_at')->exists();

        if ($hasActiveMembership) {
            return back()->with('error', 'You are already in an active colocation.');
        }

        DB::transaction(function () use ($request) {

            $coloc = Colocation::create([
                'name' => $request->colocName,
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