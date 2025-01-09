<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\FlightCreated;
use Illuminate\Support\Facades\Response;


class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->can('admin')) {
            // Get all flights for admin
            $flights = Flight::with('user')->get();
        } else {
            // Get flights only for the authenticated user
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
        // Fetch buyers along with their single userParticipant
        $buyers = User::role('buyer')
            ->with('userParticipant') // Eager load the single userParticipant relationship
            ->get();
    
        return view('flights.select_buyer', compact('buyers'));
    }
    
     public function store(Request $request)
     {
         // Validate the incoming request data
         $validated = $request->validate([
             'user_id' => 'required|exists:users,id',
             'flight_no' => 'nullable|string',
             'airline_name' => 'nullable|string',
             'seat_no' => 'nullable|string',
             'no_of_persons' => 'nullable|integer',
             'ticket_upload' => 'nullable|file|mimes:jpeg,png,pdf', // Allow image or PDF files
             'departure_date_time' => 'nullable|date',
             'arrival_date_time' => 'required|date',
             'pickup_terminal' => 'required|string',
             'dropoff_terminal' => 'required|string',
         ]);
     
         // Handle file upload if ticket is provided
         $ticketPath = null;
         if ($request->hasFile('ticket_upload')) {
             $ticketPath = $request->file('ticket_upload')->store('uploads/tickets', 'public');
         }
     
         // Create the flight record
         $flight = Flight::create([
             'user_id' => $validated['user_id'],
             'flight_no' => $validated['flight_no'] ?? null,
             'airline_name' => $validated['airline_name'] ?? null,
             'seat_no' => $validated['seat_no'] ?? null,
             'no_of_persons' => $validated['no_of_persons'] ?? null,
             'ticket_upload' => $ticketPath,
             'departure_date_time' => $validated['departure_date_time'] ?? null,
             'arrival_date_time' => $validated['arrival_date_time'],
             'pickup_terminal' => $validated['pickup_terminal'],
             'dropoff_terminal' => $validated['dropoff_terminal'],
         ]);
     
         // Send notification email
         Mail::to($flight->user->email)->send(new FlightCreated($flight));
     
         // Redirect to the flight details page with a success message
         return redirect()->route('flight-details.buyers')->with('success', 'Flight created successfully.');
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

        return redirect()->route('flight-details.index')->with('success', 'Flight updated successfully.');
    }

    public function destroy(Flight $flight)
    {
        $flight->delete();
        return redirect()->route('flight-details.index')->with('success', 'Flight deleted successfully.');
    }



    public function exportBuyersCsv()
    {
        // Filter flights for buyers
        $flights = Flight::whereHas('user', function ($query) {
            $query->whereHas('roles', function ($query) {
                $query->where('name', 'buyer');
            });
        })->with('user')->get();

        // Define CSV header
        $csvHeader = [
            'Name', 'Email', 'Airline Name', 'Flight No', 'Seat No', 'Departure Date/Time', 
            'Arrival Date/Time', 'Ticket Link'
        ];

        // Generate CSV data rows
        $csvData = $flights->map(function ($flight) {
            $user = $flight->user;

            return [
                '"' . $user->name . '"', // Name
                '"' . $user->email . '"', // Email
                '"' . $flight->airline_name . '"', // Airline Name
                '"' . $flight->flight_no . '"', // Flight No
                '"' . $flight->seat_no . '"', // Seat No
                '"' . $flight->departure_date_time . '"', // Departure Date/Time
                '"' . $flight->arrival_date_time . '"', // Arrival Date/Time
                $flight->ticket_upload 
                    ? '"' . asset('storage/' . $flight->ticket_upload) . '"' // Ticket Link
                    : 'N/A', // Handle missing ticket upload
            ];
        });

        // Convert the header and data to a CSV string
        $csvContent = implode(',', $csvHeader) . "\n";
        foreach ($csvData as $row) {
            $csvContent .= implode(',', $row) . "\n";
        }

        // Use the response() helper to return the CSV file
        return response($csvContent, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="buyers_flight_details.csv"',
        ]);
    }
    
    public function exportVisitorsCsv()
    {
        // Filter flights for buyers
        $flights = Flight::whereHas('user', function ($query) {
            $query->whereHas('roles', function ($query) {
                $query->where('name', 'international_visitor');
            });
        })->with('user')->get();

        // Define CSV header
        $csvHeader = [
            'Name', 'Email', 'Airline Name', 'Flight No', 'Seat No', 'Departure Date/Time', 
            'Arrival Date/Time', 'Ticket Link'
        ];

        // Generate CSV data rows
        $csvData = $flights->map(function ($flight) {
            $user = $flight->user;

            return [
                '"' . $user->name . '"', // Name
                '"' . $user->email . '"', // Email
                '"' . $flight->airline_name . '"', // Airline Name
                '"' . $flight->flight_no . '"', // Flight No
                '"' . $flight->seat_no . '"', // Seat No
                '"' . $flight->departure_date_time . '"', // Departure Date/Time
                '"' . $flight->arrival_date_time . '"', // Arrival Date/Time
                $flight->ticket_upload 
                    ? '"' . asset('storage/' . $flight->ticket_upload) . '"' // Ticket Link
                    : 'N/A', // Handle missing ticket upload
            ];
        });

        // Convert the header and data to a CSV string
        $csvContent = implode(',', $csvHeader) . "\n";
        foreach ($csvData as $row) {
            $csvContent .= implode(',', $row) . "\n";
        }

        // Use the response() helper to return the CSV file
        return response($csvContent, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="buyers_flight_details.csv"',
        ]);
    }
}
