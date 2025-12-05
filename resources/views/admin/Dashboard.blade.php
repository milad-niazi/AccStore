{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('content')
    <div class="p-6 bg-gray-100 min-h-screen">

        <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

        {{-- آمار کاربران --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">Total Users</h2>
                <p class="text-2xl">{{ $totalUsers }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">Active Users</h2>
                <p class="text-2xl">{{ $activeUsers }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">New Users of Last Week</h2>
                <p class="text-2xl">{{ $newUsersLastWeek }}</p>
            </div>
        </div>

        {{-- آمار اکانت‌ها --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">Total Accounts</h2>
                <p class="text-2xl">{{ $totalAccounts }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">Total accounts sold</h2>
                <p class="text-2xl">{{ $soldAccounts }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">New accounts last week</h2>
                <p class="text-2xl">{{ $newAccountsLastWeek }}</p>
            </div>
        </div>

        {{-- آمار سفارش‌ها --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">Total Orders</h2>
                <p class="text-2xl">{{ $totalOrders }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">Completed orders</h2>
                <p class="text-2xl">{{ $completedOrders }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">Pending orders</h2>
                <p class="text-2xl">{{ $pendingOrders }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">Total income</h2>
                <p class="text-2xl">{{ number_format($totalRevenue, 2) }} Toman</p>
            </div>
        </div>

        {{-- diagram --}}
        {{-- <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold mb-4">Order registration process diagram</h2>
            <canvas id="ordersChart"></canvas>
        </div>
    </div> --}}
@endsection

@section('scripts')
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('ordersChart').getContext('2d');
        const ordersChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Last week', '6 days ago', '5 days ago', '4 days ago', '3 days ago', '2 days ago',
                    'yesterday',
                    'today'
                ],
                datasets: [{
                    label: 'Number of orders',
                    data: [5, 7, 6, 10, 8, 9, 12, 15],
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
    </script> --}}
@endsection
