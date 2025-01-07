<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\User;
use Carbon\Carbon;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->can('admin')) {
            $flights = Flight::with('user')->get();
        } else {
            $flights = Flight::where('user_id', $user->id)->with('user')->get();
        }
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
            'arrival_date_time' => 'required',
            'pickup_terminal' => 'required|string',
            'dropoff_terminal' => 'required|string',
        ]);

        $flight = Flight::create([
            'user_id' => $validated['user_id'],
            'arrival_date_time' => $validated['arrival_date_time'],
            'pickup_terminal' => $validated['pickup_terminal'],
            'dropoff_terminal' => $validated['dropoff_terminal'],
        ]);

        $flight->save();

        // Send Flight/ ticket uplaod  email
        // \Mail::to($user->email)->send(new \App\Mail\UserApproved($user));

        return redirect()->route('flight-details.index')->with('success', 'Flight created successfully.');
    }
    public function buyersDetails()
    {
        // Filter all flights for users with the "buyer" role
        $flights = Flight::whereHas('user', function ($query) {
            $query->whereHas('roles', function ($query) {
                $query->where('name', 'buyer');
            });
        })->with('user')->get();

        // Filter flights for today
        $todayFlights = Flight::whereHas('user', function ($query) {
            $query->whereHas('roles', function ($query) {
                $query->where('name', 'buyer');
            });
        })
        ->with('user')
        ->whereDate('arrival_date_time', Carbon::today())
        ->get();

        // Filter flights for this week
        $thisWeekFlights = Flight::whereHas('user', function ($query) {
            $query->whereHas('roles', function ($query) {
                $query->where('name', 'buyer');
            });
        })
        ->with('user')
        ->whereBetween('arrival_date_time', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->get();

        // Return the view with the data
        return view('flights.buyers', compact('flights', 'todayFlights', 'thisWeekFlights'));
    }
    
    public function visitorsDetails()
    {
         // Fetch all flights for users with the "international_visitor" role
        $flights = Flight::whereHas('user', function ($query) {
            $query->whereHas('roles', function ($query) {
                $query->where('name', 'international_visitor');
            });
        })->with('user')->get();


        // Filter today's flights
        $todayFlights = Flight::whereHas('user', function ($query) {
            $query->whereHas('roles', function ($query) {
                $query->where('name', 'international_visitor');
            });
        })
        ->with('user')
        ->whereDate('arrival_date_time', Carbon::today())
        ->get();

        // Filter this week's flights
        $thisWeekFlights = Flight::whereHas('user', function ($query) {
            $query->whereHas('roles', function ($query) {
                $query->where('name', 'international_visitor');
            });
        })
        ->with('user')
        ->whereBetween('arrival_date_time', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->get();

        // Return the view with the data
        return view('flights.visitors', compact('flights', 'todayFlights', 'thisWeekFlights'));
    }
    
    public function update(Request $request, Flight $flight)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'arrival_date_time' => 'required|date',
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
