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

    {{-- هدر --}}
    <header class="bg-white shadow p-4">
        <h1 class="text-xl font-bold">پنل ادمین</h1>
    </header>

    <div class="flex">

        {{-- سایدبار --}}
        <aside class="w-64 bg-gray-200 min-h-screen p-4">
            <nav class="space-y-2">
                {{-- <a href="{{ route('admin.dashboard.index') }}" class="block p-2 rounded hover:bg-gray-300">داشبورد</a>
                <a href="{{ route('admin.users.index') }}" class="block p-2 rounded hover:bg-gray-300">کاربران</a>
                <a href="{{ route('admin.accounts.index') }}" class="block p-2 rounded hover:bg-gray-300">اکانت‌ها</a>
                <a href="{{ route('admin.orders.index') }}" class="block p-2 rounded hover:bg-gray-300">سفارش‌ها</a>
                <a href="{{ route('admin.categories.index') }}" class="block p-2 rounded hover:bg-gray-300">دسته‌ها</a> --}}
            </nav>
        </aside>

        {{-- محتوای اصلی --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

    @yield('scripts')
</body>

</html>
