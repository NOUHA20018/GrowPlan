
<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('assets/css/formateur/listCour.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/formateur/dashboard.css') }}">
    </x-slot>

    <div class="">
        <div class="bg-gray-100 p-6">
            <h1 class="text-2xl font-bold mb-6">👨‍🏫 Tableau de bord - Formateur</h1>
            <div class="flex justify-between gap-6 flex-wrap">
                <div class="bg-white rounded-2xl shadow p-6 flex-1 min-w-[250px]">
                    <h2 class="text-lg font-semibold text-gray-700">📚 Nombre de cours</h2>
                    <p class="text-3xl font-bold text-blue-600 mt-2">{{ $coursCount }}</p>
                </div>
                <div class="bg-white rounded-2xl shadow p-6 flex-1 min-w-[250px]">
                    <h2 class="text-lg font-semibold text-gray-700">🎞️ Nombre de chapitres</h2>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $chapitresCount }}</p>
                </div>

                <div class="bg-white rounded-2xl shadow p-6 flex-1 min-w-[250px]">
                    <h2 class="text-lg font-semibold text-gray-700">👩‍🎓 Étudiants inscrits</h2>
                    <p class="text-3xl font-bold text-purple-600 mt-2">23</p>
                </div>
            </div>
        </div>

        <div class="p-6 bg-pink-100">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">🆕 Derniers cours ajoutés</h2>

            <div class="mb-4">
                <input type="text" id="searchInput" placeholder="🔍 Rechercher un cours..."
    class="w-full md:w-1/3 border border-gray-300 rounded-lg px-4 py-2 mb-4 focus:outline-none focus:ring-2 focus:ring-blue-400">

            </div>

            @if($lastCourse->count())
                <div class="overflow-x-auto bg-white rounded-xl shadow">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 text-center">
                            <tr>
                                <th class="px-6 py-3 text-sm font-medium text-gray-500 uppercase">#</th>
                                <th class="px-6 py-3 text-sm font-medium text-gray-500 uppercase">Titre
                                  <button onclick="toggleFilterMenu('filter-titre')" class="ml-1 text-gray-500">
                                      <i class="fas fa-filter"></i>
                                  </button>
                                  <div id="filter-titre" class="hidden absolute z-10 mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg">
                                      <div class="p-2 max-h-60 overflow-y-auto"></div>
                                  </div>
                                </th>
                                <th class="px-6 py-3 text-sm font-medium text-gray-500 uppercase">Description </th>
                                <th class="px-6 py-3 text-sm font-medium text-gray-500 uppercase">Prix 
                                   <button onclick="toggleFilterMenu('filter-prix')" class="ml-1 text-gray-500">
                                      <i class="fas fa-filter"></i>
                                  </button>
                                  <div id="filter-prix" class="hidden absolute z-10 mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg">
                                      <div class="p-2 max-h-60 overflow-y-auto"></div>
                                  </div>
                                </th>
                                <th class="px-6 py-3 text-sm font-medium text-gray-500 uppercase">Chapitres <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707l-6.414 6.414A1 1 0 0014 13v5.586a1 1 0 01-1.707.707l-2-2A1 1 0 0110 17v-4.586a1 1 0 00-.293-.707L3.293 6.707A1 1 0 013 6V4z" /></svg></th></th>
                                <th class="px-6 py-3 text-sm font-medium text-gray-500 uppercase">Créé le <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707l-6.414 6.414A1 1 0 0014 13v5.586a1 1 0 01-1.707.707l-2-2A1 1 0 0110 17v-4.586a1 1 0 00-.293-.707L3.293 6.707A1 1 0 013 6V4z" /></svg></th></th>
                                <th class="px-6 py-3 text-sm font-medium text-gray-500 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-center">
                            @foreach($lastCourse as $index => $course)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-500">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $course->title }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ Str::limit($course->description, 50) }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $course->prix ?? '—' }} MAD</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $course->chapitres->count() }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $course->created_at->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 flex justify-center gap-2">
                                        <a href="{{ route('formateur.courses.info', $course->id) }}" style="background-color: darkseagreen"
                                         class=" hover:bg-blue-700 text-black text-sm font-medium px-3 py-1 rounded-lg">
                                            More info
                                        </a>
                                        <form  action="{{ route('formateur.cours.destroy', $course->id) }}" method="POST"
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="bg-red-600 hover:bg-red-700 text-white text-sm font-medium px-3 py-1 rounded-lg">
                                                Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500 mt-4">Aucun cours ajouté pour l’instant.</p>
            @endif
        </div>
    </div>
    <script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll("table tbody tr");

        rows.forEach(row => {
            let title = row.children[1].textContent.toLowerCase(); 
            let description = row.children[2].textContent.toLowerCase(); 
            if (title.includes(filter) || description.includes(filter)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
    function toggleFilterMenu(id) {
        document.querySelectorAll('.filter-menu').forEach(menu => {
            if (menu.id !== id) menu.classList.add('hidden');
        });
        const menu = document.getElementById(id);
        menu.classList.toggle('hidden');
    }

    document.addEventListener('DOMContentLoaded', function () {
        const rows = document.querySelectorAll("table tbody tr");
        const titles = new Set();
        rows.forEach(row => {
            const title = row.children[1].textContent.trim();
            titles.add(title);
        });
        const container = document.querySelector('#filter-titre div');
        titles.forEach(title => {
            const label = document.createElement('label');
            label.className = "flex items-center space-x-2";
            label.innerHTML = `<input type="checkbox" class="filter-checkbox" value="${title}">
                <span>${title}</span>
            `;
            container.appendChild(label);
        });
        document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const selected = Array.from(document.querySelectorAll('.filter-checkbox:checked')).map(cb => cb.value);
                rows.forEach(row => {
                    const title = row.children[1].textContent.trim();
                    row.style.display = selected.length === 0 || selected.includes(title) ? "" : "none";
                });
            });
        });
    });
</script>

</x-app-layout>
