<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\OnSpotUserRegistration;    

class OnspotEntryController extends Controller
{
    //
    
    public function index()
    {
        $users = User::role(['visitor', 'international_visitor'])->where('is_onspot', true)->get();
        return view('onspotentry.index', compact('users'));
    }

    public function create()
    {
        return view('onspotentry.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'father_first_name' => 'nullable|string|max:255',
            'father_last_name' => 'nullable|string|max:255',
            'gender' => 'required|string|max:255',
            'profession' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'cnic_passport_no' => 'required|string|max:50|unique:users,cnic_passport_no',
            'date_of_issue' => 'nullable|date',
            'date_of_expiry' => 'nullable|date|after_or_equal:date_of_issue',
            'user_type' => 'required|in:visitor,international_visitor',
        ]);

        // Check for unique username
        $username = $validated['first_name'] . '_' . $validated['last_name'];
        if (User::where('username', $username)->exists()) {
            return redirect()->back()
                ->withErrors(['first_name' => 'A user with this first and last name already exists, resulting in a duplicate username. Please modify the name.'])
                ->withInput();
        }

        // Create a new user
        $user = User::create([
            'username' => $username,
            'name' => $validated['first_name'] . ' ' . $validated['last_name'],
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'father_first_name' => $validated['father_first_name'] ?? null,
            'father_last_name' => $validated['father_last_name'] ?? null,
            'gender' => $validated['gender'],
            'profession' => $validated['profession'] ?? null,
            'address' => $validated['address'] ?? null,
            'country' => $validated['country'] ?? null,
            'city' => $validated['city'] ?? null,
            'phone' => $validated['phone'],
            'whatsapp' => $validated['whatsapp'] ?? null,
            'cnic_passport_no' => $validated['cnic_passport_no'],
            'date_of_issue' => $validated['date_of_issue'] ?? null,
            'date_of_expiry' => $validated['date_of_expiry'] ?? null,
            'is_onspot' => true,
            'status' => 'approved',
            'password' => bcrypt('password'), // Assign a default password or prompt the user to reset it later
        ]);

        // Assign the user_type role
        $user->assignRole($validated['user_type']);
        // Send the email
        // Mail::to($user->email)->send(new OnSpotUserRegistration($user));
        // Redirect with success message
        return redirect()->route('onspot-entry.index')->with('success', 'User created and role assigned successfully.');
    }


    public function show($id)
    {
        $onspotentry = \App\Models\OnspotEntry::find($id);
        return view('onspotentry.show',compact('onspotentry'));
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id); // Find the user by ID

            // Ensure you're not deleting a superadmin or any critical role (if necessary)
            if ($user->hasRole('superadmin')) {
                return redirect()->back()->withErrors(['error' => 'You cannot delete a superadmin user.']);
            }

            $user->delete(); // Delete the user

            return redirect()->route('users.index')->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            \Log::error('Error deleting user: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Something went wrong. Please try again later.']);
        }
    }

}
