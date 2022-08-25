<?php

namespace App\Http\Controllers\WebControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Outlet;
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
     //for view outlet with its data
    public function index()
    {
       
        $headers=['Image','Name','Phone','Latitude','Logitude','Action'];
         $outlets=Outlet::all();
         return view('outlet.outlet_view',compact('outlets','headers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // to show add page
    public function create()
    {
        //showing outlet adding page
        return view('outlet.outlet_add');


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // outlet data store
    public function store(Request $request)
    {

        //for validating requested data
        $request->validate([
        'name' => 'required',
        'phone' => 'required',
        'latitude' => 'required',
        'longitude' => 'required',
        'image' => 'required',

        ]);
         try {

         $image = $request->file('image');
         $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
         Image::make($image)->resize(400, 400)->save('upload/outlet/' . $name_gen);
         $save_url = 'upload/outlet/' . $name_gen;

        // storing in database
         Outlet::create([
         'name' => $request->name,
         'phone' => $request->phone,
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
    // edit data according to id
    public function edit($id)
    {
        //for edit data
         try {
         $outlet = Outlet::find($id);
         if (isset($outlet)) {
         return view('outlet.outlet_edit',compact('outlet'));
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
    // update outlet data
    public function update(Request $request, $id)
    {

        //validation
       $request->validate([
       'name' => 'required',
       'phone' => 'required',
       'latitude' => 'required',
       'longitude' => 'required',

       ]);

       //edit data storing  into database
       try {

        $old_image=$request->old_image;
        $update_outlet = Outlet::find($id);

        if ($request->file('image')) {
        if(file_exists($old_image) && $request->old_image != null)
        {
        unlink($old_image);
        }
        //Image Save
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) .'.'. $image->getClientOriginalExtension();
        Image::make($image)->resize(870,370)->save('upload/outlet/'. $name_gen);
        $save_url = 'upload/outlet/'. $name_gen;
        $update_outlet->image =$save_url;
        }
        $update_outlet->name=$request->name;
        $update_outlet->phone=$request->phone;
        $update_outlet->latitude=$request->latitude;
        $update_outlet->longitude=$request->longitude;
        $update_outlet->update();
       return redirect()->route('outlet.index');
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

    // destory outlet data
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
