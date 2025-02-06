<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Crypt;
// use Endroid\QrCode\QrCode;
use BaconQrCode\Writer;
use Endroid\QrCode\Writer\PngWriter;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

use App\Models\User;


class InvitationController extends Controller
{
    //
    public function index(){
        $user = Auth::user();

        return view('invitation.index', compact('user'));
    }

    public function entryPass()
    {
        $user = Auth::user();
    
        // Ensure user has a UUID
        if (!$user->uuid) {
            $user->uuid = \Illuminate\Support\Str::uuid(); // Generate UUID if missing
            $user->save();
        }
    
        $options = new QROptions([
            'eccLevel' => QRCode::ECC_L,  // Low error correction level
            'outputType' => QRCode::OUTPUT_IMAGE_PNG, // Generate PNG output
            'imageBase64' => true // Convert to Base64 string
        ]);
    
        $qrCode = (new QRCode($options))->render(url('/entry-pass/' . $user->uuid));
    
        return view('entrypass.index', compact('user', 'qrCode'));
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
            return view('entrypass.verification', compact('user', 'company_name', 'role'));
    
        } catch (\Exception $e) {
            // Handle user not found or other errors
            abort(404, 'Invalid QR Code or User not found');
        }
    }
    
}
