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

        //return back to route
        return redirect()->route('buyers.index')->with('success', 'User approved successfully');
    }

    public function rejectUser($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'rejected';
        $user->save();

    return redirect()->route('buyers.index')->with('success', 'User rejected successfully');    }
    
}
