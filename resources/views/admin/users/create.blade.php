@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2>ایجاد کاربر جدید</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">نام</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">ایمیل</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">رمز عبور</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">نقش</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>کاربر</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>ادمین</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">وضعیت</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>فعال</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>غیرفعال</option>
                    <option value="banned" {{ old('status') == 'banned' ? 'selected' : '' }}>مسدود</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">ایجاد کاربر</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">بازگشت</a>
        </form>
    </div>
@endsection
