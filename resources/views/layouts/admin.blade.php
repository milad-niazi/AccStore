<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل ادمین</title>
    {{-- اضافه کردن Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    @yield('styles')
</head>

<body class="bg-gray-100 font-sans">

    <div class="flex min-h-screen bg-gray-100">
        {{-- Sidebar --}}
        <aside class="w-64 bg-white shadow-md">
            <div class="p-6 text-xl font-bold border-b">Admin Panel</div>
            <nav class="mt-6">
                <ul class="flex flex-col gap-2">
                    <li>
                        <a href="{{ route('admin.dashboard.index') }}"
                            class="block px-6 py-3 rounded hover:bg-gray-200 {{ request()->routeIs('admin.dashboard.*') ? 'bg-gray-200' : '' }}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}"
                            class="block px-6 py-3 rounded hover:bg-gray-200 {{ request()->routeIs('admin.users.*') ? 'bg-gray-200' : '' }}">
                            Users
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.index') }}"
                            class="block px-6 py-3 rounded hover:bg-gray-200 {{ request()->routeIs('admin.categories.*') ? 'bg-gray-200' : '' }}">
                            Categories
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.accounts.index') }}"
                            class="block px-6 py-3 rounded hover:bg-gray-200 {{ request()->routeIs('admin.accounts.*') ? 'bg-gray-200' : '' }}">
                            Accounts
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.orders.index') }}"
                            class="block px-6 py-3 rounded hover:bg-gray-200 {{ request()->routeIs('admin.orders.*') ? 'bg-gray-200' : '' }}">
                            Orders
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.homepage.index') }}"
                            class="block px-6 py-3 rounded hover:bg-gray-200 {{ request()->routeIs('admin.home.*') ? 'bg-gray-200' : '' }}">
                            Home Page Settings
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        {{-- Main content --}}
        <div class="flex-1 p-6">
            @yield('content')
        </div>
    </div>

    @yield('scripts')
</body>

</html>
