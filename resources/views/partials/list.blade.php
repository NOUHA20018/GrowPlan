
<div class="overflow-x-auto bg-white rounded-lg shadow">
    <table class="min-w-full divide-y divide-gray-200 text-sm">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left font-medium text-gray-500">Image</th>
                <th class="px-6 py-3 text-left font-medium text-gray-500">Titre</th>
                <th class="px-6 py-3 text-left font-medium text-gray-500">Catégorie</th>
                <th class="px-6 py-3 text-left font-medium text-gray-500">Formateur</th>
                <th class="px-6 py-3 text-left font-medium text-gray-500">Chapitres</th>
                <th class="px-6 py-3 text-left font-medium text-gray-500">Prix</th>
                <th class="px-6 py-3 text-left font-medium text-gray-500">Action</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
        @forelse ($cours as $cour)
        <tr>
            <td class="px-6 py-4">
                <a href="{{ route('formateur.courses.info', $cour->id) }}">
                    <img class="w-16 h-16 object-cover rounded" src="{{ asset('Cours/'.$cour->id.'/'.$cour->image) ?: asset('Cours/default-image.jpg') }}" alt="Course Image">
                </a>
            </td>
            <td class="px-6 py-4 font-semibold text-gray-800">
                {{ $cour->title }}
            </td>
            <td class="px-6 py-4 text-gray-600">
                {{ $cour->categorie->title }}
            </td>
            <td class="px-6 py-4 text-gray-600">
                {{ $cour->user->name }}
            </td>
            <td class="px-6 py-4 text-gray-600">
                {{ $cour->chapitres->count() }}
            </td>
            <td class="px-6 py-4 text-blue-600 font-bold">
                ${{ $cour->prix }}
            </td>
            <td class="flex px-6 py-4">
                <a href="{{ route('formateur.courses.info', $cour->id) }}" style="background-color: rgb(8, 207, 140);margin-right:5px " class=" text-sm font-medium px-3 py-1 rounded-lg text-sm ">
                    details
                </a>
                 <form action="{{ route('formateur.cours.destroy', $cour->id) }}" method="POST"
                    class="delete-cours-form" data-id="{{ $cour->id }}">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-3 py-1 rounded-lg">
                    Supprimer
                </button>
            </form>
            </td>
        </tr>
        @empty
            <p>No courses available at the moment.</p>
        @endforelse
    </tbody>
    </table>
</div>

