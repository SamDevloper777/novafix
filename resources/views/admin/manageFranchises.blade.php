@extends('admin.layout')
@section('title', 'Franchise')
@section('content')

<div class="mt-20 p-5">
    <form action="{{ route('admin.manageFranchises') }}" class="max-w-md mx-auto mb-5">
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="search" name="search" id="default-search"
                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Search State, city..." value="{{ request('search') }}" />
            <button type="submit"
                class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
        </div>
    </form>
    <div class="mx-4 overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-4 py-3 sm:px-6 whitespace-nowrap">Franchise ID</th>
                    <th scope="col" class="px-4 py-3 sm:px-6 whitespace-nowrap">Franchise Name</th>
                    <th scope="col" class="px-4 py-3 sm:px-6 whitespace-nowrap">Contact No</th>
                    <th scope="col" class="px-4 py-3 sm:px-6 whitespace-nowrap">Email</th>
                    <th scope="col" class="px-4 py-3 sm:px-6 whitespace-nowrap">Street</th>
                    <th scope="col" class="px-4 py-3 sm:px-6 whitespace-nowrap">City</th>
                    <th scope="col" class="px-4 py-3 sm:px-6 whitespace-nowrap">District</th>                   
                    <th scope="col" class="px-4 py-3 sm:px-6 whitespace-nowrap">Status</th>
                    <th scope="col" class="px-4 py-3 sm:px-6 whitespace-nowrap">Action</th>
                </tr>
            </thead>
            @foreach ($franchises as $item)
                <tbody>
                    <tr class="bg-white border-b">
                        <th scope="row" class="px-4 py-4 sm:px-6 font-medium text-gray-900 whitespace-nowrap">
                            {{$item->id}}
                        </th>
                        <th scope="row" class="px-4 py-4 sm:px-6 font-medium text-gray-900 whitespace-nowrap">
                            {{$item->franchise_name}}
                        </th>
                        <td class="px-4 py-4 sm:px-6 whitespace-nowrap">{{$item->contact_no}}</td>
                        <td class="px-4 py-4 sm:px-6 whitespace-nowrap">{{$item->email}}</td>
                        <td class="px-4 py-4 sm:px-6 whitespace-nowrap">{{$item->street}}</td>
                        <td class="px-4 py-4 sm:px-6 whitespace-nowrap">{{$item->city}}</td>
                        <td class="px-4 py-4 sm:px-6 whitespace-nowrap">{{$item->district}}</td>
                        <td>
                            <form action="{{ route('admin.mangaetoggleStatus', $item->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="bg-{{ $item->status === 'Active' ? 'green' : 'red' }}-500 text-white p-2 rounded-sm text-sm">
                                    {{ $item->status === 'Active' ? 'Deactivate' : 'Activate' }}
                                </button>
                            </form>
                        </td>
                        <td class="px-4 flex py-4 items-center gap-2 sm:px-6 whitespace-nowrap">
                            <a href="{{route('admin.edit', $item->id)}}"
                                class="font-medium text-blue-600 hover:underline">Edit</a>
                            <a href="{{route('admin.view', $item->id)}}"
                                class="font-medium text-blue-600 hover:underline">View</a>
                            <form action="{{ route('admin.delete', $item->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this franchise?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 font-bold rounded">X</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>
</div>

@endsection
