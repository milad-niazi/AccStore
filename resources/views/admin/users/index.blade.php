@extends('layouts.admin')

@section('content')
    <div class="p-6 bg-gray-100 min-h-screen">

        <h1 class="text-2xl font-bold mb-6">Users Section</h1>

        {{-- آمار کاربران --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">Total Users</h2>
                <p class="text-2xl">{{ $totalUsersCount }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">Active Users</h2>
                <p class="text-2xl">{{ $activeUsersCount }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold">Last Week New Users</h2>
                <p class="text-2xl">{{ $newUsersLastWeekCount }}</p>
            </div>
        </div>
        {{-- لیست کاربران --}}
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-lg font-semibold mb-4">Users List</h2>

            <table class="w-full text-left border-collapse">
                <thead>
                    <tr>
                        <th class="border-b px-4 py-2">ID</th>
                        <th class="border-b px-4 py-2">Name</th>
                        <th class="border-b px-4 py-2">Email</th>
                        <th class="border-b px-4 py-2">Operation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allUsersData as $user)
                        <tr class="hover:bg-gray-100">
                            <td class="border-b px-4 py-2">{{ $user->id }}</td>
                            <td class="border-b px-4 py-2">{{ $user->name }}</td>
                            <td class="border-b px-4 py-2">{{ $user->email }}</td>
                            <td class="border-b px-4 py-2 flex gap-2">
                                {{-- دکمه اطلاعات --}}
                                {{-- {{ route('admin.users.show', $user->id) }} --}}
                                <a href="#" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                    Information
                                </a>

                                {{-- دکمه حذف --}}
                                {{-- {{ route('admin.users.destroy', $user->id) }} --}}

                                <form action="#" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600"
                                        onclick="return confirm('آیا مطمئن هستید؟')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection

    @section('scripts')
    @endsection
