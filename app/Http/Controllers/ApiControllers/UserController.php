<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //for showing user data
        $users = User::get();
        return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // for validation of requested data
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => [
                'required',
                'min:8',
            ],
        ]);
        //for storing user data into database
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return 'User data created successfully!';
        } catch (\Exception $e) {
            return ('Insert into database error -' . $e->getLine() . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     //for editing user data
    public function edit($id)
    {
       
        try {
            $user = User::find($id);
            if (isset($user)) {
                return User::find($id);
            } else {
                throw new Exception('This user id is not found');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //for updating user data
        // for validation of requested data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => [
                'required',
                'min:8',
            ],
        ]);
        //for storing user data into database
        try {
            $UpdateUserId = User::find($id);
            $UpdateUserId->update($request->all());
            return 'User data updated successfully!';
        } catch (\Exception $e) {
            return ('Update into database error -' . $e->getLine() . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //for deleting user data
        $user_id = User::find($id);
        try {
            if (isset($user_id)) {
                return 'user deleted successfully!';
            } else {
                throw new Exception('User id is not found!');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    // for registering user for authentication
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => [
                'required',
                'min:8',
            ],
        ]);
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $token = $user->createToken('telcomtoken')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token
            ];
            return response($response, 201);
            // return 'User data created successfully!';
        } catch (\Exception $e) {
            return ('Insert into database error -' . $e->getLine() . $e->getMessage());
        }
    }
    // for registering user for authentication
    public function login(Request $request)
    {
        $fieldRequired = $request->validate([
            'email' => 'required',
            'password' => 'required',


        ]);
        try {
            // check email for login user
            $user = User::where('email', $request->email)->first();
            if (!$user || !Hash::check($fieldRequired['password'], $user->password)) {
               return response([
                    'message' => 'You have entered incorrect email or password'
                ], 401);
            } else {
                $token = $user->createToken('telcomtoken')->plainTextToken;
                $response = [
                    'user' => $user,
                    'token' => $token
                ];
                return response($response, 201);
            }
            // return 'User data created successfully!';
        } catch (\Exception $e) {
            return ('Insert into database error -' . $e->getLine() . $e->getMessage());
        }
    }
    // authenticate user logout method
    public function logout(Request $request)
    {
        Auth::user()->tokens->each(function ($token, $key) {
            $token->delete();
        });
        return [
            'message' => 'Logged Out'
        ];
    }
}
