@extends('layouts.web.master')

@section('title', 'Home')

@section('content')

    <!-- ========== Banner Slider ========== -->
    @include('layouts.web.banner')

    <!-- ========== پیشنهاد شگفت انگیز ========== -->
    @include('layouts.web.amazing')

    <!-- ========== تخفیف دارها ========== -->
    @include('layouts.web.offer')

    <!-- ========== Customer Reviews ========== -->
    @include('layouts.web.review')

@endsection
