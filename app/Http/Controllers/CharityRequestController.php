<?php

namespace App\Http\Controllers;

use App\Models\Charity;
use App\Models\Charity_Request;
use App\Models\User_Notifications;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;


class CharityRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortBy = $request->sort_by;
        $searchQuery = $request->search_query;

        if ($sortBy) {
            $charityRequests = Charity_Request::where('request_status', $sortBy)->orderBy('datetime', 'desc')->get();
        } elseif ($searchQuery) {
            $charityRequests = Charity_Request::with(['user'])
                ->where('title', 'like', "%{$searchQuery}%")
                ->orWhere('description', 'like', "%{$searchQuery}%")
                ->orderBy('datetime', 'desc')
                ->get();
        } else {
            $charityRequests = Charity_Request::orderBy('datetime', 'desc')->get();
        }


        return view('includes.adminIncludes.adminSections.adminRequestsResults', ['charityRequests' => $charityRequests]);
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

        $charity_Request = new Charity_Request();

        try {
            DB::beginTransaction();

            $request->validate([
                'title' => 'string|max:255',
                'description' => 'string',
                'fund_limit' => 'numeric|min:100|max:100000',
                'duration' => 'numeric',
                'id_type_used' => 'string|max:255',
                'id_number' => 'string|max:255',
                'id_image' => 'image|mimes:jpeg,png,jpg',
                'new_charity_front_face' => 'image|mimes:jpeg,png,jpg',
                'new_charity_side_face' => 'image|mimes:jpeg,png,jpg',
            ]);

            $folderName = 'user_' . $user->id . '/charities/charity_' . $request->input('title');
            $folderPath = 'uploads/' . $folderName;


            if ($request->hasFile('id_image')) {
                $idImageFile = $request->file('id_image');
                $idImageFileName = 'id_image_' . $user->id . '.' . $idImageFile->getClientOriginalExtension(); 
                $idImagePath = $idImageFile->storeAs($folderPath, $idImageFileName, 'public'); 
            }

            if ($request->hasFile('new_charity_front_face')) {
                $frontFaceFile = $request->file('new_charity_front_face');
                $frontFaceFileName = 'new_charity_front_face_' . $user->id . '.' . $frontFaceFile->getClientOriginalExtension(); 
                $frontFacePath = $frontFaceFile->storeAs($folderPath, $frontFaceFileName, 'public'); 
            }
            
            if ($request->hasFile('new_charity_side_face')) {
                $sideFaceFile = $request->file('new_charity_side_face');
                $sideFaceFileName = 'new_charity_side_face_' . $user->id . '.' . $sideFaceFile->getClientOriginalExtension(); 
                $sideFacePath = $sideFaceFile->storeAs($folderPath, $sideFaceFileName, 'public'); 
            }

            $charity_Request->title = $request->input('title');
            $charity_Request->description = $request->input('description');
            $charity_Request->fund_limit = $request->input('fund_limit');
            $charity_Request->duration = $request->input('duration');
            $charity_Request->id_type_used = $request->input('id_type_used');
            $charity_Request->id_number = $request->input('id_number');
            $charity_Request->datetime = now();
            $charity_Request->user_id = $user->id;
            $charity_Request->request_status = Charity_Request::STATUS_PENDING;
            $charity_Request->id_att_link = $idImagePath;
            $charity_Request->front_face_link = $frontFacePath;
            $charity_Request->side_face_link = $sideFacePath;
            $charity_Request->save();

            $user->status = User::STATUS_PENDING;
            $user->save(); 

            DB::commit();

            return response()->json(['message' => 'Charity request created successfully.'], 200);

        } catch (ValidationException $e) {

            DB::rollBack();

            return response()->json(['errors' => $e->errors()], 422);

        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Error creating charity: ' . $e->getMessage(), ['exception' => $e]);

            return response()->json(['message' => 'An error occurred while creating the charity.'], 500);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {

        if ($request->request_id && request()->user()->role === 'admin') {
            $focusedCharityRequest = Charity_Request::where('request_id', $request->request_id)->first();

            return view('includes.adminIncludes.adminModals.viewMoreDetailsModal.viewMoreDetailsModalContent', ['focusedCharityRequest' => $focusedCharityRequest]);

        } 

        if (request()->user()->role != 'admin') {
            $charityRequests = Charity_Request::with('user')->where('user_id', request()->user()->id)->orderBy('datetime', 'desc')->first();

            return view('includes.userIncludes.currentCharity.pendingNewCharity', ['charityRequests' => $charityRequests]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Charity_Request $charity_Request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Charity_Request $charity_Request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($charityRequestID, Request $request)
    {
        
    }

    public function cancelCharityRequest($charityRequestID, Request $request)
    {
        $user = $request->user();

        try {
            DB::beginTransaction();

            $charityRequest = Charity_Request::findOrFail($charityRequestID);

            if (!$charityRequest) {
                return response()->json(['message' => 'Charity request not found.'], 404);
            }

            $charityRequest->request_status = Charity_Request::STATUS_CANCELLED;
            $charityRequest->save();

            $user->status = User::STATUS_OFFLINE;
            $user->save();

            DB::commit();

            return response()->json(['message' => 'Charity request deleted successfully.'], 200);

        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Error deleting charity request: ' . $e->getMessage(), ['exception' => $e]);

            return response()->json(['message' => 'An error occurred while deleting the charity request.'], 500);
        }
    }

    public function rejectCharityRequest($charityRequestID)
    {
        try {
            DB::beginTransaction();

            $charityRequest = Charity_Request::findOrFail($charityRequestID);

            if (!$charityRequest) {
                return response()->json(['message' => 'Charity request not found.'], 404);
            }

            $charityRequest->request_status = Charity_Request::STATUS_REJECTED;
            $charityRequest->save();

            $user = $charityRequest->user;
            $user->status = User::STATUS_NOTIFIED;
            $user->save();

            $notification = new User_Notifications();
            $notification->user_id = $user->id;
            $notification->title = 'Charity Request Rejected';
            $notification->message = 'Your charity request titled "' . $charityRequest->title . '" has been rejected due to policy violations or inability to meet the requirements.';
            $notification->is_read = false;
            $notification->save();

            DB::commit();

            return response()->json(['message' => 'Charity request rejected successfully.'], 200);

        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Error rejecting charity request: ' . $e->getMessage(), ['exception' => $e]);

            return response()->json(['message' => 'An error occurred while rejecting the charity request.'], 500);
        }
    }

    public function approveCharityRequest($charityRequestID)
    {
        try {
            DB::beginTransaction();

            $charityRequest = Charity_Request::findOrFail($charityRequestID);

            if (!$charityRequest) {
                return response()->json(['message' => 'Charity request not found.'], 404);
            }

            $charityRequest->request_status = Charity_Request::STATUS_APPROVED;
            $charityRequest->approved_datetime = now();
            $charityRequest->save();

            $charity = new Charity();
            $charity->request_id = $charityRequestID;
            $charity->raised = 0;
            $charity->charity_status = Charity::STATUS_ONGOING;
            $charity->save();

            $user = $charityRequest->user;
            $user->status = User::STATUS_ACTIVE;
            $user->save();
            
            DB::commit();

            return response()->json(['message' => 'Charity request approved successfully.'], 200);

        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Error approving charity request: ' . $e->getMessage(), ['exception' => $e]);

            return response()->json(['message' => 'An error occurred while approving the charity request.'], 500);
        }
    }

}
