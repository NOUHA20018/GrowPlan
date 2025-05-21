<x-app-layout>
  <x-slot name="header">
    <link rel="stylesheet" href="{{ asset('assets/css/formateur/listCour.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/formateur/showCour.css') }}">
    
        <h2 class="header">
            {{ __('📚 Informations du cours') }}
        </h2>
    </x-slot>

    <div class="container">
        <form action="{{ route('formateur.update.courses', $cours->id) }}" method="post" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="form-container">

                <div class="left-column">
                    <div class="form-group">
                        <div class="flex justify-between">
                            <label for="title-input"><strong>Titre :</strong></label>
                            <button type="button" onclick="enableEdit('title-input')" class="edit-button">✏️ Modifier</button>
                        </div>
                        <div class="input-group">
                            <input id="title-input" type="text" name="title" class="input" value="{{ $cours->title }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="flex justify-between">
                            <label for="description-input"><strong>Description :</strong></label>
                            <button type="button" onclick="enableEdit('description-input')" class="edit-button">✏️ Modifier</button>
                        </div>
                        <div class="input-group">
                            <textarea id="description-input" name="description" class="textarea" rows="3" readonly>{{ $cours->description }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="flex justify-between">
                            <label><strong>Image :</strong></label>
                            <button type="button" onclick="document.querySelector('.file-input').click()" class="edit-button">✏️ Modifier</button>
                        </div>
                        <img class="image" src="{{ asset('Cours/'.$cours->id.'/'.$cours->image) ?: asset('Cours/default-image.jpg') }}" alt="Course Image">
                        <input type="file" name="image" class="file-input" style="display: none;">
                    </div>

                    <div class="form-group">
                        <div class="flex justify-between">
                            <label for="prix-input"><strong>Prix :</strong></label>
                            <button type="button" onclick="enableEdit('prix-input')" class="edit-button">✏️ Modifier</button>
                        </div>
                        <div class="input-group">
                            <input id="prix-input" type="text" name="prix" class="input" value="{{ $cours->prix }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="flex justify-between">
                            <label for="date-input"><strong>Date Création :</strong></label>
                            <button type="button" onclick="enableEdit('date-input')" class="edit-button">✏️ Modifier</button>
                        </div>
                        <div class="input-group">
                            <input id="date-input" type="text" name="date_creation" class="input" value="{{ \Carbon\Carbon::parse($cours->date_creation)->format('Y-m-d') }}" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><strong>Formateur :</strong></label>
                        <input type="text" class="input" value="{{ $cours->user->name }}" readonly>
                    </div>

                    <div class="form-group">
                        <div class="flex justify-between">
                            <label for="categorie_id-input"><strong>Catégorie :</strong></label>
                            <button type="button" onclick="enableEdit('categorie_id-input')" class="edit-button">✏️ Modifier</button>
                        </div>
                        <div class="select-group">
                            <select id="categorie_id-input" name="categorie_id" class="select">
                                <option value="">Sélectionner une catégorie</option>
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}" {{ (old('categorie_id', $cours->categorie_id) == $categorie->id) ? 'selected' : '' }}>
                                        {{ $categorie->title }}
                                    </option>
                                @endforeach
                            </select>
                            <a href="{{ route('formateur.categories.create') }}" class="add-chapter-btn">+ Ajouter</a>
                        </div>
                    </div>
                </div>

                <div class="right-column">
                    <div class="chapters-header">
                        <h3 class="chapters-title">📚 Chapitres</h3>
                        <div class="flex space-x-2">
                            <a href="{{ route('formateur.chapters.create', $cours->id) }}" class="add-chapter-btn">
                                + Ajouter un chapitre
                            </a>
                            <a href="{{ route('formateur.addQuiz', $cours->id) }}" class="add-quiz-btn">
                                + Ajouter un quiz
                            </a>
                        </div>
                    </div>
                    
                    <div class="chapters-list">
                        @foreach ($cours->chapitres as $chapitre)
                            <a href="{{ route('formateur.chapters.edit', $chapitre->id) }}" class="chapter-item">
                                📘 {{ $chapitre->title }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="save-button-container">
                <button type="submit" class="save-button">
                    💾 Enregistrer
                </button>
            </div>
        </form>
    </div>

    <script>
        function enableEdit(id) {
            const input = document.getElementById(id);
            input.removeAttribute('readonly');
            input.focus();
            input.classList.add('editable');
        }

        document.querySelector('.mode-switch')?.addEventListener('click', () => {
            document.body.classList.toggle('dark');
        });
    </script>
</x-app-layout>