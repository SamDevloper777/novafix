@extends('superadmin.layout')
@section('title', 'Dashboard')
@section('content')


    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                <div class="w-full p-4 sm:p-6 bg-white border border-gray-200 rounded-xl shadow-lg dark:bg-gray-800 dark:border-gray-700 hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between mb-3 sm:mb-4">
                        <!-- Icon Container -->
                        <div class="p-2 sm:p-3 bg-purple-100 dark:bg-purple-900/50 rounded-lg">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-gray-600 dark:text-gray-400" aria-hidden="true" 
                                 xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                 <path
                                 d="M18 5h-.7c.229-.467.349-.98.351-1.5a3.5 3.5 0 0 0-3.5-3.5c-1.717 0-3.215 1.2-4.331 2.481C8.4.842 6.949 0 5.5 0A3.5 3.5 0 0 0 2 3.5c.003.52.123 1.033.351 1.5H2a2 2 0 0 0-2 2v3a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V7a2 2 0 0 0-2-2ZM8.058 5H5.5a1.5 1.5 0 0 1 0-3c.9 0 2 .754 3.092 2.122-.219.337-.392.635-.534.878Zm6.1 0h-3.742c.933-1.368 2.371-3 3.739-3a1.5 1.5 0 0 1 0 3h.003ZM11 13H9v7h2v-7Zm-4 0H2v5a2 2 0 0 0 2 2h3v-7Zm6 0v7h3a2 2 0 0 0 2-2v-5h-5Z" />                            </svg>
                        </div>
            
                        <!-- Percentage Badge -->
                        <div class="flex items-center px-2 py-1 sm:px-3 sm:py-1 bg-green-100 dark:bg-green-900/30 rounded-full">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 text-green-600 dark:text-green-400 mr-1" aria-hidden="true" 
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                 d="M5 13V1m0 0L1 5m4-4 4 4" />                            </svg>
                            <span class="text-xs sm:text-sm font-medium text-green-600 dark:text-green-400">12%</span>
                        </div>
                    </div>
            
                    <h5 class="mb-1 sm:mb-2 text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">
                        Total Franchises
                    </h5>
            
                    <p class="text-gray-500 dark:text-gray-400 text-xs sm:text-sm mb-3 sm:mb-4">
                        Franchise network growth performance this month
                    </p>
            
                    <div class="flex items-center text-xs sm:text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline">
                        View detailed report
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 ml-1 sm:ml-2" aria-hidden="true" 
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                            <!-- ... your arrow icon path ... -->
                        </svg>
                    </div>
                </div>
                 <div class="w-full p-4 sm:p-6 bg-white border border-gray-200 rounded-xl shadow-lg dark:bg-gray-800 dark:border-gray-700 hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between mb-3 sm:mb-4">
                        <!-- Icon Container -->
                        <div class="p-2 sm:p-3 bg-purple-100 dark:bg-purple-900/50 rounded-lg">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-gray-600 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                             </svg></div>
            
                        <!-- Percentage Badge -->
                        <div class="flex items-center px-2 py-1 sm:px-3 sm:py-1 bg-green-100 dark:bg-green-900/30 rounded-full">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 text-green-600 dark:text-green-400 mr-1" aria-hidden="true" 
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                 d="M5 13V1m0 0L1 5m4-4 4 4" />                            </svg>
                            <span class="text-xs sm:text-sm font-medium text-green-600 dark:text-green-400">55%</span>
                        </div>
                    </div>
            
                    <h5 class="mb-1 sm:mb-2 text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">
                        Total Staff
                    </h5>
            
                    <p class="text-gray-500 dark:text-gray-400 text-xs sm:text-sm mb-3 sm:mb-4">
                        Franchise network growth performance this month
                    </p>
            
                    <div class="flex items-center text-xs sm:text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline">
                        View detailed report
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 ml-1 sm:ml-2" aria-hidden="true" 
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                            <!-- ... your arrow icon path ... -->
                        </svg>
                    </div>
                </div>
                 <div class="w-full p-4 sm:p-6 bg-white border border-gray-200 rounded-xl shadow-lg dark:bg-gray-800 dark:border-gray-700 hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between mb-3 sm:mb-4">
                        <!-- Icon Container -->
                        <div class="p-2 sm:p-3 bg-purple-100 dark:bg-purple-900/50 rounded-lg">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-gray-600 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                <path d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z"/>
                            </svg>
                        </div>
            
                        <!-- Percentage Badge -->
                        <div class="flex items-center px-2 py-1 sm:px-3 sm:py-1 bg-green-100 dark:bg-green-900/30 rounded-full">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 text-green-600 dark:text-green-400 mr-1" aria-hidden="true" 
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                 d="M5 13V1m0 0L1 5m4-4 4 4" />                            </svg>
                            <span class="text-xs sm:text-sm font-medium text-green-600 dark:text-green-400">78%</span>
                        </div>
                    </div>
            
                    <h5 class="mb-1 sm:mb-2 text-xl sm:text-2xl font-bold text-gray-900 dark:text-white">
                        Total Receptioner
                    </h5>
            
                    <p class="text-gray-500 dark:text-gray-400 text-xs sm:text-sm mb-3 sm:mb-4">
                        Franchise network growth performance this month
                    </p>
            
                    <div class="flex items-center text-xs sm:text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline">
                        View detailed report
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 ml-1 sm:ml-2" aria-hidden="true" 
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                            <!-- ... your arrow icon path ... -->
                        </svg>
                    </div>
                </div>
                
                <!-- Repeat other cards (same structure) -->
            </div>
            <div class="flex items-center justify-center h-48 mb-4 rounded-sm bg-gray-50 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">
                    <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 1v16M1 9h16" />
                    </svg>
                </p>
            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                <div class="md:col-span-2 bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4">
                        <div class="w-full md:w-auto">
                            Recent Franchises
                        </div>
                    </div>

                    <!-- Responsive Table Container -->
                    <div class="overflow-x-auto rounded-lg">
                        <!-- Simplified Table Structure -->
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-3 py-3">
                                        Franchise</th>
                                    <th scope="col" class="px-3 py-3 ">Location</th>
                                    <th scope="col" class="px-3 py-3">Status</th>
                                    <th scope="col" class="px-3 py-3">Revenue</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-3 py-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="font-medium text-gray-900 dark:text-white">Neil Sims</div>
                                        </div>

                                    </td>
                                    <td class="px-3 py-4 ">Purnea</td>
                                    <td class="px-3 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                            <span class="w-2 h-2 mr-1 bg-green-500 rounded-full"></span>
                                            Active
                                        </span>
                                    </td>
                                    <td class="px-3 py-4">
                                        Rs.4500
                                    </td>
                                </tr>
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-3 py-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="font-medium text-gray-900 dark:text-white">Neil Sims</div>
                                        </div>

                                    </td>
                                    <td class="px-3 py-4 ">Purnea</td>
                                    <td class="px-3 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                            <span class="w-2 h-2 mr-1 bg-rose-500 rounded-full"></span>
                                            InActive
                                        </span>
                                    </td>
                                    <td class="px-3 py-4">
                                        Rs.4500
                                    </td>
                                </tr>
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-3 py-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="font-medium text-gray-900 dark:text-white">Neil Sims</div>
                                        </div>

                                    </td>
                                    <td class="px-3 py-4 ">Purnea</td>
                                    <td class="px-3 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                            <span class="w-2 h-2 mr-1 bg-green-500 rounded-full"></span>
                                            Active
                                        </span>
                                    </td>
                                    <td class="px-3 py-4">
                                        Rs.4500
                                    </td>
                                </tr>
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-3 py-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="font-medium text-gray-900 dark:text-white">Neil Sims</div>
                                        </div>

                                    </td>
                                    <td class="px-3 py-4 ">Purnea</td>
                                    <td class="px-3 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                            <span class="w-2 h-2 mr-1 bg-rose-500 rounded-full"></span>
                                            InActive
                                        </span>
                                    </td>
                                    <td class="px-3 py-4">
                                        Rs.4500
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Side Card (Improved Responsiveness) -->
                <div
                    class="flex items-center justify-center rounded-lg bg-gray-50 dark:bg-gray-700 p-6 h-full min-h-[200px]">
                    <button class="text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                        <svg class="w-8 h-8" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 1v16M1 9h16" />
                        </svg>
                        <span class="sr-only">Add new item</span>
                    </button>
                </div>
            </div>




            <div class="flex items-center justify-center h-48 mb-4 rounded-sm bg-gray-50 dark:bg-gray-800">
                <p class="text-2xl text-gray-400 dark:text-gray-500">
                    <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 1v16M1 9h16" />
                    </svg>
                </p>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                        <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 1v16M1 9h16" />
                        </svg>
                    </p>
                </div>
                <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                        <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 1v16M1 9h16" />
                        </svg>
                    </p>
                </div>
                <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                        <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 1v16M1 9h16" />
                        </svg>
                    </p>
                </div>
                <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28 dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                        <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 1v16M1 9h16" />
                        </svg>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
