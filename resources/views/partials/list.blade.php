<div class="overflow-x-auto bg-white rounded-lg shadow course-table">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Image</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Titre</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Catégorie</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Formateur</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Chapitres</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                                <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($cours as $cour)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('formateur.courses.info', $cour->id) }}">
                                            <img class="course-image" src="{{ asset('Cours/'.$cour->id.'/'.$cour->image) ?: asset('Cours/default-image.jpg') }}" alt="Course Image">
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ $cour->title }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        <span class="badge-category">{{ $cour->categorie->title }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        <div class="flex items-center">
                                           
                                            {{ $cour->user->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $cour->chapitres->count() }}
                                    </td>
                                    <td class="px-6 py-4 font-bold text-blue-600">
                                        ${{ number_format($cour->prix, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('formateur.courses.info', $cour->id) }}" 
                                               class="btn-edit px-3 py-1 rounded text-sm">
                                                <i class="fas fa-edit mr-1"></i> Modifier
                                            </a>
                                            <form method="POST" action="{{ route('formateur.cours.destroy', $cour->id) }}" class="delete-cours-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-delete px-3 py-1 rounded text-sm">
                                                    <i class="fas fa-trash mr-1"></i> Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">Aucun cours disponible pour le moment.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>