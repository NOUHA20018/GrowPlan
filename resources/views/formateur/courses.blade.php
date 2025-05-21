<x-app-layout>
    @include('layouts.navigationFormateur')
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('assets/css/formateur/listCour.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/formateur/courses.css') }}">
        
    </x-slot>

    <div class="app-container">
        <div class="app-content">
            <div class="app-content-header">
                <h1 class="app-content-headerText">Cours</h1>
                <button class="mode-switch" title="Switch Theme">
                    <svg class="moon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
                    </svg>
                </button>
                <button class="app-content-headerButton">
                    <a href="{{ route('formateur.courses.create') }}">Ajouter un cours</a>
                </button>
            </div>
            
            @include('layouts.actions')
            
            @if(session('success'))
                <div class="alert-success px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Succès !</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert-error px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Erreur !</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            
           

            @if(request('view') === 'list')
                <!-- Table View -->
                @include('partials.list')
                @else
                <!-- Card View -->
                @include('partials.card')
                
            @endif
        </div>
    </div>

    <script>
        function changeView(view) {
            const url = new URL(window.location.href);
            url.searchParams.set('view', view);
            window.location.href = url.toString();
        }
        
        document.querySelectorAll('.delete-cours-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                
                Swal.fire({
                    title: 'Confirmation de suppression',
                    text: "Voulez-vous vraiment supprimer ce cours ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Oui, supprimer',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); 
                    }
                });
            });
        });
    </script>
</x-app-layout>