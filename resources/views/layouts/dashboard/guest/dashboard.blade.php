@extends('layouts.dashboard.components.master')

@section('navbar')
    @include('layouts.dashboard.guest.navbar')
@endsection

@section('elements')
    @yield('content')
@endsection

@section('categories')
    @yield('categories')
@endsection
@section('footer')
    @include('layouts.dashboard.guest.footer')
@endsection
