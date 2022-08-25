@extends('master')
    <x-app-layout>
        <x-slot name="header">
        </x-slot>
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card p-5">
                                <h4>Outlet View</h4>
                                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            @foreach ($headers as $header )
                                            <th>{{ $header }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- show all outlet data --}}
                                        
                                        <tr>
                                            
                                            <td class="fc">{{$user->name }}</td>

                                            <td>{{$user->email }}</td>
                                            <td>{{$user->password }}</td>
                                          
                                            <td>
                                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-sm">
                                                    Edit</a>
                                                <a href="{{ route('user.destroy', $user->id) }}" class="btn btn-danger btn-sm">
                                                    Delete</a>

                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </x-app-layout>


