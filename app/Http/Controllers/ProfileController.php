<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\UserParticipant;

class ProfileController extends Controller
{
    public function index($id = null)
    {
        $users = User::with('participant', 'exhibition')->get();
        $user = $id ? $users->firstWhere('id', $id) : $users->firstWhere('id', Auth::user()->id);
        if (Auth::user()->hasRole('exhibitor')) {
            $user->load('exhibition');
        }
        return view('profile.index', compact('user'));
    }

    public function personalProfile()
    {
        $user = Auth::user();
        return view('profile.personal_profile', compact('user'));
    }

}
