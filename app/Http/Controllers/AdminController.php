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
        return view('dashboard', compact('superadmins', 'buyer', 'visitor','international_visitor', 'exhibitor'));    }

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
