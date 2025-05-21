<div class="overflow-x-auto bg-white rounded-lg shadow">
                    <table class="min-w-full divide-y divide-gray-200 text-sm category-table">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Image</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Créateur</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($categories as $categorie)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('formateur.categories.edit', $categorie->id) }}">
                                            <img class="w-16 h-16 object-cover rounded" src="{{ asset('categories/'.$categorie->id.'/'.$categorie->image) ?: asset('default-image.jpg') }}" alt="Image Catégorie">
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ $categorie->title }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        <div class="description-container">
                                            <span class="short-description">{{ Str::limit($categorie->description, 50) }}</span>
                                            @if(strlen($categorie->description) > 50)
                                                <span class="full-description hidden">{{ $categorie->description }}</span>
                                                <span class="description-toggle">Voir plus</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $categorie->slug }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $categorie->user->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('formateur.categories.edit', $categorie->id) }}" class="btn-edit px-3 py-1 rounded-lg text-sm">Modifier</a>
                                            <form method="POST" action="{{ route('formateur.categories.delete', $categorie->id) }}" class="delete-categorie-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete px-3 py-1 rounded-lg text-sm">Supprimer</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Aucune catégorie disponible pour le moment.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>