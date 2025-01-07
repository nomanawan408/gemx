<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accommodation;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccommodationCreated;

class AccommodationController extends Controller
{
    //
    public function index()
    {
        $accommodations = Accommodation::all();
        return view('accommodations.index', compact('accommodations'));
    }

    public function create(Request $request)
    {
        $user = User::find($request->select_user);
        if (!$user) {
            return redirect()->route('accommodation.select_user')->with('error', 'User not found.');
        }
        return view('accommodations.create', compact('user'));
    }

    public function select_user(){
        $users = User::role('buyer')->get();    
        return view('accommodations.select_user', compact('users'));
    }

    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'hotel_name' => 'required|string|max:255',
            'room_no' => 'required|integer|min:1',
            'check_in_time' => 'nullable|date_format:H:i',
            'description' => 'nullable|string',
        ]);
    
        // Create the accommodation record
        $accommodation = Accommodation::create([
            'user_id' => $request->user_id,
            'hotel_name' => $request->hotel_name,
            'room_no' => $request->room_no,
            'check_in_time' => $request->check_in_time,
            'description' => $request->description,
        ]);

        // Send the email only if the user has the 'buyer' role
        if ($request->user()->hasRole('buyer')) {
            Mail::to($request->user()->email)->send(new AccommodationCreated($accommodation));
        }
    
        // Redirect to the index page with a success message
        return redirect()->route('accommodation.index')->with('success', 'Accommodation created successfully.');
    }

    public function show(Accommodation $accommodation)
    {
        return view('accommodation.show', compact('accommodation'));
    }

    public function edit(Accommodation $accommodation)
    {
        return view('accommodation.edit', compact('accommodation'));
    }

    public function update(Request $request, Accommodation $accommodation)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string',
            'total_rooms' => 'required|integer',
            'price_per_night' => 'required|numeric',
        ]);

        $accommodation->update($request->all());

        return redirect()->route('accommodation.index')->with('success', 'Accommodation updated successfully.');
    }

    public function destroy(Accommodation $accommodation)
    {
        $accommodation->delete();

        return redirect()->route('accommodation.index')->with('success', 'Accommodation deleted successfully.');
    }
}

