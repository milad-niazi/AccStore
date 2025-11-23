{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin') {{-- مطمئن شو لایوت admin داری --}}

@section('content')
    <div class="p-6 bg-gray-100 min-h-screen">

        <h1 class="text-2xl font-bold mb-6">داشبورد ادمین</h1>

        {{-- آمار کاربران --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">کل کاربران</h2>
                <p class="text-2xl">{{ $totalUsers }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">کاربران فعال</h2>
                <p class="text-2xl">{{ $activeUsers }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">کاربران جدید هفته گذشته</h2>
                <p class="text-2xl">{{ $newUsersLastWeek }}</p>
            </div>
        </div>

        {{-- آمار اکانت‌ها --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">کل اکانت‌ها</h2>
                <p class="text-2xl">{{ $totalAccounts }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">اکانت‌های فروخته شده</h2>
                <p class="text-2xl">{{ $soldAccounts }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">اکانت‌های جدید هفته اخیر</h2>
                <p class="text-2xl">{{ $newAccountsLastWeek }}</p>
            </div>
        </div>

        {{-- آمار سفارش‌ها --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">کل سفارش‌ها</h2>
                <p class="text-2xl">{{ $totalOrders }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">سفارش‌های تکمیل شده</h2>
                <p class="text-2xl">{{ $completedOrders }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">سفارش‌های در انتظار</h2>
                <p class="text-2xl">{{ $pendingOrders }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">مجموع درآمد</h2>
                <p class="text-2xl">{{ number_format($totalRevenue, 2) }} تومان</p>
            </div>
        </div>

        {{-- نمودارها --}}
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold mb-4">نمودار روند ثبت سفارش‌ها</h2>
            <canvas id="ordersChart"></canvas>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('ordersChart').getContext('2d');
        const ordersChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['هفته قبل', '6 روز پیش', '5 روز پیش', '4 روز پیش', '3 روز پیش', '2 روز پیش', 'دیروز',
                    'امروز'
                ],
                datasets: [{
                    label: 'تعداد سفارش‌ها',
                    data: [5, 7, 6, 10, 8, 9, 12, 15], // این مقادیر می‌تونه از ریپازیتوری بیاد
                    borderColor: 'rgba(34, 197, 94, 1)',
                    backgroundColor: 'rgba(34, 197, 94, 0.2)',
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
