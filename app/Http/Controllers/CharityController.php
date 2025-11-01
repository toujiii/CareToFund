<?php

namespace App\Http\Controllers;

use App\Models\Charity;
use App\Models\Charity_Request;
use Illuminate\Http\Request;

class CharityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Request $request)
    {
        if ($request->user()->role != 'admin') {

            $charityRequestID = Charity_Request::where('user_id', $request->user()->id)->orderBy('datetime', 'desc')->first()->request_id;

            $charity = Charity::with('charity_request')->where('request_id', $charityRequestID)->first();

            return view('includes.userIncludes.currentCharity.currentNewCharity', ['charity' => $charity]);

        }
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Charity $charity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Charity $charity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Charity $charity)
    {
        //
    }
}
