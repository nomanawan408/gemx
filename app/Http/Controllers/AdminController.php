<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $superadmins = User::role('superadmin')->get();
        $buyer = User::role('buyer')->get();
        $visitor = User::role('visitor')->get();
        $international_visitor = User::role('international_visitor')->get();
        $exhibitor = User::role('exhibitor')->get();

        $usersByCountry = User::select('country')
            ->selectRaw('COUNT(*) as count')
            ->whereHas('roles', function($query) {
                $query->whereNotIn('name', ['superadmin', 'hospitality', 'transport']);
            })
            ->groupBy('country')
            ->get()
            ->map(function($item) {
                $item->country_code = $this->getCountryCode($item->country);
                return $item;
            })
            ->sortByDesc('count')
            ->values();

            $recentUsers = User::whereDoesntHave('roles', function ($query) {
                $query->whereIn('name', ['superadmin', 'hospitality', 'transport','buyer_admin', 'exhibitor_admin', 'visitor_admin','sale_purchase_admin','onspot_admin']);
            })
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('dashboard', compact('recentUsers', 'usersByCountry','superadmins', 'buyer', 'visitor','international_visitor', 'exhibitor'));    
    }


    function getCountryCode($countryName)
    {
        $countries = [
            'United States' => 'US',
            'United Kingdom' => 'GB',
            'Pakistan' => 'PK',
            'France' => 'FR',
            'Germany' => 'DE',
            'China' => 'CN',
            'India' => 'IN',
            'United Arab Emirates' => 'AE',
            'Saudi Arabia' => 'SA',
            'Malaysia' => 'MY',
            'Italy' => 'IT',
            'Japan' => 'JP',
            'South Korea' => 'KR',
            'Russia' => 'RU',
            'Australia' => 'AU',
            'Canada' => 'CA',
            'Brazil' => 'BR',
            'South Africa' => 'ZA',
            'Singapore' => 'SG',
            'Thailand' => 'TH',
            'Turkey' => 'TR',
        ];

        // Convert to uppercase for compatibility with jVectorMap
        return $countries[$countryName] ?? 'PK'; // Default to Pakistan if country code not found
    }

    /**
     * Show the form for creating a new buyer.
     */

     
    public function create()
    {
        return view('buyers.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
