<x-app-layout>
    @include('layouts.navigationFormateur') 
  <x-slot name="header">
    <link rel="stylesheet" href="{{ asset('assets/css/formateur/listCour.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/formateur/quiz.css') }}">
    <h2 class="header p-2">
      {{ __('List Quizzes ') }}
    </h2>
  </x-slot>

   
<div class="container mx-auto py-4">
    <h1 class="text-2xl font-bold mb-4">Liste des Quiz</h1>


    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(count($quizzes) > 0)
        <table class="table-auto w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">#</th>
                    <th class="border px-4 py-2">Titre</th>
                    <th class="border px-4 py-2">Cours</th>
                    <th class="border px-4 py-2">Chapitres</th>
                    <th class="border px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($quizzes as $index => $quiz)
                <tr class="hover:bg-gray-100">
                    <td class="border px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border px-4 py-2">{{ $quiz->title }}</td>
                    <td class="border px-4 py-2">{{ $quiz->cour->title ?? 'N/A' }}</td>
                    {{-- @if($quiz->chapitre) --}}
                      <td class="border px-4 py-2">{{ $quiz->chapitre->title ?? 'N/A' }}</td>
                    {{-- @endif  --}}
                    <td class="border px-4 py-2 space-x-2">
                        <a href="{{ route('formateur.showQuiz', $quiz->id) }}"
                           style="background-color: cadetblue" class=" text-black px-3 py-1 rounded">Voir</a>
                        <a href="{{ route('formateur.editQuiz', $quiz->id) }}"
                           style="background-color: rgb(253, 165, 131)" class=" text-black px-3 py-1 rounded">Modifier</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Aucun quiz trouvé.</p>
    @endif
</div>


    </div>
   </div>

</x-app-layout>