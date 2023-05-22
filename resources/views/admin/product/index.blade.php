@extends('layouts.dashboard.admin.dashboard')
@section('content')

    @if ($message = Session::get('success'))
        <div class="mb-4 mt-6 rounded-lg bg-success-100 px-6 py-5 text-base text-success-700" role="alert">
            {{ $message }}
        </div>
    @endif



    <div class="w-300 flex flex-wrap   flex-col text-center justify-center gap-4">
        <div class=" p-4 bg-white justify-center border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Liste de produits</h5>
                <a href="{{ route('produits.export') }}" class="text-sm font-medium text-purple-500 hover:underline dark:text-purple-500">
                    Export
                </a>
                <a href="{{ route('admin.products.create') }}"
                    class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium  text-sm w-full sm:w-auto px-5 py-2.5 text-center"  >
                    +
            </a>
           </div>
           @foreach ($dd as $d)
           <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div >

                                <img class="w-40 h-40 rounded-xl"  src="{{ asset("storage/images/".$d->image)}}" >
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    {{ $d->name }}
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    Categories: {{ $d->category }}
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                {{ $d->prix }}DH
                            </div>
                        </div>
                        <div class="flex items-center justify-end">
                            <a href="{{ route('admin.products.edit', $d->id) }}"
                                class="font-medium  dark:text-blue-500 hover:underline" ><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6  text-blue-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                  </svg>
                                  </a>

                            <a href="{{ route('admin.products.delete', $d->id) }}"
                                class="font-medium text-red-600 dark:text-blue-500 hover:underline"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                  </svg>
                                  </a>
                        </div>

                    </li>
            @endforeach
    </div>
</div>
        <div class="block"><form class="my-6" action="{{ route('produits.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
<br>
            <button
            class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium  text-sm w-full sm:w-auto px-5 py-2.5 text-center"  >
            Import produits
            </button>
        </form></div>
        <div class="flex items-center justify-between mb-4">

       </div>

</div>
</div>
@endsection
