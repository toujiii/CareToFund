<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // If the request includes with_trashed=1, return trashed users as well
        if ($request->query('with_trashed')) {
            $users = User::withTrashed()
            ->where('role', 'user')
            ->get();
        } else {
            $users = User::where('role', 'user')->get();
        }

        return response()->json($users);
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
    public function show(string $id)
    {

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
        $user = User::withTrashed()->findOrFail($id);
        $data = $request->only(['name', 'email']);
        $user->update($data);
        return redirect()->back()->with('success', 'User updated.');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // soft delete
        return redirect()->back()->with('success', 'User archived.');
    }

    public function restore(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->back()->with('success', 'User restored.');
    }

    public function forceDelete(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();
        return redirect()->back()->with('success', 'User permanently deleted.');
    }
}
