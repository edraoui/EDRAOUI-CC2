@extends('layouts.dashboard.admin.dashboard')
@section('content')
    @if ($message = Session::get('danger'))
        <div class="mb-4 rounded-lg bg-danger-100 px-6 py-5 text-base text-danger-700" role="alert">
            {{ $message }}
        </div>
    @endif
    <form class="my-6 flex flex-wrap gap-10 " action="{{ route('admin.categories.update', $data->id) }}" method="Post">
        @csrf
        <div class="mb-6">
            <input type="text" name="name" value="{{$data->name}}"
                placeholder="categorie..." required>
                <button type="submit"
                class="text-white bg-purple-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                modifier</button>
        </div>
    </form>
@endsection
