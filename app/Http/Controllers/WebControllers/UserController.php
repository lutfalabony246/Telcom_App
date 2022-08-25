<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
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
        //only authenticated login user will show his data 
        if(Auth::user()->id)
        {
        $user=User::find(Auth::user()->id)->first();
        $headers=['Name','Email','Password'];
        
         return view('user.user_view',compact('user','headers'));
        }
       

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //showing outlet adding page
        return view('user.user_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    // for editing user data
    public function edit($id)
    {
        //
        try {
            $user = User::find($id);
            if (isset($user)) {
                return view('user.user_edit',compact('user'));
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
        
         // for validation of requested data
         $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => [
                'required',
                'min:8',
            ],
        ]);
        //for storing user data into database
        try {
            $UpdateUserId = User::find($id);
            $UpdateUserId->update($request->all());
            return redirect()->route('user.index');
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
        //
          //for deleting user data
          $user_id = User::find($id);
          try {
              if (isset($user_id)) {
                $user_id->destroy();
                  return 'user deleted successfully!';
              } else {
                  throw new Exception('User id is not found!');
              }
          } catch (\Exception $e) {
              return $e->getMessage();
          }
    }
}
