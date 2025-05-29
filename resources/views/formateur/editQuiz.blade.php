<x-app-layout>
  <x-slot name="header">
    <link rel="stylesheet" href="{{ asset('assets/css/formateur/editQuiz.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/formateur/listCour.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/formateur/showQuiz.css') }}">
    <h2 class="header">{{ __('✏️ Modifier le Quiz') }}</h2>
  </x-slot>

  <div class="container">
    <div class="content">
      
      @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      
      <form action="{{ route('formateur.updateQuiz', $quiz->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form-group">
          <label for="title">Titre du Quiz</label>
          <input type="text" id="title" name="title" value="{{ old('title', $quiz->title) }}">
        </div>

        <div class="form-group">
          <label for="description">Description</label>
          <textarea id="description" name="description" rows="4">{{ old('description', $quiz->description) }}</textarea>
        </div>

        <div class="form-row">
          <div class="form-group half">
            <label for="chapitre_id">Chapitre</label>
            <select name="chapitre_id" id="chapitre_id">
              <option value="">-- Sélectionner un chapitre --</option>
              @foreach($chapitres as $chapitre)
                <option value="{{ $chapitre->id }}" {{ $quiz->chapitre_id == $chapitre->id ? 'selected' : '' }}>
                  {{ $chapitre->title }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="form-group half">
            <label for="cour_id">Cours</label>
            <select name="cour_id" id="cour_id">
              <option value="">-- Sélectionner un cours --</option>
              @foreach($cours as $cour)
                <option value="{{ $cour->id }}" {{ $quiz->cour_id == $cour->id ? 'selected' : '' }}>
                  {{ $cour->title }}
                </option>
              @endforeach
            </select>
          </div>
        </div>

        <h3 class="section-title">Questions du Quiz</h3>

        @foreach ($questions as $question)
          <div class="question-block">
            <div class="flex justify-between">
            <label>Question {{ $loop->iteration }}</label>
             <button class="delete-btn"
                data-question-id="{{ $question->id }}"
                onclick="deleteQuestion(event)">
              🗑
            </button>
          </div>
              <input type="text" name="question_text[{{ $question->id }}]"
              value="{{ old("question_text.$question->id", $question->question_text) }}">

            <div class="options">
              @foreach ($question->reponses_possible as $reponse)
                <div class="option-item">
                  <input type="text"
                         name="questions[{{ $question->id }}][option_text][{{ $reponse->id }}]"
                         value="{{ old("questions.$question->id.option_text.$reponse->id", $reponse->option_text) }}">

                  <label class="correct-checkbox">
                    <input type="radio"
                           name="questions[{{ $question->id }}][correct]"
                           value="{{ $reponse->id }}"
                           {{ $reponse->is_correct ? 'checked' : '' }}>
                    Correcte
                  </label>
                </div>
              @endforeach
            </div>

            
            
          </div>
          
        @endforeach

        
        <button type="submit" class="btn-primary" name="submit_edit">
          💾 Enregistrer les modifications
        </button>
      </form>


      <button type="button" id="add-question" class="btn-secondary">
  ➕ Ajouter une nouvelle question
</button>

<div id="add-question-form-container" style="display:none; margin-top:20px;">
  <form id="add-question-form" action="{{ route('formateur.addQuestion', $quiz->id) }}" method="POST">
    @csrf
    <h3>Ajouter une nouvelle question</h3>

    <label>Question Texte :</label>
    <input type="text" name="question_text" required><br>

    <label>Options :</label><br>
    <input type="text" name="options[0]" placeholder="Option 1" required>
    <input type="radio" name="correct_option" value="0" required> Correcte<br>

    <input type="text" name="options[1]" placeholder="Option 2" required>
    <input type="radio" name="correct_option" value="1"> Correcte<br>

    <input type="text" name="options[2]" placeholder="Option 3" required>
    <input type="radio" name="correct_option" value="2"> Correcte<br>

    <button type="submit" class="btn-primary">Ajouter la question</button>
  </form>
</div>
</x-app-layout>
<script>
  document.getElementById('add-question').addEventListener('click', () => {
  const container = document.getElementById('add-question-form-container');
  if (container.style.display === 'none') {
    container.style.display = 'block';
  } else {
    container.style.display = 'none';
  }
});




  async function deleteQuestion(event) {
    event.preventDefault();

    if (!confirm('voulez vous vraiment supprimer cette question?')) return;

    const btn = event.currentTarget;
    const questionId = btn.dataset.questionId;

    try {
      const response = await fetch(`/formateur/question/${questionId}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json',
        }
      });

      if (response.ok) {
        btn.closest('.question-block').remove();
      } else {
        const errorText = await response.text();
        console.error('Error response:', errorText);
        alert('error  .\n' + errorText);
      }

          } catch (err) {
            console.error(err);
            alert('pas possible');
          }
        }

</script>
