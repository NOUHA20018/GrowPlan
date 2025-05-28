<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('assets/css/formateur/listCour.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/formateur/showCour.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
        <h2 class="header">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
            <i class="fas fa-users mr-2"></i> {{ __('Apprenants inscrits') }} - {{ $cour->title }}
        </h2>
    </x-slot>

    <div class="page-container">
        @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Succès!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="this.parentElement.remove();">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Fermer</title>
                    <path d="M14.348 5.652a1 1 0 10-1.414-1.414L10 7.172 7.066 4.238a1 1 0 00-1.414 1.414L8.828 10l-3.176 3.176a1 1 0 001.414 1.414L10 12.828l2.934 2.934a1 1 0 001.414-1.414L11.172 10l3.176-3.176z"/>
                </svg>
            </span>
        </div>
    @endif

        <div class="student-list-card ">
            <div class="student-list-header">
                <div class="student-list-col col-index">#</div>
                <div class="student-list-col col-name">Nom</div>
                <div class="student-list-col col-name">Prénom</div>
                <div class="student-list-col col-email">Email</div>
                <div class="student-list-col col-age">Âge</div>
                <div class="student-list-col col-progress">Progression</div>
                <div class="student-list-col col-actions">Actions</div>
            </div>

            <div class="student-list-body p-6">
                @forelse ($cour->apprenants as $index => $apprenant)
                @php

                    $progression = $apprenant->apprenant_cours->where('cour_id', $cour->id)->first()->progression ?? 0;
                @endphp
                <div class="student-list-row">
                    <div class="student-list-col col-index">{{ $index + 1 }}</div>
                    <div class="student-list-col col-name">{{ $apprenant->name }}</div>
                    <div class="student-list-col col-name">{{ $apprenant->prenom }}</div>
                    <div class="student-list-col col-email">{{ $apprenant->email }}</div>
                    <div class="student-list-col col-age">
                        {{ \Carbon\Carbon::parse($apprenant->date_naissance)->age }} ans
                    </div>
                         @php
                                $progression = $apprenant->apprenant_cours()
                                    ->where('cour_id', $cour->id)
                                    ->first()?->pivot->progression ?? 0;

                            @endphp
                    <div class="student-list-col col-progress">
                        <div class="progress-container">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: {{ $progression }}%"></div>
                            </div>
                            <span class="progress-text">{{ $progression }}%</span>

                        </div>
                        
                    </div>
                    <div class="student-list-col col-actions">
                        <form action="{{route('formateur.deleteApprenant',$apprenant->id)}}" method="post">
                            @csrf 
                            @method('delete')
                            <button  type="submit"><i class=" fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="empty-state">
                    <i class="fas fa-user-graduate empty-icon"></i>
                    <p class="empty-text">Aucun apprenant inscrit à ce cours pour le moment.</p>

                </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>