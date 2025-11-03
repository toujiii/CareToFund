<?php

namespace App\Http\Controllers;

use App\Models\Charity;
use App\Models\Charity_Request;
use App\Models\User;
use App\Models\User_Notifications;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CharityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortby = $request->sort_by;
        $searchQuery = $request->search_query;
        $role = $request->role;

        if ($sortby) {
            $charities = Charity::with(['charity_request.user'])
                ->join('charity_requests', 'charities.request_id', '=', 'charity_requests.request_id')
                ->where('charity_status', $sortby)
                ->orderBy('charity_requests.approved_datetime', 'desc')
                ->select('charities.*')
                ->get();
        } elseif ($searchQuery) {
            $charities = Charity::with(['charity_request.user'])
                ->whereHas('charity_request.user', function ($query) use ($searchQuery) {
                    $query->where('name', 'like', '%' . $searchQuery . '%')
                        ->orWhere('title', 'like', '%' . $searchQuery . '%')
                        ->orWhere('description', 'like', '%' . $searchQuery . '%');
                })
                ->join('charity_requests', 'charities.request_id', '=', 'charity_requests.request_id')
                ->orderBy('charity_requests.approved_datetime', 'desc')
                ->select('charities.*')
                ->get();
        } else {
            $charities = Charity::with(['charity_request.user'])
                ->join('charity_requests', 'charities.request_id', '=', 'charity_requests.request_id')
                ->orderBy('charity_requests.approved_datetime', 'desc')
                ->select('charities.*')
                ->get();
        }

        if ($role == 'admin') {
            return view('includes.adminIncludes.adminSections.adminCharitiesResults', ['charities' => $charities]);
        } else if ($role == 'user') {
            return view('includes.userIncludes.charityPostCard', ['charities' => $charities]);
            // return response()->json(['message' => 'User charity loading not yet implemented.']);
        }
        
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
        try {

            DB::beginTransaction();

            $charityID = $request->charity_id;

            $charity = Charity::findOrFail($charityID);
            $charity->charity_status = Charity::STATUS_FINISHED;
            $charity->save();

            $user = User::findOrFail($request->user_id);
            $user->status = User::STATUS_OFFLINE;
            $user->save();

            DB::commit();

            return response()->json(['message' => "Charity status updated successfully. $charityID"], 200);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json(['message' => 'Failed to update charity status.'], 500);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Charity $charity)
    {
        //
    }

    public function cancelCharity(Request $request, $charityID)
    {
        try {

            DB::beginTransaction();

            $charity = Charity::with(['charity_request.user'])->find($charityID);

            if (!$charity) {
                return response()->json(['message' => 'Charity not found'], 404);
            }

            $charity->charity_status = Charity::STATUS_CANCELLED;
            $charity->save();

            $user = $charity->charity_request->user;
            $user->status = User::STATUS_NOTIFIED;
            $user->save();

            $notification = new User_Notifications();
            $notification->user_id = $user->id;
            $notification->title = 'Charity Cancelled';
            $notification->message = 'Your charity titled "' . $charity->charity_request->title . '" has been cancelled due to policy violations.';
            $notification->is_read = false;
            $notification->save();

            DB::commit();

            return redirect()->back()->with('success', 'Charity has been successfully cancelled.');

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()->with('error', 'An error occurred while cancelling the charity.');

        }

    }
}
