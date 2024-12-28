<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        // Jika permintaan datang dari API, kembalikan JSON
        if ($request->is('api/*')) {
            $locations = Location::with('role')->get();
            return response()->json($locations); // Return as JSON
        }

        // Jika permintaan datang dari rute admin, kembalikan view
        if ($request->is('minecraft/admin/*')) {
            $roles = Role::all();
            return view('minecraft.admin.locations.index');
        }

        // Default respons untuk keamanan
        abort(404, 'Not Found');
    }

    // Get roles for dropdown
    public function roles()
    {
        $roles = Role::all();
        return response()->json($roles); // Return as JSON
    }


    // Store a new location
    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'base_time' => 'required|numeric|min:0',
            'reward' => 'required|string',
        ]);

        $data = $request->only(['role_id', 'name', 'base_time', 'reward']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('locations', 'public');
        }

        $location = Location::create($data);

        return response()->json($location, 201); // Return created location
    }

    // Update an existing location
    public function update(Request $request, Location $location)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'base_time' => 'required|numeric|min:0',
            'reward' => 'required|string',
        ]);

        $data = $request->only(['role_id', 'name', 'base_time', 'reward']);
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($location->image) {
                Storage::disk('public')->delete($location->image);
            }
            $data['image'] = $request->file('image')->store('locations', 'public');
        }

        $location->update($data);

        return response()->json($location); // Return updated location
    }

    // Delete a location
    public function destroy(Location $location)
    {
        if ($location->image) {
            Storage::disk('public')->delete($location->image);
        }

        $location->delete();

        return response()->json(['message' => 'Location deleted successfully.'], 200);
    }
}

