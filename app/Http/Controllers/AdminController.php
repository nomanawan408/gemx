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
            ->get();

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
            'United States' => 'us',
            'United Kingdom' => 'gb',
            'Pakistan' => 'pk',
            'France' => 'fr',
            'Germany' => 'de',
            'China' => 'cn',
            'India' => 'in',
            // Add other countries as needed
        ];

        return $countries[$countryName] ?? null; // Return null if country not found
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
