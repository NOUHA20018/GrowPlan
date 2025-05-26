<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('assets/css/formateur/listCour.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/formateur/showCour.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
        <h2 class="header">
            <i class="fas fa-users mr-2"></i> {{ __('Apprenants inscrits') }} - {{ $cour->title }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- En-tête du tableau -->
            <div class="grid grid-cols-12 bg-blue-600 text-black p-4 font-semibold">
                <div class="col-span-1">#</div>
                <div class="col-span-3">Nom</div>
                <div class="col-span-3">Preom</div>
                <div class="col-span-3">Email</div>
                <div class="col-span-3">Age</div>
                <div class="col-span-2">Progression</div>
                <div class="col-span-1">Actions</div>
            </div>

            <!-- Liste des apprenants -->
            <div class="divide-y divide-gray-200">
                @forelse ($cour->apprenants as $index => $apprenant)
                <div class="grid grid-cols-12 items-center p-4 hover:bg-gray-50 transition-colors">
                    <div class="col-span-1">{{ $index + 1 }}</div>
                    <div class="col-span-3 font-medium">{{ $apprenant->nom }} {{ $apprenant->prenom }}</div>
                    <div class="col-span-3 text-gray-600">{{ $apprenant->email }}</div>
                    <div class="col-span-3 text-gray-600">{{ 2025 - {{$apprenant->date_naissance}} }}</div>
                    <div class="col-span-2">
                        <span class="px-2 py-1 rounded-full text-xs 
                            {{ $apprenant->level == 'Avancé' ? 'bg-green-100 text-green-800' : 
                               ($apprenant->level == 'intermediate' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}"> 
                             {{ $apprenant->level }} 
                         </span> 
                    </div>
                    <div class="col-span-2">
                        
                    <div class="col-span-1 flex space-x-2">
                        
                        <a href="#" class="text-green-600 hover:text-green-800" title="Envoyer message">
                            <i class="fas fa-envelope"></i>
                        </a>
                    </div>
                </div>
                @empty
                <div class="p-6 text-center text-gray-500">
                    Aucun apprenant inscrit à ce cours pour le moment.
                </div>
                @endforelse
            </div>
        </div>

       
        
    </div>
</x-app-layout>