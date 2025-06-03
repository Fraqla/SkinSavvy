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

    $user = Auth::user();
    $token = $user->createToken('authToken')->plainTextToken;

    return response()->json([
        'message' => 'Login successful',
        'user' => $user,
        'token' => $token
    ], 200);
}

public function getProfile(Request $request)
{
    $user = $request->user()->load('userSkinType');
    \Log::info('User with skin type:', ['user' => $user->toArray()]);
    return response()->json(['user' => $user]);
}

public function updateProfile(Request $request)
{
    $user = $request->user();

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'skin_type' => 'sometimes|array',
        'skin_type.skin_type' => 'sometimes|string',
        'skin_type.total_score' => 'sometimes|integer',
    ]);

    $user->update([
        'name' => $validated['name'],
        'email' => $validated['email'],
    ]);

    // Update or create skin type
    if (isset($validated['skin_type'])) {
        $user->skinType()->updateOrCreate(
            ['user_id' => $user->id],
            $validated['skin_type']
        );
    }

    return response()->json([
        'user' => $user->fresh()->load('skinType'),
    ]);
}

}