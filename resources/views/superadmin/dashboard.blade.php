@extends('superadmin.layout')
@section('title', 'Dashboard')
@section('content')
<main class="ml-64 p-8 w-full">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-semibold">Dashboard Overview</h2>
        <div class="flex items-center space-x-4">
            <button class="p-2 hover:bg-gray-100 rounded-full">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
            </button>
            <div class="flex items-center">
                <img src="https://via.placeholder.com/40" alt="Avatar" class="w-8 h-8 rounded-full">
                <span class="ml-2">Super Admin</span>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-500">Total Franchises</p>
                    <p class="text-3xl font-bold mt-2">248</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
            </div>
            <p class="text-sm text-green-500 mt-2">↑ 12% from last month</p>
        </div>

        <!-- Repeat similar cards for other metrics -->
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Franchise List -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow-sm p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold">Recent Franchises</h3>
                <button class="text-blue-600 hover:text-blue-800">View All →</button>
            </div>
            
            <table class="w-full">
                <thead>
                    <tr class="text-left text-gray-500 border-b">
                        <th class="pb-3">Franchise</th>
                        <th class="pb-3">Location</th>
                        <th class="pb-3">Status</th>
                        <th class="pb-3">Revenue</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <!-- Table rows -->
                    <tr>
                        <td class="py-4">Janta chock</td>
                        <td>Purnea</td>
                        <td><span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm">Active</span></td>
                        <td>Rs.4,200</td>
                    </tr>
                    <!-- More rows -->
                </tbody>
            </table>
        </div>

        <!-- Quick Stats -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold mb-4">Performance Overview</h3>
            <div class="space-y-6">
                <div>
                    <div class="flex justify-between mb-2">
                        <span>Service Requests</span>
                        <span class="font-semibold">1,234</span>
                    </div>
                    <div class="h-2 bg-gray-200 rounded-full">
                        <div class="h-2 bg-blue-600 rounded-full w-3/4"></div>
                    </div>
                </div>
                <!-- More progress bars -->
            </div>
        </div>
    </div>
</main>
@endsection