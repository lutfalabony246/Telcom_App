<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\Outlet;
use Exception;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File; 

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $outlet=Outlet::all();
        return response('lanbk');
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
        //for storing outlet data into database
         // for validation of requested data
         $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'image' => 'required',
            
        ]);
        //for storing user data into database
        try {
            if ($request->file('image')) {
                $image = $request->file('image');
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(400, 400)->save('upload/outlet/' . $name_gen);
                $save_url = 'upload/outlet/' . $name_gen;
            }

            Outlet::create([
                'name' => $request->name,
                'phone' => '+88'.$request->phone,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'image' => $save_url,
                
            ]);
            return response([
                'message'=>'New Outlet created successfully!'
            ]);
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
    public function edit($id)
    {
       
        //for editing Outlet data
        try {
            $user = Outlet::find($id);
            if (isset($user)) {
                return Outlet::find($id);
            } else {
                throw new Exception('This Outlet id is not found');
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
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'image' => 'required',
            
        ]);
       
        //for storing user data into database
        try {

            if (request()->hasFile('image') && request('image') != '') {
                $imagePath = public_path('upload/outlet/'.$request->image);
                if(File::exists($imagePath)){
                    unlink($imagePath);
                }
                $image = $request->file('image');
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(400, 400)->save('upload/outlet/' . $name_gen);
                $save_url = 'upload/outlet/' . $name_gen;
            }
            $update_outlet = Outlet::find($id);
            $update_outlet->update(
                [
                    'name' => $request->name,
                    'phone' => '+88'.$request->phone,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                    'image' => $save_url,
                    
                ]
            );
            return response(['message'=>'Outlet data updated successfully!']);
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
        //for deleting outlet data
        $outlet = Outlet::findOrFail($id);
        if($outlet->image)
        {
        $img = $outlet->image;
        unlink($img);
        }
        Outlet::findOrFail($id)->destroy();

        return redirect()->back();
    }
}
