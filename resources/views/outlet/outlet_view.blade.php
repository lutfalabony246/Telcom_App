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
                                        @foreach ($outlets as $outlet)
                                        <tr>
                                            <td> <img src="{{ asset($outlet->image) }}" style="width: 60px; height: 50px;">
                                            </td>
                                            <td class="fc">{{$outlet->name }}</td>

                                            <td>{{$outlet->phone }}</td>
                                            <td>{{$outlet->latitude }}</td>
                                            <td>{{$outlet->longitude }}</td>
                                            <td>
                                                <a href="{{ route('outlet.edit', $outlet->id) }}" class="btn btn-primary btn-sm">
                                                    Edit</a>
                                                <a href="{{ route('outlet.destroy', $outlet->id) }}" class="btn btn-danger btn-sm">
                                                    Delete</a>

                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </x-app-layout>


