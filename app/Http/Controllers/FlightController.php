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

    public function create()
    {
        $users = User::all(); // Fetch users for dropdown
        return view('flights.create', compact('users'));
    }
    
    public function buyerSelection()
    {
        $buyers = User::role('buyer')->get();        
        return view('flights.select_buyer', compact('buyers'));    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'flight_arrival_date_time' => 'required|date',
            'pickup_terminal' => 'required|string',
            'dropoff_terminal' => 'required|string',
        ]);

        Flight::create($validated);

        return redirect()->route('flights.index')->with('success', 'Flight created successfully.');
    }
    public function buyersDetails()
    {
        $flights = Flight::with('user')->get();
        return view('flights.buyers', compact('flights'));
    }
    
    public function visitorsDetails()
    {
        $flights = Flight::with('user')->get();
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
