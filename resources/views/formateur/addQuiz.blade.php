<x-app-layout>
  <x-slot name="header">
    <link rel="stylesheet" href="{{ asset('assets/css/formateur/listCour.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/formateur/quiz.css') }}">
    <h2 class="header p-2">
      {{ __('Ajouter Quiz du cour  ') }}
    </h2>
  </x-slot>

  <div class="container">
    <div class="content">
  {{-- <form method="POST" action="{{ route('formateur.storeQuiz', [$cour->id, isset($courChapitres->id) ? $courChapitres->id : null]) }}"> --}}
  <form method="POST" action="{{ route('formateur.storeQuiz', [$cour->id] + (isset($courChapitres->id) ? [$courChapitres->id] : [])) }}">
        @csrf
            @if ($errors->any())
              <div style="color:red;">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
        <label >Chapitre Quiz :</label>
        @if($courChapitres instanceof \App\Models\Chapitre)
        <!-- Affiche un seul chapitre -->
        <input type="hidden" name="chapterQuiz" value="{{ $courChapitres->id }}">
        <p>Chapitre sélectionné : {{ $courChapitres->title }}</p>
        @else
            <!-- Liste des Chapitres -->
            <select name="chapterQuiz">
                <option value="">Choisir un Chapitre</option>
                @foreach ($courChapitres as $chap)
                     <option value="{{ $chap->id }}" {{ old('chapterQuiz') == $chap->id ? 'selected' : '' }}>{{ $chap->title }}</option>
                @endforeach
            </select>
        @endif

        <label for="">Titre Quiz:</label>
        <input type="text" name="title" value="{{ old('title') }}" placeholder="titre de quiz">
        @error('title')
        <div class="text-red">{{$message}}</div>
        @enderror
        <label for="">Description:</label>
        <textarea name="description">{{ old('description') }}</textarea>
            @error('description')
              <div class="text-red">{{ $message }}</div>
            @enderror
        <div id="questions-container">
          <div class="question">
            @php $i = 0 ;@endphp
            <strong>Question {{ $i + 1 }}:</strong><br>
            <label>Question Texte :</label>
            <input type="text" name="questions[0][text]"value="{{ $question['text'] ?? '' }}">
              @error("questions.$i.text")
                <div class="text-red">{{ $message }}</div>
              @enderror
              <br>
          
            <label>Options :</label><br>
            <input type="text" name="questions[0][options][0][text]">
            <input type="checkbox" name="questions[0][options][0][is_correct]"> Bonne réponse<br>

            <input type="text" name="questions[0][options][1][text]">
            <input type="checkbox" name="questions[0][options][1][is_correct]"> Bonne réponse<br>

            <input type="text" name="questions[0][options][2][text]">
            <input type="checkbox" name="questions[0][options][2][is_correct]"> Bonne réponse<br>
          </div>
        </div>

        <button type="button" id="add-question">+ Ajouter une autre question</button>
        <br><br>
        <button type="submit">Enregistrer Quiz</button>
      </form>
    </div>
  </div>

  <script>
    let questionCount = 1;
    document.getElementById('add-question').addEventListener('click', () => {
      const container = document.getElementById('questions-container');
      const html = `
        <div class="question">
          <strong>Question ${questionCount + 1}:</strong><br>
          <label>Question Texte :</label>
          <input type="text" name="questions[${questionCount}][text]"><br>

          <label>Options :</label><br>
          <input type="text" name="questions[${questionCount}][options][0][text]">
          <input type="checkbox" name="questions[${questionCount}][options][0][is_correct]"> Bonne réponse<br>

          <input type="text" name="questions[${questionCount}][options][1][text]">
          <input type="checkbox" name="questions[${questionCount}][options][1][is_correct]"> Bonne réponse<br>

          <input type="text" name="questions[${questionCount}][options][2][text]">
          <input type="checkbox" name="questions[${questionCount}][options][2][is_correct]"> Bonne réponse<br>
        </div>
      `;

      container.insertAdjacentHTML('beforeend', html);
      questionCount++;
    });
  </script>
</x-app-layout>
