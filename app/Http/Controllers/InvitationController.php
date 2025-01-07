<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{
    //
    public function index(){
        return view('invitation.index');
    }

    public function entryPass(){
        $user = Auth::user();
        return view('entrypass.index', compact('user'));
    }
}
