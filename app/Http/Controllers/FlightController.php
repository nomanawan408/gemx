<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\User;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flights = Flight::with('user')->get();
        return view('flights.index', compact('flights'));
    }

    public function create(Request $request)
    { 
        $user = User::role('buyer')->findOrFail($request->select_buyer); // Fetch users with buyer role for dropdown
        return view('flights.create', compact('user'));
    }

    public function selfcreate()
    { 
        $user = auth()->user();
        if (!$user->hasRole('international_visitor')) {
            return redirect()->route('flight-details.index')->with('error', 'You do not have permission to create a flight.');
        }
        return view('flights.create', compact('user'));
    }

    public function createflight(){
        $user = User::role('buyer')->get();        
        return view('flights.create', compact('user'));
    }
    
    public function buyerSelection()
    {
        $buyers = User::role('buyer')->get();        
        return view('flights.select_buyer', compact('buyers'));   
     }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'flight_arrival_date_time' => 'required|date',
            'pickup_terminal' => 'required|string',
            'dropoff_terminal' => 'required|string',
        ]);

        Flight::create($validated);

        return redirect()->route('flight-details.index')->with('success', 'Flight created successfully.');
    }
    public function buyersDetails()
    {
        $flights = Flight::whereHas('user', function ($query) {
            $query->whereHas('roles', function ($query) {
                $query->where('name', 'buyer');
            });
        })->with('user')->get();
    
        return view('flights.buyers', compact('flights'));
    }
    
    public function visitorsDetails()
    {
        $flights = Flight::whereHas('user', function ($query) {
            $query->whereHas('roles', function ($query) {
                $query->where('name', 'international_visitor');
            });
        })->with('user')->get();
        return view('flights.visitors', compact('flights'));
    }
    public function update(Request $request, Flight $flight)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'flight_arrival_date_time' => 'required|date',
            'pickup_terminal' => 'required|string',
            'dropoff_terminal' => 'required|string',
        ]);

        $flight->update($validated);

        return redirect()->route('flights.index')->with('success', 'Flight updated successfully.');
    }

    public function destroy(Flight $flight)
    {
        $flight->delete();

        return redirect()->route('flights.index')->with('success', 'Flight deleted successfully.');
    }
}
