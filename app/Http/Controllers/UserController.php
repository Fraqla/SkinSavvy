<?php

namespace App\Http\Controllers;

use App\Models\User;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;  
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request) 
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);
    
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);
    
        // Assign 'user' role ONLY if from mobile
        if ($request->header('X-Requested-With') === 'Flutter') {
            $user->assignRole('user');
        }
    
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
        ], 201);
    }
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Assign "user" role - make sure the role exists
        $user->assignRole('user');

        return $user;
    }

    public function login(Request $request)
{
    // Validate input
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Attempt login
    if (!Auth::attempt($credentials)) {
        return response()->json([
            'message' => 'Invalid email or password'
        ], 401);
    }

    $user = Auth::user()->load('skinType');
    $token = $user->createToken('authToken')->plainTextToken;

    return response()->json([
        'message' => 'Login successful',
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'skin_type' => $user->skinType ? [ 
                'id' => $user->skinType->id,
                'user_id' => $user->skinType->user_id,
                'total_score' => $user->skinType->total_score,
                'skin_type' => $user->skinType->skin_type,
            ] : null
        ],
        'token' => $token
    ], 200);
}

public function profile(Request $request)
{
    $user = User::with('skinType')->find(auth()->id());

    return response()->json($user);
}

public function getProfile(Request $request)
{
    return response()->json([
        'id' => $request->user()->id,
        'name' => $request->user()->name,
        'email' => $request->user()->email,
        'skin_type' => $request->user()->skinType, // Laravel auto-serializes the relationship
    ]);
}

public function updateProfile(Request $request)
{
    $user = $request->user();

    // Add debug logging
    \Log::info('Update Profile Request:', $request->all());

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
    ]);

    try {
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        \Log::info('User updated successfully:', $user->toArray());

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'skin_type' => $user->skinType ? [
                        'id' => $user->skinType->id,
                        'user_id' => $user->skinType->user_id,
                        'total_score' => $user->skinType->total_score,
                        'skin_type' => $user->skinType->skin_type,
                    ] : null,
                ],
            ], 200);

    } catch (\Exception $e) {
        \Log::error('Profile update failed:', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        return response()->json([
            'message' => 'Profile update failed',
            'error' => $e->getMessage()
        ], 500);
    }
}
}