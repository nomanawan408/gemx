<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    //
    public function approveUser($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'approved';
        $user->save();
    
        // Send approval email
        \Mail::to($user->email)->send(new \App\Mail\UserApproved($user));
    
        return redirect()->back()->with('success', 'User approved successfully');
    }
    
    public function rejectUser($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'rejected';
        $user->save();
    
        // Send rejection email
        \Mail::to($user->email)->send(new \App\Mail\UserRejected($user));
    
        return redirect()->back()->with('success', 'User rejected successfully');    
    }
    
    
}
