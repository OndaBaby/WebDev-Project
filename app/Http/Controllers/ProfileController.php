<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use Storage;
use App\Models\User;
use App\Models\Customer;
use App\Models\Image;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $customer = $user->customer;

        return view('profile.edit', compact('user', 'customer'));
    }

    public function update(Request $request)
    {

    $request->validate([
        'name' => 'required|string|max:255',
        'password' => 'nullable|string|min:8|confirmed',
        'user_image' => 'nullable|image|max:2048', // Assuming max file size is 2MB
    ]);

    $user = Auth::user();
    $user->name = $request->input('name');

    if ($request->has('password')) {
        $user->password = Hash::make($request->input('password'));
    }

    // Handle photo upload
    if ($request->hasFile('user_image')) {
        $image = $request->file('user_image');
        // Validate the uploaded file
        $validatedImage = $request->validate([
            'user_image' => 'image|max:2048', // Assuming max file size is 2MB
        ]);
        // Store the image
        $path = $image->store('public/images');
        $user_image = str_replace('public/', 'storage/', $path);

        // Update or create associated image record
        $user->image()->updateOrCreate([], ['user_image' => $user_image]);
    }

    // Update customer profile if exists
    if ($user->customer) {
        $customer = $user->customer;
        $customer->username = $request->input('username');
        $customer->address = $request->input('address');
        $customer->contact_number = $request->input('contact_number');
        $customer->save();
    }

    $user->save();

    return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
