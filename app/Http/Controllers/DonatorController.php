<?php

namespace App\Http\Controllers;

use App\Models\Donator;
use App\Models\Charity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonatorController extends Controller
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
        $user = $request->user();

        $donation = new Donator();

        $charity = Charity::findOrFail($request->input('charity_id'));

        // return response()->json('Donation received successfully.');
        try {

            DB::beginTransaction();

            $request->validate([
                'amount' => 'required|numeric|min:100|max:1000000',
                'is_anonymous' => 'nullable',
                'charity_id' => 'required|exists:charities,charity_id',
            ]);

            $donation->user_id = $user->id;
            $donation->charity_id = $request->input('charity_id');
            $donation->amount = $request->input('amount');
            $donation->is_anonymous = $request->input('is_anonymous');
            $donation->save();

            $charity->raised += $donation->amount;
            $charity->save();

            DB::commit();

            return response()->json('Donation received successfully.');
            // return response()->json($request->input('is_anonymous'));


        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json(['error' => 'An error occurred while processing your donation.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Donator $donator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donator $donator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Donator $donator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donator $donator)
    {
        //
    }
}
