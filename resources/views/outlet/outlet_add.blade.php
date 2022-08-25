
@extends('master')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card p-5">
                            <h4>Customer Add</h4>
                            <form method="POST" action="{{ url('outlet') }}" enctype="multipart/form-data">

                                @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Customer Id <b style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                            <input type="text" name="name" class="form-control" value="" placeholder="Enter customer id">


                                            @error('name')

                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phone<b style="color:red; font-weight:bold;font-size: 18px">**</b></label>

                                            <input type="number" name="phone" class="form-control" value="" placeholder="Enter phone number">


                                            @error('phone')

                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Latitude <b style="color:red; font-weight:bold;font-size: 18px">**</b></label>

                                            <input type="text" name="latitude" class="form-control" value="" placeholder="Enter latitude">



                                            @error('latitude')


                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Longitude<b style="color:red; font-weight:bold;font-size: 18px">**</b></label>


                                            <input type="text" name="longitude" class="form-control" value="" placeholder="Enter longitude">


                                            @error('longitude')

                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Image<b style="color:red; font-weight:bold;font-size: 18px">**</b></label>


                                            <input type="file" name="image" class="form-control">




                                            @error('longitude')

                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                </div>

                                <div class="d-flex justify-content-center p-4">
                                    <button type="submit" class="btn btn-success">Submit </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>



        </section>
    </div>



