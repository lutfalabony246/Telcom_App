@extends('master')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                    <button>
                    <a href="{{ route('outlet.index') }}" class="btn btn-success btn-sm">
                            Outlet View</a>
                    </button>
                    <button>
                    <a href="{{ route('outlet.create') }}" class="btn btn-success btn-sm">
                            Outlet Add</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
