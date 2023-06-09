@extends('layouts.dashboard.components.container')

@section('head')
    @include('layouts.dashboard.components.head')
@endsection

@section('body')

    @yield('sidebar')

    <div class="p-0 text-left" id="content">

        <div class="bg-slate-900">
            @yield('navbar')
        </div>

        <div class="rounded m-4 p-4  ">
            <div>
                @yield('elements')
            </div>
        </div>
        @yield('footer')

    </div>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>
@endsection
