@extends('layouts.guest')

@section('title', 'Guest Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <section class="px-2 md:px-0">
        <div class="w-full bg-gradient-to-r from-[#5E72E4] to-[#7f97ff] rounded-2xl h-40 shadow-md"></div>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 -mt-16">
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition hover:-translate-y-0.5">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center"><i class="ni ni-money-coins"></i></div>
                    <div class="flex-1">
                        <div class="text-xs font-semibold text-slate-500">TODAY'S MONEY</div>
                        <div class="text-2xl font-bold text-slate-800">$53,000</div>
                        <div class="text-xs text-emerald-500 font-semibold">+55% since yesterday</div>
                    </div>
                    <i class="ni ni-bold-right text-slate-300"></i>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition hover:-translate-y-0.5">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center"><i class="ni ni-single-02"></i></div>
                    <div class="flex-1">
                        <div class="text-xs font-semibold text-slate-500">TODAY'S USERS</div>
                        <div class="text-2xl font-bold text-slate-800">2,300</div>
                        <div class="text-xs text-emerald-500 font-semibold">+3% since last week</div>
                    </div>
                    <i class="ni ni-bold-right text-slate-300"></i>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition hover:-translate-y-0.5">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center"><i class="ni ni-circle-08"></i></div>
                    <div class="flex-1">
                        <div class="text-xs font-semibold text-slate-500">NEW CLIENTS</div>
                        <div class="text-2xl font-bold text-slate-800">+3,462</div>
                        <div class="text-xs text-rose-500 font-semibold">-2% since last quarter</div>
                    </div>
                    <i class="ni ni-bold-right text-slate-300"></i>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition hover:-translate-y-0.5">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center"><i class="ni ni-cart"></i></div>
                    <div class="flex-1">
                        <div class="text-xs font-semibold text-slate-500">SALES</div>
                        <div class="text-2xl font-bold text-slate-800">$103,430</div>
                        <div class="text-xs text-emerald-500 font-semibold">+5% than last month</div>
                    </div>
                    <i class="ni ni-bold-right text-slate-300"></i>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mt-6">
            <div class="xl:col-span-2 bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm font-semibold text-slate-700">Sales Overview</div>
                        <div class="text-xs text-slate-400">4% more in 2021</div>
                    </div>
                    <div class="text-slate-400"><i class="ni ni-bold-right"></i></div>
                </div>
                <div class="mt-4">
                    <canvas id="guestSalesChart" height="120"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="relative">
                    <img src="{{ asset('assets-admin-volt/img/curved-images/curved11.jpg') }}" class="w-full h-56 object-cover" alt="Argon">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                    <div class="absolute bottom-3 left-4 right-4">
                        <div class="text-white text-lg font-semibold">Get started with Argon</div>
                        <div class="text-white/90 text-sm">There's nothing I really wanted to do in life that I wasn't able to get good at.</div>
                    </div>
                </div>
                <div class="p-4 flex items-center justify-between">
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:shadow-md transition">Start now</button>
                    <div class="text-slate-400"><i class="ni ni-bold-right"></i></div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mt-6">
            <div class="xl:col-span-2 bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div class="text-sm font-semibold text-slate-700">Sales by Country</div>
                    <div class="text-slate-400"><i class="ni ni-bold-right"></i></div>
                </div>
                <div class="mt-4 overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                        <tr class="text-xs text-slate-400">
                            <th class="text-left font-semibold py-2">Country</th>
                            <th class="text-left font-semibold py-2">Sales</th>
                            <th class="text-left font-semibold py-2">Value</th>
                            <th class="text-left font-semibold py-2">Bounce</th>
                        </tr>
                        </thead>
                        <tbody class="text-sm text-slate-700">
                        <tr class="border-t">
                            <td class="py-3">
                                <div class="flex items-center gap-3">
                                    <span class="w-6 h-4 rounded-sm bg-gradient-to-br from-red-500 to-blue-600"></span>
                                    <span>United States</span>
                                </div>
                            </td>
                            <td class="py-3">2500</td>
                            <td class="py-3">$230,900</td>
                            <td class="py-3">29.9%</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-3">
                                <div class="flex items-center gap-3">
                                    <span class="w-6 h-4 rounded-sm bg-gradient-to-br from-black to-red-600"></span>
                                    <span>Germany</span>
                                </div>
                            </td>
                            <td class="py-3">3,900</td>
                            <td class="py-3">$440,000</td>
                            <td class="py-3">40.22%</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-3">
                                <div class="flex items-center gap-3">
                                    <span class="w-6 h-4 rounded-sm bg-gradient-to-br from-blue-700 to-red-600"></span>
                                    <span>Great Britain</span>
                                </div>
                            </td>
                            <td class="py-3">1,400</td>
                            <td class="py-3">$190,700</td>
                            <td class="py-3">23.44%</td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-3">
                                <div class="flex items-center gap-3">
                                    <span class="w-6 h-4 rounded-sm bg-gradient-to-br from-green-600 to-yellow-500"></span>
                                    <span>Brasil</span>
                                </div>
                            </td>
                            <td class="py-3">562</td>
                            <td class="py-3">$143,960</td>
                            <td class="py-3">32.14%</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div class="text-sm font-semibold text-slate-700">Categories</div>
                    <div class="text-slate-400"><i class="ni ni-bold-right"></i></div>
                </div>
                <ul class="mt-4 space-y-3">
                    <li class="flex items-center justify-between px-2 py-2 rounded-lg hover:bg-slate-50 transition">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center"><i class="ni ni-mobile-button"></i></span>
                            <div>
                                <div class="text-sm font-semibold text-slate-700">Devices</div>
                                <div class="text-xs text-slate-400">250 in stock, 346 sold</div>
                            </div>
                        </div>
                        <i class="ni ni-bold-right text-slate-300"></i>
                    </li>
                    <li class="flex items-center justify-between px-2 py-2 rounded-lg hover:bg-slate-50 transition">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center"><i class="ni ni-collection"></i></span>
                            <div>
                                <div class="text-sm font-semibold text-slate-700">Tickets</div>
                                <div class="text-xs text-slate-400">123 closed, 15 open</div>
                            </div>
                        </div>
                        <i class="ni ni-bold-right text-slate-300"></i>
                    </li>
                    <li class="flex items-center justify-between px-2 py-2 rounded-lg hover:bg-slate-50 transition">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center"><i class="ni ni-alert-circle-i"></i></span>
                            <div>
                                <div class="text-sm font-semibold text-slate-700">Error logs</div>
                                <div class="text-xs text-slate-400">1.2k issues, 40 closed</div>
                            </div>
                        </div>
                        <i class="ni ni-bold-right text-slate-300"></i>
                    </li>
                    <li class="flex items-center justify-between px-2 py-2 rounded-lg hover:bg-slate-50 transition">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center"><i class="ni ni-satisfied"></i></span>
                            <div>
                                <div class="text-sm font-semibold text-slate-700">Happy users</div>
                                <div class="text-xs text-slate-400">+80</div>
                            </div>
                        </div>
                        <i class="ni ni-bold-right text-slate-300"></i>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-6 text-xs text-slate-400">Distributed by ThemeWagon</div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const ctx = document.getElementById('guestSalesChart');
            if (!ctx || !window.Chart) return;
            const c = ctx.getContext('2d');
            const gradient = c.createLinearGradient(0, 0, 0, 200);
            gradient.addColorStop(0, 'rgba(94,114,228,0.3)');
            gradient.addColorStop(1, 'rgba(94,114,228,0)');
            new Chart(c, {
                type: 'line',
                data: {
                    labels: ['Apr','May','Jun','Jul','Aug','Sep','Oct','Nov'],
                    datasets: [{
                        label: 'Sales',
                        data: [50, 190, 160, 320, 260, 310, 270, 340],
                        borderColor: '#5E72E4',
                        backgroundColor: gradient,
                        tension: 0.4,
                        fill: true,
                        pointRadius: 3,
                        pointHoverRadius: 5,
                        borderWidth: 3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { grid: { display: false }, ticks: { color: '#9CA3AF' } },
                        y: { grid: { color: 'rgba(156,163,175,0.25)', drawBorder: false }, ticks: { color: '#9CA3AF', beginAtZero: true } }
                    }
                }
            });
        });
    </script>
@endpush
