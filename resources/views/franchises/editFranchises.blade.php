@extends('superadmin.layout')
@section('title', 'Create Franchise')
@section('content')

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
    <form action="{{ route('franchises.update',$franchise->id) }}" method="POST" class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Franchise Name -->
            <div class="mb-4">
                <label for="franchise_name" class="block text-gray-700 text-sm font-semibold mb-2">Franchise Name</label>
                <input type="text" name="franchise_name" value="{{old('franchise_name',$franchise->franchise_name)}}" id="franchise_name" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" >
            </div>

            <!-- Contact No -->
            <div class="mb-4">
                <label for="contact_no" class="block text-gray-700 text-sm font-semibold mb-2">Contact No</label>
                <input type="text" name="contact_no" id="contact_no"  value="{{old('contact_no',$franchise->contact_no)}}" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" >
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email</label>
                <input type="email" name="email" id="email"  value="{{old('email',$franchise->email)}}" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" >
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                <input type="password" name="password" id="password"  value="{{old('password',$franchise->password)}}" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" >
            </div>

            <!-- Aadhaar No -->
            <div class="mb-4">
                <label for="aadhaar_no" class="block text-gray-700 text-sm font-semibold mb-2">Aadhaar No</label>
                <input type="text" name="aadhaar_no" id="aadhaar_no"  value="{{old('aadhaar_no',$franchise->aadhaar_no)}}" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" >
            </div>

            <!-- PAN No -->
            <div class="mb-4">
                <label for="pan_no" class="block text-gray-700 text-sm font-semibold mb-2">PAN No</label>
                <input type="text" name="pan_no" id="pan_no"  value="{{old('pan_no',$franchise->pan_no)}}" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" >
            </div>

            <!-- IFSC Code -->
            <div class="mb-4">
                <label for="ifsc_code" class="block text-gray-700 text-sm font-semibold mb-2">IFSC Code</label>
                <input type="text" name="ifsc_code" id="ifsc_code"  value="{{old('ifsc_code',$franchise->ifsc_code)}}" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" >
            </div>

            <!-- Account No -->
            <div class="mb-4">
                <label for="account_no" class="block text-gray-700 text-sm font-semibold mb-2">Account No</label>
                <input type="text" name="account_no" id="account_no"  value="{{old('account_no',$franchise->account_no)}}" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" >
            </div>

            <!-- Street -->
            <div class="mb-4">
                <label for="street" class="block text-gray-700 text-sm font-semibold mb-2">Street</label>
                <input type="text" name="street" id="street"  value="{{old('street',$franchise->street)}}" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" >
            </div>

            <!-- City -->
            <div class="mb-4">
                <label for="city" class="block text-gray-700 text-sm font-semibold mb-2">City</label>
                <input type="text" name="city" id="city"  value="{{old('city',$franchise->city)}}" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" >
            </div>

            <!-- District -->
            <div class="mb-4">
                <label for="district" class="block text-gray-700 text-sm font-semibold mb-2">District</label>
                <input type="text" name="district" id="district"  value="{{old('district',$franchise->district)}}" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" >
            </div>

            <!-- Pincode -->
            <div class="mb-4">
                <label for="pincode" class="block text-gray-700 text-sm font-semibold mb-2">Pincode</label>
                <input type="text" name="pincode" id="pincode"  value="{{old('pincode',$franchise->pincode)}}" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" >
            </div>

            <!-- State -->
            <div class="mb-4">
                <label for="state" class="block text-gray-700 text-sm font-semibold mb-2">State</label>
                <input type="text" name="state" id="state"  value="{{old('state',$franchise->state)}}" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" >
            </div>

            <!-- Country -->
            <div class="mb-4">
                <label for="country" class="block text-gray-700 text-sm font-semibold mb-2">Country</label>
                <input type="text" name="country" id="country"  value="{{old('country',$franchise->country)}}" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" >
            </div>

            <!-- Date of Creation (DOC) -->
            <div class="mb-4">
                <label for="doc" class="block text-gray-700 text-sm font-semibold mb-2">Date of Creation (DOC)</label>
                <input type="date" name="doc" id="doc"  value="{{old('doc',$franchise->doc)}}" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" >
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="status" class="block text-gray-700 text-sm font-semibold mb-2">Status</label>
                <select name="status" id="status"  value="{{old('status',$franchise->status)}}" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500" >
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