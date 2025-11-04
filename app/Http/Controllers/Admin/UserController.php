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
        // // If the request includes with_trashed=1, return trashed users as well
        // if ($request->query('with_trashed')) {
        //     $users = User::withTrashed()
        //     ->where('role', 'user')
        //     ->get();
        // } else {
        //     $users = User::where('role', 'user')->get();
        // }

        // return response()->json($users);
        $status = $request->query('status');
        $withTrashed = $request->boolean('with_trashed');

        $query = User::query();
        if ($status === 'archived') {
            $query = User::onlyTrashed();
        } elseif ($status === 'all' || $withTrashed) {
            $query = User::withTrashed();
        } else {
            // default: unarchived
            $query = User::query();
        }

        // only regular users
        $query->where('role', 'user');


        // optional: search by name/email
        if ($q = $request->input('q')) {
            $query->where(function ($b) use ($q) {
                $b->where('name', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%");
            });
        }

        $perPage = (int) $request->input('per_page', 10);
        $users = $query
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        // return Laravel paginator as JSON (data, meta, links)
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
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);
        $user->update($data);
        if ($request->wantsJson() || $request->ajax() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json(['message' => 'User updated', 'user' => $user->fresh()], 200);
        }
        // return response()->json(['message' => 'User updated'], 200);
        return redirect()->back()->with('success', 'User updated.');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // soft delete
        return response()->json(['message' => 'User archived'], 200);
        // return redirect()->back()->with('success', 'User archived.');
    }

    public function restore(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
        return response()->json(['message' => 'User restored'], 200);
        // return redirect()->back()->with('success', 'User restored.');
    }

    public function forceDelete(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();
        return response()->json(['message' => 'User permanently deleted'], 200);
        // return redirect()->back()->with('success', 'User permanently deleted.');
    }
}
