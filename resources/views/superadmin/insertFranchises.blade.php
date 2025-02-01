@extends('superadmin.layout')
@section('title', 'Create Franchise')
@section('content')

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Create Franchise</h1>
    <form action="{{ route('franchises.store') }}" method="POST" class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Franchise Name -->
            <div class="mb-4">
                <label for="franchise_name" class="block text-gray-700 text-sm font-semibold mb-2">Franchise Name</label>
                <input type="text" name="franchise_name" id="franchise_name" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Contact No -->
            <div class="mb-4">
                <label for="contact_no" class="block text-gray-700 text-sm font-semibold mb-2">Contact No</label>
                <input type="text" name="contact_no" id="contact_no" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email</label>
                <input type="email" name="email" id="email" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                <input type="password" name="password" id="password" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Aadhaar No -->
            <div class="mb-4">
                <label for="aadhaar_no" class="block text-gray-700 text-sm font-semibold mb-2">Aadhaar No</label>
                <input type="text" name="aadhaar_no" id="aadhaar_no" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- PAN No -->
            <div class="mb-4">
                <label for="pan_no" class="block text-gray-700 text-sm font-semibold mb-2">PAN No</label>
                <input type="text" name="pan_no" id="pan_no" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- IFSC Code -->
            <div class="mb-4">
                <label for="ifsc_code" class="block text-gray-700 text-sm font-semibold mb-2">IFSC Code</label>
                <input type="text" name="ifsc_code" id="ifsc_code" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Account No -->
            <div class="mb-4">
                <label for="account_no" class="block text-gray-700 text-sm font-semibold mb-2">Account No</label>
                <input type="text" name="account_no" id="account_no" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Street -->
            <div class="mb-4">
                <label for="street" class="block text-gray-700 text-sm font-semibold mb-2">Street</label>
                <input type="text" name="street" id="street" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- City -->
            <div class="mb-4">
                <label for="city" class="block text-gray-700 text-sm font-semibold mb-2">City</label>
                <input type="text" name="city" id="city" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- District -->
            <div class="mb-4">
                <label for="district" class="block text-gray-700 text-sm font-semibold mb-2">District</label>
                <input type="text" name="district" id="district" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Pincode -->
            <div class="mb-4">
                <label for="pincode" class="block text-gray-700 text-sm font-semibold mb-2">Pincode</label>
                <input type="text" name="pincode" id="pincode" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- State -->
            <div class="mb-4">
                <label for="state" class="block text-gray-700 text-sm font-semibold mb-2">State</label>
                <input type="text" name="state" id="state" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Country -->
            <div class="mb-4">
                <label for="country" class="block text-gray-700 text-sm font-semibold mb-2">Country</label>
                <input type="text" name="country" id="country" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Date of Creation (DOC) -->
            <div class="mb-4">
                <label for="doc" class="block text-gray-700 text-sm font-semibold mb-2">Date of Creation (DOC)</label>
                <input type="date" name="doc" id="doc" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="status" class="block text-gray-700 text-sm font-semibold mb-2">Status</label>
                <select name="status" id="status" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
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