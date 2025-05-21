<x-app-layout>
    @include('layouts.navigationFormateur')
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('assets/css/formateur/listCour.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/formateur/categorie.css') }}">
    </x-slot>

    <div class="app-container">
        <div class="app-content">
            <div class="app-content-header">
                <h1 class="app-content-headerText">Catégories</h1>
                <button class="mode-switch" title="Switch Theme">
                    <svg class="moon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
                    </svg>
                </button>
                <button class="app-content-headerButton">
                    <a href="{{ route('formateur.categories.create', ['from' => 'list']) }}">Ajouter une catégorie</a>
                </button>
            </div>
            
            @include('layouts.actions')
            
          

            @if(request('view') === 'list')
                <!-- Table View -->
                @include('partials.listCategorie')
                @else
                <!-- Card View -->
                @include('partials.cardCategorie')
                
            @endif
        </div>
    </div>

    <script>
        function changeView(view) {
            const url = new URL(window.location.href);
            url.searchParams.set('view', view);
            window.location.href = url.toString();
        }

        document.querySelectorAll('.description-toggle').forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                const container = this.closest('.description-container');
                const short = container.querySelector('.short-description');
                const full = container.querySelector('.full-description');
                
                if(full.classList.contains('hidden')) {
                    short.classList.add('hidden');
                    full.classList.remove('hidden');
                    this.textContent = 'Voir moins';
                } else {
                    short.classList.remove('hidden');
                    full.classList.add('hidden');
                    this.textContent = 'Voir plus';
                }
            });
        });

        // Delete confirmation
        document.querySelectorAll('.delete-categorie-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                Swal.fire({
                    title: 'Confirmation de suppression',
                    text: "Voulez-vous vraiment supprimer cette catégorie ? Cette action est irréversible.",
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