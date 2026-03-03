<?php

namespace App\Http\Controllers;

use App\Mail\ColocationInvitationMail;
use App\Models\Colocation;
use App\Models\Invitation;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    public function sendInvitation(Request $request, Colocation $colocation)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $membership = $colocation->memberships()
            ->where('user_id', Auth::user()->id)
            ->where('role', 'owner')
            ->first();

        if (!$membership) {
            abort(403, 'Only owner can invite members.');
        }

        $invitation = Invitation::create([
            'colocation_id' => $colocation->id,
            'email' => $request->email,
            'token' => Str::uuid()
        ]);


        Mail::to($request->email)
            ->send(new ColocationInvitationMail($invitation));

        return back()->with('success', 'Invitation sent successfully');
    }

    public function accept($token)
    {
        $invitation = Invitation::where('token', $token)->firstOrFail();


        Membership::create([
            'user_id' => Auth::user()->id,
            'colocation_id' => $invitation->colocation_id,
            'role' => 'member'
        ]);

        $invitation->delete();

        return redirect()->route('userdashboard')
            ->with('success', 'You joined the colocation!');
    }
}