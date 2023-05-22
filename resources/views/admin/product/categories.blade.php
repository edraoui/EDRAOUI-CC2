@extends('layouts.dashboard.admin.dashboard')
@section('content')
    @if ($message = Session::get('success'))
        <div class="mb-4 rounded-lg bg-success-100 px-6 py-5 text-base text-success-700" role="alert">
            {{ $message }}
        </div>
    @endif
    @if ($message = Session::get('danger'))
        <div class="mb-4 rounded-lg bg-danger-100 px-6 py-5 text-base text-danger-700" role="alert">
            {{ $message }}
        </div>
    @endif
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table  class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $cat)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="w-4 p-4">
                                <div class="flex items-center">
                                    <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                </div>
                            </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $cat->name }}
                        </th>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.categories.edit', $cat->id) }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">modifier</a>

                            <a href="{{ route('admin.categories.delete', $cat->id) }}" class="font-medium text-red-600 dark:text-blue-500 hover:underline">supprimer
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <form class="my-6" action="{{ route('admin.categories.store') }}" method="Post">
        @csrf
        <div class="mb-6 flex flex-wrap">
            <input type="text" name="name"
                placeholder="Entrer votre categorie" required>
        </div>
        <button type="submit"
            class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium  text-sm w-full sm:w-auto px-5 py-2.5 text-center">ajouter
            categorie</button>
    </form>


@endsection
