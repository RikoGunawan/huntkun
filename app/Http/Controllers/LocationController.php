<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Role;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::with('role')->get();
        return view('minecraft.admin.locations.index', compact('locations'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('minecraft.admin.locations.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'base_time' => 'required|integer|min:0',
            'reward' => 'required|string',
        ]);

        $data = $request->only(['role_id', 'name', 'base_time', 'reward']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('locations', 'public');
        }

        Location::create($data);

        return redirect()->route('minecraft.admin.locations.index')->with('success', 'Location created successfully!');
    }

    public function edit(Location $location)
    {
        $roles = Role::all();
        return view('minecraft.admin.locations.edit', compact('location', 'roles'));
    }

    public function update(Request $request, Location $location)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'base_time' => 'required|integer|min:0',
            'reward' => 'required|string',
        ]);

        $data = $request->only(['role_id', 'name', 'base_time', 'reward']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('locations', 'public');
        }

        $location->update($data);

        return redirect()->route('minecraft.admin.locations.index')->with('success', 'Location updated successfully!');
    }

    public function destroy(Location $location)
    {
        if ($location->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($location->image);
        }

        $location->delete();

        return redirect()->route('minecraft.admin.locations.index')->with('success', 'Location deleted successfully!');
    }
}
