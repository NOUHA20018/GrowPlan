<x-app-layout>
   @include('layouts.navigationFormateur') 
    <x-slot name="header">
        <link rel="stylesheet" href="{{asset('assets/css/formateur/listCour.css')}}">
    </x-slot>

    <div class="app-container">
        <div class="app-content">
          <div class="app-content-header">
            <h1 class="app-content-headerText">categories</h1>
            <button class="mode-switch" title="Switch Theme">
              <svg class="moon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" width="24" height="24" viewBox="0 0 24 24">
                <defs></defs>
                <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
              </svg>
            </button>
            <button class="app-content-headerButton"><a href="{{route('formateur.categories.create')}}">Add categories</a></button>
          </div>
          <div class="app-content-actions">
            
            <div class="app-content-actions-wrapper">
              <div class="filter-button-wrapper">
                <button class="action-button filter jsFilter"><span>Filter</span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-filter"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg></button>
              </div>
              <button class="action-button list active" title="List View">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
              </button>
              <button class="action-button grid" title="Grid View">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
              </button>
            </div>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($categories as $categorie)
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition duration-300">
                    <div class="p-4">
                      <img style="width: 100%; height: 220px;" src="{{asset('categories/'.$categorie->id.'/'.$categorie->image) ?: asset('default-image.jpg')}}" alt="categoriese Image">
                      <h2 class="text-xl font-bold mb-2">{{ $categorie->title }}</h2>
                      <p>{{$categorie->description}}</p>
                      <strong>Slug: </strong><p>{{$categorie->slug}}</p>
                      <strong>Creator:</strong><p>{{$categorie->user->name}}</p>

                    </div>
                </div>
                @empty
                <p>No categories available at the moment.</p>
            @endforelse
        </div>
        
        </div>
      </div>
</x-app-layout>
