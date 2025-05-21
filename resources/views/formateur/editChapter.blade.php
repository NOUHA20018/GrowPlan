<x-app-layout>

  <x-slot name="header">
    <h2 class="header-title">
      <link rel="stylesheet" href="{{asset('assets/css/formateur/listCour.css')}}">
       <link rel="stylesheet" href="{{ asset('assets/css/formateur/showCour.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/css/formateur/editChapter.css') }}">
      {{ __('📘 Informations du chapitre') }}
    </h2>
  </x-slot>

  <form action="{{ route('formateur.update.chapitre', $chapitre->id) }}" method="post" enctype="multipart/form-data" class="chapter-edit-form">
    @csrf
    @method('PATCH')
    <div class="form-container">
      <!-- Left Column -->
      <div class="form-column">
        <div class="form-group">
          <div class="form-header">
            <label for="title-input"><strong>Title :</strong></label>
            <button type="button" onclick="enableEdit('title-input')" class="edit-button">✏️ Edit Title</button>
          </div>
          <div class="input-group">
            <input id="title-input" type="text" name="title" class="form-input" value="{{ $chapitre->title }}" readonly>
          </div>
        </div>

        <!-- Edit Resume -->
        <div class="form-group">
          <div class="form-header">
            <label><strong>📄 Résumé :</strong></label>
            <button type="button" onclick="enableEdit('resume-input')" class="edit-button">✏️ Edit Resume</button>
          </div>
          <div class="input-group">
            <input type="file" name="resume" id="resume-input" class="file-input">
          </div>
          <div class="resume-section">
            @if($chapitre->resume)
              @php
                $extension = pathinfo($chapitre->resume, PATHINFO_EXTENSION);
                $path = asset('resumes/'.$chapitre->id.'/'.$chapitre->resume);
              @endphp
              <div class="resume-preview">
                @if($extension === 'pdf')
                  <object data="{{ $path }}" type="application/pdf">
                    <p>Ce fichier ne peut pas être affiché. 
                      <a href="{{ $path }}" class="download-link">Téléchargez-le</a>.
                    </p>
                  </object>
                @elseif(in_array($extension, ['docx','pptx','xlsx']))
                  <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode($path) }}" frameborder="0"></iframe>
                @else
                  <a href="{{ $path }}" download class="download-button">
                    📥 Télécharger le résumé
                  </a>
                @endif
              </div>  
            @endif
          </div>
        </div>
      </div>

      <!-- Right Column -->
      <div class="form-column">
        <div class="form-group">
          <div class="form-header">
            <label><strong>📽️ Video</strong></label>
            <button type="button" onclick="enableEdit('video-input')" class="edit-button">✏️ Edit Video</button>
          </div>
          <div class="input-group">
            <input type="file" name="video" id="video-input" class="file-input">
          </div>
          <div class="video-preview">
            <video controls poster="{{ asset('chapitres/'.$chapitre->id.'/thumbnail.jpg') }}">
              <source src="{{ asset('chapitres/'.$chapitre->id.'/'.$chapitre->video) }}" type="video/mp4">
              Votre navigateur ne supporte pas la vidéo.
            </video>
          </div>
        </div>
      </div>
    </div>
    <div class="save-button-container">
      <button type="submit" class="save-button">
        💾 Enregistrer
      </button>
    </div>
  </form>

  @push('scripts')
    <script>
      function enableEdit(id) {
        const input = document.getElementById(id);
        input.removeAttribute('readonly');
        input.focus();
        input.classList.add('editable');
      }
    </script>
  @endpush

 


  <script>
    function enableEdit(id) {
      const input = document.getElementById(id);
      input.removeAttribute('readonly');
      input.focus();
      input.classList.add('editable');
    }
  </script>

</x-app-layout>
