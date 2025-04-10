<?php

namespace App\Http\Controllers;

use App\Models\User;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;  
use Spatie\Permission\Models\Role;

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
}