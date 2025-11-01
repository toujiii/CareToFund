<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User_Notifications;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserNotifController extends Controller
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

        $userNotifContent = User_Notifications::with('user')->where('user_id', $request->user()->id)->orderBy('created_at', 'desc')->first();
        return view('includes.userIncludes.currentCharity.userNotif', ['userNotifContent' => $userNotifContent]);

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
       
    }

    public function markAsRead($notificationID, Request $request)
    {
        try {
            
            DB::beginTransaction();

            $user = $request->user();

            $notification = User_Notifications::with('user')->where('notif_id', $notificationID)->where('user_id', $user->id)->firstOrFail();

            $notification->is_read = true;
            $notification->save();

            $user->status = User::STATUS_OFFLINE;
            $user->save();

            DB::commit();

            return response()->json(['message' => 'Notification marked as read.'], 200);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json(['message' => 'An error occurred while marking the notification as read.'], 500);
        }
    }
}
