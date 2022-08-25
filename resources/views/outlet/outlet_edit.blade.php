@extends('master')

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card p-5">
                            <h4>Customer Add</h4>
                            <form method="post" action="{{ url('outlet/'.$outlet->id ) }}" enctype="multipart/form-data">

                                {{ method_field('PUT') }}

                                @csrf
                                <input type="hidden" name="old_image" value="{{ $outlet->image }} ">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Name <b style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                            <input type="text" name="name" class="form-control" value="{{ $outlet->name }}" placeholder="Enter customer name">
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Phone<b style="color:red; font-weight:bold;font-size: 18px">**</b></label>

                                            <input type="number" name="phone" class="form-control" value="{{ $outlet->phone }}" placeholder="Enter customer name">


                                            @error('phone')

                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Latitude <b style="color:red; font-weight:bold;font-size: 18px">**</b></label>

                                            <input type="text" name="latitude" class="form-control" value="{{ $outlet->latitude }}" placeholder="Enter customer name">



                                            @error('latitude')


                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Longitude<b style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                            <input type="text" name="longitude" class="form-control" value="{{ $outlet->longitude }}" placeholder="Enter customer name">
                                            @error('longitude')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Image<b style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                            {{-- <input type="file" name="image"> --}}
                                            <img src="{{ asset($outlet->image) }}" class="card-img-top" style="height: 80px; width: 110px;">
                                            <div style="width: 110px">
                                                <input type="file" value="{{ asset($outlet->image)}}" name="image" class="form-control">

                                            </div>
                                            @error('image')
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
