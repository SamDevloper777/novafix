@extends('superadmin.layout')
@section('title', 'franchise')
@section('content')


<form class="max-w-4xl bg-white mt-20 mx-4 md:ml-64 lg:mx-auto p-6 shadow-lg rounded-lg">
    <!-- Franchise Selection Dropdown -->
    <div class="relative z-0 w-full mb-8 group">
        <select id="franchise_select" class="block py-2.5 px-4 w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            <option selected>Select Franchise</option>
            <option value="new">+ Create New Franchise</option>
            <option value="1">Paris Main Branch</option>
            <option value="2">Lyon South Branch</option>
            <option value="3">Marseille Coastal Branch</option>
        </select>
        <label for="franchise_select" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 left-3 bg-white dark:bg-gray-800 px-1">Manage Franchise</label>
    </div>

    <!-- Franchise Details Section -->
    <div class="grid gap-6 mb-6 md:grid-cols-2">
        <!-- Franchise Information -->
        <div class="space-y-4">
            <div class="relative z-0 w-full group">
                <input type="text" name="franchise_name" id="franchise_name" 
                       class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" 
                       placeholder=" " required />
                <label for="franchise_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Franchise Name</label>
            </div>

            <div class="relative z-0 w-full group">
                <input type="text" name="franchise_location" id="franchise_location" 
                       class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" 
                       placeholder=" " required />
                <label for="franchise_location" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Location</label>
            </div>

            <div class="relative z-0 w-full group">
                <input type="text" name="franchise_id" id="franchise_id" 
                       class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" 
                       placeholder=" " pattern="FR-\d{4}" required />
                <label for="franchise_id" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Franchise ID (FR-1234)</label>
            </div>
        </div>

        <!-- Admin Controls -->
        <div class="space-y-4">
            <div class="relative z-0 w-full group">
                <select id="franchise_status" class="block py-2.5 px-4 w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="pending">Pending Approval</option>
                </select>
                <label for="franchise_status" class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 left-3 bg-white dark:bg-gray-800 px-1">Status</label>
            </div>

            <div class="relative z-0 w-full group">
                <input type="email" name="manager_email" id="manager_email" 
                       class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" 
                       placeholder=" " required />
                <label for="manager_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Manager Email</label>
            </div>

            <div class="relative z-0 w-full group">
                <input type="date" name="contract_date" id="contract_date" 
                       class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" 
                       required />
                <label for="contract_date" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Contract Date</label>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4">
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Save Changes
        </button>
        
        <button type="button" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
            Delete Franchise
        </button>
        
        <button type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm w-full px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
            View Reports
        </button>
    </div>

    <!-- Superadmin Notes -->
    <div class="mt-6">
        <label for="admin_notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Administration Notes</label>
        <textarea id="admin_notes" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Add private notes visible only to superadmins..."></textarea>
    </div>
</form>
  
@endsection