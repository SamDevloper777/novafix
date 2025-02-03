@extends('admin.layout')
@section('title', 'View Franchise')
@section('content')

<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">       
        <!-- Personal Details Section -->
        <div class="mb-8 border-b pb-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Personal Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Franchise Name</label>
                    <p class="text-gray-900">{{ $franchise->franchise_name }}</p>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Contact No</label>
                    <p class="text-gray-900">{{ $franchise->contact_no }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Email</label>
                    <p class="text-gray-900">{{ $franchise->email }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Aadhaar No</label>
                    <p class="text-gray-900">{{ $franchise->aadhaar_no }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">PAN No</label>
                    <p class="text-gray-900">{{ $franchise->pan_no }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Date of Creation</label>
                    <p class="text-gray-900">{{ $franchise->doc }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Status</label>
                    <span class="px-3 py-1 text-sm rounded-full 
                        {{ $franchise->status === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $franchise->status }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Address Details Section -->
        <div class="mb-8 border-b pb-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Address Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Pincode</label>
                    <p class="text-gray-900">{{ $franchise->pincode }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Street</label>
                    <p class="text-gray-900">{{ $franchise->street }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Country</label>
                    <p class="text-gray-900">{{ $franchise->country }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">State</label>
                    <p class="text-gray-900">{{ $franchise->state }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">District</label>
                    <p class="text-gray-900">{{ $franchise->district }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">City</label>
                    <p class="text-gray-900">{{ $franchise->city }}</p>
                </div>
            </div>
        </div>

        <!-- Bank Details Section -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Bank Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">IFSC Code</label>
                    <p class="text-gray-900">{{ $franchise->ifsc_code }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Account No</label>
                    <p class="text-gray-900">{{ $franchise->account_no }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Bank Name</label>
                    <p class="text-gray-900">{{ $franchise->bank_name }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-semibold mb-2">Branch Name</label>
                    <p class="text-gray-900">{{ $franchise->branch_name }}</p>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-6">
            <a href="" 
               class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded inline-flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to List
            </a>
        </div>
    </div>
</div>


@endsection