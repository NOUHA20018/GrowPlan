<div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left font-medium text-gray-500">Image</th>
                <th class="px-6 py-3 text-left font-medium text-gray-500">Titre</th>
                <th class="px-6 py-3 text-left font-medium text-gray-500">Description</th>
                <th class="px-6 py-3 text-left font-medium text-gray-500">Slug</th>
                <th class="px-6 py-3 text-left font-medium text-gray-500">Créateur</th>
                <th class="px-6 py-3 text-left font-medium text-gray-500">Action</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            @forelse ($categories as $categorie)
                <tr>
                    <td class="px-6 py-4">
                    <a href="{{ route('formateur.categories.show', $categorie->id) }}" >
                        <img class="w-16 h-16 object-cover rounded" src="{{ asset('categories/'.$categorie->id.'/'.$categorie->image) ?: asset('default-image.jpg') }}" alt="Image Catégorie">
                    </a>
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-800">
                        {{ $categorie->title }}
                    </td>
                    <td class="px-6 py-4 text-gray-600">
                        {{ $categorie->description }}
                    </td>
                    <td class="px-6 py-4 text-gray-600">
                        {{ $categorie->slug }}
                    </td>
                    <td class="px-6 py-4 text-gray-600">
                        {{ $categorie->user->name }}
                    </td>
                    <td class="flex px-6 py-4 space-x-2">
                        {{-- <div style="flex"> --}}
                            {{-- <a href="{{ route('formateur.categories.show', $categorie->id) }}" style="background-color: cadetblue" class=" text-white text-sm px-3 py-1  rounded-lg">Détails</a>--}}
                            <a style="background-color: rgb(255, 183, 0);margin-right:5px" href="{{ route('formateur.categories.show', $categorie->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-black text-sm px-3 py-1 rounded-lg">Modifier</a>
                            <form method="POST" action="{{route('formateur.categories.delete',$categorie->id)}}" class="delete-categorie-form" data-id="{{$categorie->id}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1 rounded-lg">Supprimer</button>
                            </form>
                        {{-- </div> --}}
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
