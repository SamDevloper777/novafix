@extends('superadmin.layout')
@section('title', 'Create Franchise')
@section('content')
div class="container mx-auto px-4 py-8">

<div class="container mx-auto px-4 py-8">
    @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
        <strong>Success!</strong> {{ session('success') }}
    </div>
@endif

    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        <strong>Whoops! Something went wrong.</strong>
        <ul class="mt-2">
            @foreach ($errors->all() as $error)
                <li class="text-sm">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <h1 class="text-3xl font-bold text-gray-800 mb-6">Create Franchise</h1>
    <form action="{{ route('franchises.store') }}" method="POST" class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Franchise Name -->
            <div class="mb-4">
                <label for="franchise_name" class="block text-gray-700 text-sm font-semibold mb-2">Franchise Name</label>
                <input type="text" name="franchise_name" id="franchise_name" value="{{ old('franchise_name') }}" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('franchise_name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Contact No -->
            <div class="mb-4">
                <label for="contact_no" class="block text-gray-700 text-sm font-semibold mb-2">Contact No</label>
                <input type="text" name="contact_no" id="contact_no" value="{{ old('contact_no') }}" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('contact_no')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                <input type="password" name="password" id="password" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Aadhaar No -->
            <div class="mb-4">
                <label for="aadhaar_no" class="block text-gray-700 text-sm font-semibold mb-2">Aadhaar No</label>
                <input type="text" name="aadhaar_no" id="aadhaar_no" value="{{ old('aadhaar_no') }}" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('aadhaar_no')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- PAN No -->
            <div class="mb-4">
                <label for="pan_no" class="block text-gray-700 text-sm font-semibold mb-2">PAN No</label>
                <input type="text" name="pan_no" id="pan_no" value="{{ old('pan_no') }}" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('pan_no')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- IFSC Code -->
            <div class="mb-4">
                <label for="ifsc_code" class="block text-gray-700 text-sm font-semibold mb-2">IFSC Code</label>
                <input type="text" name="ifsc_code" id="ifsc_code" value="{{ old('ifsc_code') }}" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('ifsc_code')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Account No -->
            <div class="mb-4">
                <label for="account_no" class="block text-gray-700 text-sm font-semibold mb-2">Account No</label>
                <input type="text" name="account_no" id="account_no" value="{{ old('account_no') }}" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('account_no')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Street -->
            <div class="mb-4">
                <label for="street" class="block text-gray-700 text-sm font-semibold mb-2">Street</label>
                <input type="text" name="street" id="street" value="{{ old('street') }}" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('street')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <!-- City -->
            <div class="mb-4">
                <label for="city" class="block text-gray-700 text-sm font-semibold mb-2">City</label>
                <input type="text" name="city" value="{{old('city')}}" id="city" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" >
                @error('city')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- District -->
            <div class="mb-4">
                <label for="district" class="block text-gray-700 text-sm font-semibold mb-2">District</label>
                <input type="text" name="district" value="{{old('district')}}" id="district" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" >
                @error('district')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pincode -->
            <div class="mb-4">
                <label for="pincode" class="block text-gray-700 text-sm font-semibold mb-2">Pincode</label>
                <input type="text" name="pincode"  id="pincode" value="{{old('pincode')}}" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" >
                @error('pincode')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- State -->
            <div class="mb-4">
                <label for="state" class="block text-gray-700 text-sm font-semibold mb-2">State</label>
                <input type="text" name="state" value="{{old('state')}}" id="state" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" >
                @error('state')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Country -->
            <div class="mb-4">
                <label for="country" class="block text-gray-700 text-sm font-semibold mb-2">Country</label>
                <input type="text" name="country" value="{{old('value')}}" id="country" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" >
                @error('country')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date of Creation (DOC) -->
            <div class="mb-4">
                <label for="doc" class="block text-gray-700 text-sm font-semibold mb-2">Date of Creation (DOC)</label>
                <input type="date" name="doc" id="doc" value="{{old('doc')}}" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" >
                @error('doc')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="status" class="block text-gray-700 text-sm font-semibold mb-2">Status</label>
                <select name="status" id="status" value="{{old('status')}}" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" >
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
                @error('status')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                Create Franchise
            </button>
        </div>
    </form>
</div>

@endsection