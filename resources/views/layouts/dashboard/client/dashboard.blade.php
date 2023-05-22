@extends('layouts.dashboard.components.acc')

@section('navbar')
    @include('layouts.dashboard.client.navbar')
@endsection

@section('elements')
    @yield('content')
@endsection
@section('footer')
    @include('layouts.dashboard.guest.footer')
@endsection
