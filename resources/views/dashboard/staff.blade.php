@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard overview')

@section('page-description', 'Live system summary')

@section('content')

    <div class="p-8 space-y-6">

        <!-- Top Banner -->
        <div class="bg-[#0b1329] text-white p-6 rounded-2xl flex flex-col md:flex-row justify-between items-start md:items-center gap-4 shadow-lg">
            <div>
                <h1 class="text-xl font-bold">Good morning, Alex</h1>
                <p class="text-slate-400 text-sm mt-1">All systems are operational. 214 bookings are currently active across 8 locations.</p>
            </div>
            <button class="bg-blue-600 hover:bg-blue-500 text-white text-sm font-medium px-4 py-2.5 rounded-xl transition flex items-center gap-2 shadow-sm">
                <i class="fa-solid fa-file-lines"></i> View system report
            </button>
        </div>

        <!-- 4 Metric Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Total Users -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
                <div class="flex justify-between items-start text-slate-500 text-sm">
                    Total Users
                    <span class="p-2.5 bg-blue-50 text-blue-600 rounded-xl"><i class="fa-solid fa-users"></i></span>
                </div>
                <div class="text-3xl font-bold text-slate-900 mt-2">2,846</div>
                <div class="text-xs text-blue-600 font-semibold mt-2">+12.5%</div>
            </div>

            <!-- Available Lockers -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
                <div class="flex justify-between items-start text-slate-500 text-sm">
                    Available Lockers
                    <span class="p-2.5 bg-emerald-50 text-emerald-600 rounded-xl"><i class="fa-solid fa-lock-open"></i></span>
                </div>
                <div class="text-3xl font-bold text-slate-900 mt-2">384</div>
                <div class="text-xs text-emerald-600 font-semibold mt-2">62% of fleet</div>
            </div>

            <!-- Occupied Lockers -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
                <div class="flex justify-between items-start text-slate-500 text-sm">
                    Occupied Lockers
                    <span class="p-2.5 bg-rose-50 text-rose-600 rounded-xl"><i class="fa-solid fa-lock"></i></span>
                </div>
                <div class="text-3xl font-bold text-slate-900 mt-2">196</div>
                <div class="text-xs text-rose-600 font-semibold mt-2">32% of fleet</div>
            </div>

            <!-- Active Bookings -->
            <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
                <div class="flex justify-between items-start text-slate-500 text-sm">
                    Active Bookings
                    <span class="p-2.5 bg-purple-50 text-purple-600 rounded-xl"><i class="fa-solid fa-calendar-check"></i></span>
                </div>
                <div class="text-3xl font-bold text-slate-900 mt-2">214</div>
                <div class="text-xs text-purple-600 font-semibold mt-2">+8 today</div>
            </div>
        </div>

        <!-- Middle Section: Usage Bar & Location Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <!-- Locker Usage Card -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between">
               <div>
                    <div class="flex justify-between items-center mb-1">
                        <h2 class="font-bold text-slate-800">Locker usage</h2>
                        <span class="text-xs text-slate-500 bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-200 cursor-pointer hover:bg-slate-100 transition">Today <i class="fa-solid fa-chevron-down text-[10px] ml-1"></i></span>
                    </div>
                    <p class="text-xs text-slate-400 mb-6">Fleet status across all locations</p>
                    
                    <!-- Status Segmented Bar -->
                    <div class="flex h-3 w-full rounded-full overflow-hidden gap-1 mb-6 bg-slate-100">
                        <div class="bg-emerald-500 rounded-l-full" style="width: 50%" title="Available"></div>
                        <div class="bg-rose-500" style="width: 30%" title="Occupied"></div>
                        <div class="bg-blue-500" style="width: 12%" title="Reserved"></div>
                        <div class="bg-amber-500 rounded-r-full" style="width: 8%" title="Maintenance"></div>
                    </div>
               </div>

                <!-- Legend Grid -->
                <div class="grid grid-cols-2 gap-y-3 text-sm pt-4 border-t border-slate-100">
                    <div class="flex items-center gap-2.5 text-slate-600">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span> Available 
                        <span class="ml-auto font-bold text-slate-900">384</span>
                    </div>
                    <div class="flex items-center gap-2.5 text-slate-600">
                        <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span> Occupied 
                        <span class="ml-auto font-bold text-slate-900">196</span>
                    </div>
                    <div class="flex items-center gap-2.5 text-slate-600">
                        <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span> Reserved 
                        <span class="ml-auto font-bold text-slate-900">41</span>
                    </div>
                    <div class="flex items-center gap-2.5 text-slate-600">
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span> Maintenance 
                        <span class="ml-auto font-bold text-slate-900">23</span>
                    </div>
                </div>
            </div>

            <!-- Location Activity Card -->
            <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="font-bold text-slate-800">Location activity</h2>
                        <a href="#" class="text-xs text-blue-600 font-semibold hover:underline">View all locations</a>
                    </div>

                    <div class="space-y-4">
                        <!-- Location Item -->
                        <div class="flex items-center justify-between pb-3.5 border-b border-slate-100 last:border-0 last:pb-0">
                            <div class="flex items-center gap-3">
                                <div class="p-2.5 bg-blue-50 text-blue-600 rounded-xl"><i class="fa-solid fa-location-dot"></i></div>
                                <div>
                                    <h4 class="text-sm font-bold text-slate-800">Central Station</h4>
                                    <p class="text-xs text-slate-400">148 / 180 lockers in use</p>
                                </div>
                            </div>
                            <span class="text-sm font-bold text-slate-900">82%</span>
                        </div>

                        <!-- Location Item -->
                        <div class="flex items-center justify-between pb-3.5 border-b border-slate-100 last:border-0 last:pb-0">
                            <div class="flex items-center gap-3">
                                <div class="p-2.5 bg-blue-50 text-blue-600 rounded-xl"><i class="fa-solid fa-location-dot"></i></div>
                                <div>
                                    <h4 class="text-sm font-bold text-slate-800">Riverside Mall</h4>
                                    <p class="text-xs text-slate-400">96 / 140 lockers in use</p>
                                </div>
                            </div>
                            <span class="text-sm font-bold text-slate-900">69%</span>
                        </div>

                        <!-- Location Item -->
                        <div class="flex items-center justify-between pb-3.5 border-b border-slate-100 last:border-0 last:pb-0">
                            <div class="flex items-center gap-3">
                                <div class="p-2.5 bg-blue-50 text-blue-600 rounded-xl"><i class="fa-solid fa-location-dot"></i></div>
                                <div>
                                    <h4 class="text-sm font-bold text-slate-800">North Campus</h4>
                                    <p class="text-xs text-slate-400">82 / 128 lockers in use</p>
                                </div>
                            </div>
                            <span class="text-sm font-bold text-slate-900">64%</span>
                        </div>

                        <!-- Location Item -->
                        <div class="flex items-center justify-between pb-3.5 border-b border-slate-100 last:border-0 last:pb-0">
                            <div class="flex items-center gap-3">
                                <div class="p-2.5 bg-blue-50 text-blue-600 rounded-xl"><i class="fa-solid fa-location-dot"></i></div>
                                <div>
                                    <h4 class="text-sm font-bold text-slate-800">Airport Terminal</h4>
                                    <p class="text-xs text-slate-400">61 / 104 lockers in use</p>
                                </div>
                            </div>
                            <span class="text-sm font-bold text-slate-900">59%</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Recent Bookings Table -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border-b border-slate-100">
                <div>
                    <h3 class="font-bold text-slate-800">Recent bookings</h3>
                    <p class="text-xs text-slate-400">Latest locker activity and usage</p>
                </div>
                <button class="border border-slate-200 text-xs font-semibold px-3.5 py-2 rounded-xl hover:bg-slate-50 transition text-slate-600">View all bookings</button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-slate-400 text-xs border-b border-slate-100 bg-slate-50/50">
                            <th class="p-4 font-medium">Booking ID</th>
                            <th class="p-4 font-medium">User</th>
                            <th class="p-4 font-medium">Locker</th>
                            <th class="p-4 font-medium">Location</th>
                            <th class="p-4 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-slate-100 text-slate-700">
                        <!-- Row 1 -->
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="p-4 font-semibold text-blue-600">BK-10482</td>
                            <td class="p-4">Maya Chen</td>
                            <td class="p-4">L-024</td>
                            <td class="p-4">Central Station</td>
                            <td class="p-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-600">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active
                                </span>
                            </td>
                        </tr>
                        <!-- Row 2 -->
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="p-4 font-semibold text-blue-600">BK-10481</td>
                            <td class="p-4">Noah Williams</td>
                            <td class="p-4">L-118</td>
                            <td class="p-4">Riverside Mall</td>
                            <td class="p-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-600">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active
                                </span>
                            </td>
                        </tr>
                        <!-- Row 3 -->
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="p-4 font-semibold text-blue-600">BK-10479</td>
                            <td class="p-4">Sofia Patel</td>
                            <td class="p-4">L-207</td>
                            <td class="p-4">North Campus</td>
                            <td class="p-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-600">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Completed
                                </span>
                            </td>
                        </tr>
                        <!-- Row 4 -->
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="p-4 font-semibold text-blue-600">BK-10476</td>
                            <td class="p-4">Ethan Brown</td>
                            <td class="p-4">L-063</td>
                            <td class="p-4">Central Station</td>
                            <td class="p-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-600">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Active
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection