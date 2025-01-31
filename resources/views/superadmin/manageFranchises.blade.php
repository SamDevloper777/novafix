@extends('superadmin.layout')
@section('title', 'franchise')
@section('content')



<div class="mt-20 mx-4 md:ml-64 lg:ml-72 xl:ml-80 overflow-x-auto">
 
        
    <form class="max-w-md mx-auto mb-5">   
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search State, city..." required />
            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
        </div>
    </form>
  
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-4 py-3 sm:px-6 whitespace-nowrap">
                    Franchises name
                </th>
                <th scope="col" class="px-4 py-3 sm:px-6 whitespace-nowrap">
                    State
                </th>
                <th scope="col" class="px-4 py-3 sm:px-6 whitespace-nowrap">
                    City
                </th>
                <th scope="col" class="px-4 py-3 sm:px-6 whitespace-nowrap">
                    Location
                </th>
                 <th scope="col" class="px-4 py-3 sm:px-6 whitespace-nowrap">
                    Franchises ID
                </th> 
                <th scope="col" class="px-4 py-3 sm:px-6 whitespace-nowrap">
                    Status
                </th>
                <th scope="col" class="px-4 py-3 sm:px-6 whitespace-nowrap">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-4 py-4 sm:px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                   Nikita Mahlotra
                </th>
                <td class="px-4 py-4 sm:px-6 whitespace-nowrap">
                    Bihar
                </td>
                <td class="px-4 py-4 sm:px-6 whitespace-nowrap">
                    Purnea
                </td>
                <td class="px-4 py-4 sm:px-6 whitespace-nowrap">
                    Bhattha bazar purnea
                </td>
                <td class="px-4 py-4 sm:px-6 whitespace-nowrap">
                    365-66-55
                </td>
                <td class="px-4 py-4 sm:px-6 whitespace-nowrap">
                    <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                            
                                            InActive
                                        </span>
                </td>
                <td class="px-4 py-4 sm:px-6 whitespace-nowrap">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>

                </td>
            </tr>
           <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-4 py-4 sm:px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                   Nikita Mahlotra
                </th>
                <td class="px-4 py-4 sm:px-6 whitespace-nowrap">
                    Bihar
                </td>
                <td class="px-4 py-4 sm:px-6 whitespace-nowrap">
                    Purnea
                </td>
                <td class="px-4 py-4 sm:px-6 whitespace-nowrap">
                    Bhattha bazar purnea
                </td>
                <td class="px-4 py-4 sm:px-6 whitespace-nowrap">
                    365-66-55
                </td>
                <td class="px-4 py-4 sm:px-6 whitespace-nowrap">
                    <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                            
                                            InActive
                                        </span>
                </td>
                <td class="px-4 py-4 sm:px-6 whitespace-nowrap">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>

                </td>
            </tr>
           <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-4 py-4 sm:px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                   Nikita Mahlotra
                </th>
                <td class="px-4 py-4 sm:px-6 whitespace-nowrap">
                    Bihar
                </td>
                <td class="px-4 py-4 sm:px-6 whitespace-nowrap">
                    Purnea
                </td>
                <td class="px-4 py-4 sm:px-6 whitespace-nowrap">
                    Bhattha bazar purnea
                </td>
                <td class="px-4 py-4 sm:px-6 whitespace-nowrap">
                    365-66-55
                </td>
                <td class="px-4 py-4 sm:px-6 whitespace-nowrap">
                    <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                            
                                            InActive
                                        </span>
                </td>
                <td class="px-4 py-4 sm:px-6 whitespace-nowrap">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>

                </td>
            </tr>
           <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-4 py-4 sm:px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                   Nikita Mahlotra
                </th>
                <td class="px-4 py-4 sm:px-6 whitespace-nowrap">
                    Bihar
                </td>
                <td class="px-4 py-4 sm:px-6 whitespace-nowrap">
                    Purnea
                </td>
                <td class="px-4 py-4 sm:px-6 whitespace-nowrap">
                    Bhattha bazar purnea
                </td>
                <td class="px-4 py-4 sm:px-6 whitespace-nowrap">
                    365-66-55
                </td>
                <td class="px-4 py-4 sm:px-6 whitespace-nowrap">
                    <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                            
                                            Active
                                        </span>
                </td>
                <td class="px-4 py-4 sm:px-6 whitespace-nowrap">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>

                </td>
            </tr>
           
        </tbody>
    </table>
</div>

  
@endsection