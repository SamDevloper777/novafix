@extends('admin.layout')
@section('title', 'Dashboard')
@section('content')
    <div class="p-4">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg mt-14">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                <div
                    class="w-full p-4 sm:p-6 bg-white border border-gray-200 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between mb-3 sm:mb-4">
                        <!-- Icon Container -->
                        <div class="p-2 sm:p-3 bg-purple-100 rounded-lg">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-gray-600" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M18 5h-.7c.229-.467.349-.98.351-1.5a3.5 3.5 0 0 0-3.5-3.5c-1.717 0-3.215 1.2-4.331 2.481C8.4.842 6.949 0 5.5 0A3.5 3.5 0 0 0 2 3.5c.003.52.123 1.033.351 1.5H2a2 2 0 0 0-2 2v3a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V7a2 2 0 0 0-2-2ZM8.058 5H5.5a1.5 1.5 0 0 1 0-3c.9 0 2 .754 3.092 2.122-.219.337-.392.635-.534.878Zm6.1 0h-3.742c.933-1.368 2.371-3 3.739-3a1.5 1.5 0 0 1 0 3h.003ZM11 13H9v7h2v-7Zm-4 0H2v5a2 2 0 0 0 2 2h3v-7Zm6 0v7h3a2 2 0 0 0 2-2v-5h-5Z" />
                            </svg>
                        </div>

                        <!-- Percentage Badge -->
                        <div class="flex items-center px-2 py-1 sm:px-3 sm:py-1 bg-green-100 rounded-full">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 text-green-600 mr-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13V1m0 0L1 5m4-4 4 4" />
                            </svg>
                            <span class="text-xs sm:text-sm font-medium text-green-600">12%</span>
                        </div>
                    </div>

                    <h5 class="mb-1 sm:mb-2 text-xl sm:text-2xl font-bold text-gray-900">
                        Total Franchises ({{ $counts->franchiseCount }})
                    </h5>

                    <p class="text-gray-500 text-xs sm:text-sm mb-3 sm:mb-4">
                        Franchise network growth performance this month
                    </p>

                    <div class="flex items-center text-xs sm:text-sm font-medium text-purple-600 hover:underline">
                        View detailed report
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 ml-1 sm:ml-2" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                            <!-- Arrow icon path -->
                        </svg>
                    </div>
                </div>

                <div
                    class="w-full p-4 sm:p-6 bg-white border border-gray-200 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex items-center justify-between mb-3 sm:mb-4">
                        <!-- Icon Container -->
                        <div class="p-2 sm:p-3 bg-purple-100 rounded-lg">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-gray-600" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                <path
                                    d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                            </svg>
                        </div>

                        <!-- Percentage Badge -->
                        <div
                            class="flex items-center px-2 py-1 sm:px-3 sm:py-1 bg-green-100 rounded-full">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 text-green-600 mr-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13V1m0 0L1 5m4-4 4 4" />
                            </svg>
                            <span class="text-xs sm:text-sm font-medium text-green-600">55%</span>
                        </div>
                    </div>

                    <h5 class="mb-1 sm:mb-2 text-xl sm:text-2xl font-bold text-gray-900">
                        Total Staff ({{ $counts->staffCount }})
                    </h5>

                    <p class="text-gray-500 text-xs sm:text-sm mb-3 sm:mb-4">
                        Franchise network growth performance this month
                    </p>

                    <div
                        class="flex items-center text-xs sm:text-sm font-medium text-purple-600 hover:underline">
                        View detailed report
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 ml-1 sm:ml-2" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                            <!-- ... your arrow icon path ... -->
                        </svg>
                    </div>
                </div>
                <div
                class="w-full p-4 sm:p-6 bg-white border border-gray-200 rounded-xl shadow-lg hover:shadow-xl transition-shadow">
                <div class="flex items-center justify-between mb-3 sm:mb-4">
                    <!-- Icon Container -->
                    <div class="p-2 sm:p-3 bg-purple-100 rounded-lg">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 18">
                            <path
                                d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
                        </svg>
                    </div>
            
                    <!-- Percentage Badge -->
                    <div class="flex items-center px-2 py-1 sm:px-3 sm:py-1 bg-green-100 rounded-full">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 text-green-600 mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 10 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13V1m0 0L1 5m4-4 4 4" />
                        </svg>
                        <span class="text-xs sm:text-sm font-medium text-green-600">78%</span>
                    </div>
                </div>
            
                <h5 class="mb-1 sm:mb-2 text-xl sm:text-2xl font-bold text-gray-900">
                    Total Receptioner ({{ $counts->receptionerCount }})
                </h5>
            
                <p class="text-gray-500 text-xs sm:text-sm mb-3 sm:mb-4">
                    Franchise network growth performance this month
                </p>
            
                <div class="flex items-center text-xs sm:text-sm font-medium text-purple-600 hover:underline">
                    View detailed report
                    <svg class="w-3 h-3 sm:w-4 sm:h-4 ml-1 sm:ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 18 18">
                        <!-- ... your arrow icon path ... -->
                    </svg>
                </div>
            </div>
            

                <!-- Repeat other cards (same structure) -->
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                <div class="md:col-span-2 bg-white rounded-lg shadow-sm p-4">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4">
                        <div class="w-full md:w-auto">Recent Franchises</div>
                    </div>
            
                    <div class="overflow-x-auto rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-3 py-3">Franchise</th>
                                    <th scope="col" class="px-3 py-3">Location</th>
                                    <th scope="col" class="px-3 py-3">Status</th>
                                    <th scope="col" class="px-3 py-3">Revenue</th>
                                </tr>
                            </thead>
                            @foreach ($franchises as $item)
                            <tbody>
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-3 py-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="font-medium text-gray-900">{{ $item->franchise_name }}</div>
                                        </div>
                                    </td>
                                    <td class="px-3 py-4">{{ $item->district }}</td>
                                    <td>
                                        <form action="{{ route('admin.toggleStatus', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="p-2 rounded text-white {{ $item->status === 'Active' ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600' }}">
                                                {{ $item->status === 'Active' ? 'Deactivate' : 'Activate' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-3 py-4">Rs.4500</td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            
                <div class="max-w-sm w-full bg-white rounded-lg shadow-sm p-4 md:p-6">
                    <div class="flex justify-between items-start w-full">
                        <div class="flex-col items-center">
                            <div class="flex items-center mb-1">
                                <h5 class="text-xl font-bold leading-none text-gray-900 me-1">Website traffic</h5>
                                <svg class="w-3.5 h-3.5 text-gray-500 hover:text-gray-900 cursor-pointer ms-1" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z" />
                                </svg>
                            </div>
                            <button id="dateRangeButton" data-dropdown-toggle="dateRangeDropdown" type="button"
                                class="inline-flex items-center text-blue-700 font-medium hover:underline">31 Nov - 31 Dev <svg
                                    class="w-3 h-3 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m1 1 4 4 4-4" />
                                </svg>
                            </button>
                        </div>
                    </div>
            
                    <div class="py-6" id="pie-chart"></div>
                </div>
            </div>

            <div class="flex items-center justify-center h-48 mb-4 rounded-sm bg-gray-50">
                <p class="text-2xl text-gray-400">
                    <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 1v16M1 9h16" />
                    </svg>
                </p>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28">
                    <p class="text-2xl text-gray-400">
                        <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 1v16M1 9h16" />
                        </svg>
                    </p>
                </div>
                <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28">
                    <p class="text-2xl text-gray-400">
                        <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 1v16M1 9h16" />
                        </svg>
                    </p>
                </div>
                <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28">
                    <p class="text-2xl text-gray-400">
                        <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 1v16M1 9h16" />
                        </svg>
                    </p>
                </div>
                <div class="flex items-center justify-center rounded-sm bg-gray-50 h-28">
                    <p class="text-2xl text-gray-400">
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
    <script>
        const getChartOptions = () => {
            return {
                series: [52.8, 26.8, 20.4],
                colors: ["#1C64F2", "#16BDCA", "#9061F9"],
                chart: {
                    height: 420,
                    width: "100%",
                    type: "pie",
                },
                stroke: {
                    colors: ["white"],
                    lineCap: "",
                },
                plotOptions: {
                    pie: {
                        labels: {
                            show: true,
                        },
                        size: "100%",
                        dataLabels: {
                            offset: -25
                        }
                    },
                },
                labels: ["Direct", "Organic search", "Referrals"],
                dataLabels: {
                    enabled: true,
                    style: {
                        fontFamily: "Inter, sans-serif",
                    },
                },
                legend: {
                    position: "bottom",
                    fontFamily: "Inter, sans-serif",
                },
                yaxis: {
                    labels: {
                        formatter: function(value) {
                            return value + "%"
                        },
                    },
                },
                xaxis: {
                    labels: {
                        formatter: function(value) {
                            return value + "%"
                        },
                    },
                    axisTicks: {
                        show: false,
                    },
                    axisBorder: {
                        show: false,
                    },
                },
            }
        }

        if (document.getElementById("pie-chart") && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById("pie-chart"), getChartOptions());
            chart.render();
        }
    </script>
@endsection
