<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Charity;
use App\Models\Donator;
use App\Models\Charity_Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{
    public function showProfile(Request $request)
    {
        $userID = $request->user()->id;
        $user = User::with('donators', 'charity_request', 'user_notifications')->find($userID);

        $charities = Charity::with('charity_request')->whereHas('charity_request', function ($query) use ($user) {
                        $query->where('user_id', $user->id);
                    })->where('charity_status', 'Finished')->get();

        return view('includes.userIncludes.userProfileComponent', ['user' => $user, 'charities' => $charities]);
    }

    public function updateInfo(Request $request)
    {
        $user = $request->user();

        try {
            DB::beginTransaction();

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            ]);


            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();

            DB::commit();

            return response()->json([$request->all()], 200);

        } catch (ValidationException $e) {

            DB::rollBack();

            return response()->json(['errors' => $e->errors()], 422);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json(['message' => 'An error occurred while updating the profile.'], 500);
        }
    }

    public function resetPassword(Request $request)
    {
        $user = $request->user();
        $userPassword = User::find($user->id)->password;

        try {
            DB::beginTransaction();

            $request->validate([
                'current_password' => 'required|string|min:8',
                'new_password' => 'required|string|min:8|confirmed',
            ]);

            if (!Hash::check($request->input('current_password'), $userPassword)) {
                throw ValidationException::withMessages([
                    'current_password' => ['The current password is incorrect.'],
                ]);
                return response()->json(['message' => 'Current password is incorrect.'], 403);
            } 

            $user->password = Hash::make($request->input('new_password'));
            $user->save();

            DB::commit();

            return response()->json(['message' => 'Password has been successfully updated.'], 200);

        } catch (ValidationException $e) {

            DB::rollBack();

            return response()->json(['errors' => $e->errors()], 422);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json(['message' => 'An error occurred while resetting the password.'], 500);

        }
    }

    public function verifyGcash(Request $request)
    {
        $user = $request->user();

        try {
            DB::beginTransaction();

            $request->validate([
                'gcash_number' => 'required|numeric|min:11',
            ]);


            $user->gcash_number = $request->input('gcash_number');
            $user->save();

            DB::commit();

            return response()->json(['message' => 'GCash number has been successfully verified.'], 200);

        } catch (ValidationException $e) {

            DB::rollBack();

            return response()->json(['errors' => $e->errors()], 422);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json(['message' => 'An error occurred while verifying the GCash number.'], 500);

        }
    }

    public function verifyImages(Request $request)
    {
        $user = $request->user();

        try {
            DB::beginTransaction();

            $request->validate([
                'front_face' => 'required|image|mimes:jpeg,png,jpg',
                'side_face' => 'required|image|mimes:jpeg,png,jpg',
            ]);

            $folderName = 'user_' . $user->id . '/verification_images';
            $folderPath = 'uploads/' . $folderName;
            
           
            if ($request->hasFile('front_face')) {
                $frontFaceFile = $request->file('front_face');
                $frontFaceFileName = 'front_face_' . $user->id . '.' . $frontFaceFile->getClientOriginalExtension(); 
                $frontFacePath = $frontFaceFile->storeAs($folderPath, $frontFaceFileName, 'public'); 
            }

            
            if ($request->hasFile('side_face')) {
                $sideFaceFile = $request->file('side_face');
                $sideFaceFileName = 'side_face_' . $user->id . '.' . $sideFaceFile->getClientOriginalExtension(); 
                $sideFacePath = $sideFaceFile->storeAs($folderPath, $sideFaceFileName, 'public'); 
            }


            $user->user_front_link = $frontFacePath;
            $user->user_side_link = $sideFacePath;
            $user->save();

            DB::commit();

            return response()->json(['message' => 'User images have been successfully verified.'], 200);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json(['message' => 'An error occurred while verifying the user images.'], 500);

        }
    }

    
}
