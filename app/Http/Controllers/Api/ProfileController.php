<?php

// ProfileController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Display the authenticated user's profile.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        $userData = [
            'name' => $user->name,
            'phone' => $user->phone,
            'profile_picture' => asset('storage/' . $user->profile_picture),
    ];

    return response()->json($userData);
    }

    /**
     * Update the authenticated user's profile.
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProfileRequest $request, string $id)
    {
        $user = User::findOrFail($id);

    $validated = $request->validated();

    // Log the validated data for debugging
    Log::info('Validated Data:', $validated);

    // Update common profile fields
    if (isset($validated['name'])) {
        $user->name = $validated['name'];
    }

    if (isset($validated['phone'])) {
        $user->phone = $validated['phone'];
    }

    // Delete old profile picture if it exists
    if (!is_null($user->profile_picture)) {
        Storage::disk('public')->delete($user->profile_picture);
    }

    // Update profile picture if provided
    if ($request->hasFile('profile_picture')) {
        $user->profile_picture = $request->file('profile_picture')->storePublicly('images', 'public');
    }

    $user->save();

    $userData = [
        'name' => $user->name,
        'phone' => $user->phone,
        'profile_picture' => asset('storage/' . $user->profile_picture),
    ];

    return response()->json($userData);
}
}