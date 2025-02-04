<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;


class InvitationController extends Controller
{
    //
    public function index(){
        return view('invitation.index');
    }

    public function entryPass(){
        $user = Auth::user();
        
        $qrCode = QrCode::size(100)->generate(url('/entry-pass/' . $user->uuid));

        return view('entrypass.index', compact('user','qrCode'));
    }

    public function entryPassShow($uuid)
    {
        try {
            // Find the user based on UUID
            $user = User::where('uuid', $uuid)->firstOrFail();
    
            // Get the company name, role, and other user details
            $company_name = $user->business->company_name ?? 'N/A'; // Handle if there's no associated business
            $role = $user->roles->first()->name ?? 'N/A'; // Handle if there's no role assigned
    
            // Just show the user details for testing
            return "
                User ID: {$user->id} <br>
                UUID: {$user->uuid} <br>
                Role: $role <br>
                Email: {$user->email} <br>
                Company Name: $company_name <br>
            ";
    
        } catch (\Exception $e) {
            // Handle user not found or other errors
            abort(404, 'Invalid QR Code or User not found');
        }
    }
    
}
