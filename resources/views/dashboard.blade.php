@extends('layouts.app')

@section('title', 'Dashboard - School Administration')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
        <p class="mt-2 text-sm text-gray-600">Welcome to the School Administration System</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Students Card -->
        <a href="{{ route('students.index') }}"
            class="block p-6 bg-white rounded-lg border border-gray-200 shadow-md hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-indigo-100 rounded-lg">
                    <i class="fas fa-user-graduate text-2xl text-indigo-600"></i>
                </div>
            </div>
            <h5 class="mb-2 text-2xl font-bold text-gray-900">Students</h5>
            <p class="text-gray-600">Manage Students</p>
        </a>

        <!-- Teacher Card -->
        <a href="{{ route('teachers.index') }}"
            class="block p-6 bg-white rounded-lg border border-gray-200 shadow-md hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-indigo-100 rounded-lg">
                    <i class="fas fa-user-graduate text-2xl text-indigo-600"></i>
                </div>
            </div>
            <h5 class="mb-2 text-2xl font-bold text-gray-900">Teachers</h5>
            <p class="text-gray-600">Manage Teachers</p>
        </a>

    </div>





@endsection
