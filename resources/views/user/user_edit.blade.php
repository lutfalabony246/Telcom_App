
@extends('master')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card p-5">
                            <h4>Customer Add</h4>
                            <form method="POST" action="{{ url('user/'.$user->id ) }}" enctype="multipart/form-data">
                            {{ method_field('PUT') }}
                             @csrf
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Name <b style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                            <input type="text" name="name" value="{{$user->name}}" class="form-control" value="" placeholder="Enter user name">


                                            @error('name')

                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email<b style="color:red; font-weight:bold;font-size: 18px">**</b></label>

                                            <input type="email" value="{{$user->email}}" name="email" class="form-control" value="" placeholder="Enter email address">
                                            @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Password <b style="color:red; font-weight:bold;font-size: 18px">**</b></label>
                                            <input type="text" value="{{$user->password}}" name="password" class="form-control" value="" placeholder="Enter password">
                                            @error('password')
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
