<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HospitalityDepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hospitality = User::role('hospitality')->get(); // Fetch users with 'buyer' role
        return view('hospitalities.index', compact('hospitality'));
    }

    public function create()
    {
        return view('hospitalities.create');
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
