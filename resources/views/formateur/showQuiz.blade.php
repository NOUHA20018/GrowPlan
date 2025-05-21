<x-app-layout>
  <x-slot name="header">
    <link rel="stylesheet" href="{{ asset('assets/css/formateur/listCour.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/formateur/showQuiz.css') }}">
    <h2 style="padding: 10px" class="header">
      {{ __(' Informations du Quiz') }}
    </h2>
  </x-slot>

  <div class="container">
    <div class="content">
      <h3> Titre :</h3>
      <p>{{ $quiz->title }}</p>

      @if($quiz->description)
        <h3> Description :</h3>
        <p>{{ $quiz->description }}</p>
      @endif     

      @if($quiz->chapitre)
        <h3> Chapitre :</h3>
        <p>{{ $quiz->chapitre->title ?? 'Non défini' }}</p>
      @endif
      
      @if($quiz->cour)
        <h3> Cours :</h3>
        <p>{{ $quiz->cour->title ?? 'Non défini' }}</p>
      @endif

      <h3> Créateur :</h3>
      <p>{{ $quiz->user->name ?? 'Inconnu' }}</p>

      <hr>

      <h3> Questions :</h3>
      @foreach ($questions as $question)
        <div class="list_reponses" style="margin-bottom: 20px;">
          <strong>{{ $loop->iteration }}. {{ $question->question_text }}</strong>
          <ul>
            @foreach ($question->reponses_possible as $reponse)
              <li class="{{ $reponse->is_correct ? 'correct-answer' : '' }}">
                {{ $reponse->option_text }}
              </li>
            @endforeach
          </ul>
        </div>
      @endforeach
    </div>
  </div>
</x-app-layout>
