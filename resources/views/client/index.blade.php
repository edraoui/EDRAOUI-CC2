@extends('layouts.dashboard.client.dashboard')
@section('content')

<div class="grid m-b-20 mb-8 border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 md:mb-12 md:grid-cols-2">
    @foreach ($dd as $d)
    <figure class="flex flex-col items-center justify-center p-8 text-center bg-white border-b border-gray-200 rounded-t-lg md:rounded-t-none md:rounded-tl-lg md:border-r dark:bg-gray-800 dark:border-gray-700">
        <blockquote class="max-w-2xl mx-auto mb-4 text-gray-500 lg:mb-8 dark:text-gray-400">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $d->name }}</h3>
            <p class="my-4">{{ $d->description }}</p>
        </blockquote>
        <figcaption class="flex items-center justify-center space-x-3">
            <img class="rounded-full w-9 h-9"  src="{{ asset("storage/images/".$d->image)}}" alt="profile picture">
            <div class="space-y-0.5 font-medium dark:text-white text-left">
                <div>Categorie:{{ $d->category }}</div>
                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $d->prix }}DH</div>
            </div>
        </figcaption>
        <div><br>
            <a href="{{ route('client.produit.cart', $d->id) }}"
                class="mr-4 text-white bg-purple-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Ajouter au cart
            </a>
        </div>
    </figure>
    @endforeach
</div>
@endsection


