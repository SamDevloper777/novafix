@extends('admin.layout')
@section('title', 'ManageReceptioner')
@section('content')

<div class="mt-10 p-5">
    <form action="{{ route('admin.manageReceptioner') }}" class="max-w-4xl py-8 rounded-xl transition-shadow duration-300">
        <div class="flex flex-col sm:flex-row items-start sm:items-end gap-4">
            <div class="flex-grow w-full sm:w-auto">
                <label for="default-search" class="sr-only">Search Receptioner</label>
                <div class="relative">
                    <input type="search" name="search" id="default-search"
                        class="w-full p-3.5 pl-10 text-sm text-gray-900 border border-gray-200 rounded-xl bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                        placeholder="Search Staff..." value="{{ request('search') }}" />
                    <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <div class="flex-grow w-full sm:w-auto">
                <label for="franchise_id" class="block text-sm font-medium text-gray-700 mb-2">Franchise</label>
                <select name="franchise_id" id="franchise_id"
                    class="w-full p-3 text-sm text-gray-900 border border-gray-200 rounded-xl bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                    <option value="">All Franchise</option>
                    @foreach($franchises as $franchise)
                        <option value="{{ $franchise->id }}" {{ request('franchise_id') == $franchise->id ? 'selected' : '' }}>
                            {{ $franchise->franchise_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex-grow-0 w-full sm:w-auto">
                <button type="submit"
                    class="p-3 w-full sm:w-auto rounded text-white bg-blue-600 hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:outline-none font-medium text-sm transition-all duration-200">
                    Search
                </button>
            </div>
        </div>
    </form>

    <!-- Receptioner Table -->
    <div class="mx-auto max-w-7xl bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Receptioner Id
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Receptioner Name
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Contact No
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Receptioner Salary
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Franchise Name
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($receptioners as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $item->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $item->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->contact }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->email }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->salary }}
                            </td> 
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->franchise?->franchise_name }}
                            </td>                           
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
