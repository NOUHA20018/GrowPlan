 <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse ($categories as $categorie)
        <div class="category-card bg-white shadow-md">
            <a href="{{ route('formateur.categories.edit', $categorie->id) }}">
                <img class="category-image" src="{{ asset('categories/'.$categorie->id.'/'.$categorie->image) ?: asset('default-image.jpg') }}" alt="Image Catégorie">
            </a>
            <div class="category-body">
                <h3 class="category-title">{{ $categorie->title }}</h3>
                <div class="category-description">
                    <span class="short-description">{{ Str::limit($categorie->description, 50) }}</span>
                    @if(strlen($categorie->description) > 50)
                        <span class="full-description hidden">{{ $categorie->description }}</span>
                        <span class="description-toggle">Voir plus</span>
                    @endif
                </div>
                <div class="category-meta">
                    <p><strong>Slug:</strong> {{ $categorie->slug }}</p>
                    <p><strong>Créateur:</strong> {{ $categorie->user->name }}</p>
                </div>
                <div class="category-actions">
                    <a href="{{ route('formateur.categories.edit', $categorie->id) }}" class="btn-details px-3 py-1 rounded-lg text-sm">Détails</a>
                    <form method="POST" action="{{ route('formateur.categories.delete', $categorie->id) }}" class="delete-categorie-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete px-3 py-1 rounded-lg text-sm">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-8">
            <p class="text-gray-500">Aucune catégorie disponible pour le moment.</p>
        </div>
    @endforelse
                </div>