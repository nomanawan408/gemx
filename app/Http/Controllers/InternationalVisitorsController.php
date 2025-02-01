<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class InternationalVisitorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
     {
         $users = User::role('international_visitor')->orderByDesc('id')->get();
         return view('international_visitors.index', compact('users'));
     }
 
     public function create()
     {
         return view('international_visitors.create');
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
