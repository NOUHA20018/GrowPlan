{{-- <x-app-layout>
  @include('layouts.navigationFormateur')

  <x-slot name="header">
    <link rel="stylesheet" href="{{ asset('assets/css/listCour.css') }}">
  </x-slot>

  <div class="app-container">
    <div class="app-content">
      <div class="flex mb-4 flex-wrap ">
        @foreach ($cours as $cour)
          <div class="card w-1/3 bg-gray-400 h-12">
              <img class="w-full h-48 object-cover" src="{{$cour->image}}" alt="Sunset in the mountains">
              <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{$cour->title}}</div>
                <p class="text-gray-700 text-base">
                  {{$cour->description}}
                </p>
              </div>
              <div class="px-6 pt-4 pb-2">
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
              </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</x-app-layout> --}}
