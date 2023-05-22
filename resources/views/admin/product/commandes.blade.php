@extends('layouts.dashboard.admin.dashboard')
@section('content')
<div class="relative overflow-x-auto shadow-2xl sm:rounded-lg">
    <table  class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                        <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-all-search" class="sr-only">checkbox</label>
                            </div>
                        </th>
                            <th scope="col" class="px-6 py-3">                            Client</th>
                            <th scope="col" class="px-6 py-3">                              date</th>
                            <th scope="col" class="px-6 py-3">                            Status</th>
                            <th scope="col" class="px-6 py-3">                            Action</th>

                    </tr>
                </thead>
                <tbody >
                    @foreach ($cart as $cart)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="w-4 p-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                    </div>
                                </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium text-gray-800">{{ $cart->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium text-gray-800">{{ $cart->created_at }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium text-gray-800">{{ $cart->status_name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route("send-mail") }}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline" >
                                        Valider et envoyez email
                                    </a> <br>
                                    <a href="{{ route("admin.generatePDF") }}"
                                    class="font-medium text-red-600 dark:text-blue-500 hover:underline" >
                                        Telecharger facture / PDF
                                    </a>
                              </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
