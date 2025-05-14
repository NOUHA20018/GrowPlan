<x-app-layout>
  <x-slot name="header">
    <h2 class=" p-4 font-semibold text-xl text-gray-800 leading-tight">
      <link rel="stylesheet" href="{{asset('assets/css/formateur/showCour.css')}}">
      <link rel="stylesheet" href="{{asset('assets/css/formateur/listCour.css')}}">
      {{ __('📘 Informations du chapitre') }}
    </h2>
  </x-slot>

  <form action="{{ route('formateur.update.chapitre', $chapitre->id) }}" method="post" enctype="multipart/form-data">
  <div class="form-container flex space-x-6 px-6 py-4">
    @csrf
    @method('PATCH')
    <!-- Left Column -->
    <div class="w-1/2 px-4 py-4">
      <div class="form-group mb-6">
        <div class="flex justify-between ">
          <label for="title-input"><strong>Title :</strong></label>
          <button  type="button" type="button" onclick="enableEdit('title-input')" class="text-sm edit-button bg-blue-500 text-white px-3 py-2 rounded hover:bg-blue-600">✏️ Edit Title</button>
        </div>
          <div class="input-group flex items-center space-x-2">
          <input id="title-input" type="text" name="title" class="input p-2 w-full border rounded" value="{{ $chapitre->title }}" readonly>
        </div>
      </div>

      <!-- Edit Resume -->
      <div class="form-group mb-6">
        <div class="flex justify-between ">
        <label><strong>📄 Résumé :</strong></label>
        <button  type="button" onclick="enableEdit('resume-input')" class="text-sm edit-button bg-blue-500 text-white px-3 py-2 mt-2 rounded hover:bg-blue-600">✏️ Edit Resume  </button>
        </div>
          <div class="input-group flex items-center space-x-2">
            <input type="file" name="resume" id="resume-input">
          </div>
         {{-- Résumé du chapitre --}}
      <div class="resume-section">
        @if($chapitre->resume)
          @php
            $extension = pathinfo($chapitre->resume, PATHINFO_EXTENSION);
            $path = asset('resumes/'.$chapitre->id.'/'.$chapitre->resume);
          @endphp
          <div class="p-4" style="width: 100%">
            {{-- <h4 class="text-md font-bold text-gray-700 dark:text-gray-200 mb-2">📄 Résumé</h4> --}}
            @if($extension === 'pdf')
              <object data="{{ $path }}" type="application/pdf" width="100%" height="400px">
                <p>Ce fichier ne peut pas être affiché. 
                  <a href="{{ $path }}" class="text-blue-500 underline">Téléchargez-le</a>.
                </p>
              </object>
            @elseif(in_array($extension, ['docx','pptx','xlsx']))
              <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode($path) }}" width="100%" height="400px" frameborder="0"></iframe>
            @else
              <a href="{{ $path }}" download class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow block text-center">
                📥 Télécharger le résumé
              </a>
            @endif
          </div>  
        @endif
      </div>
      </div>
    </div>

    <!-- Right Column -->
    <div class="w-1/2 px-4 py-4">
      <div class="video-section mb-6">
        <div class="form-group mb-6">
          <div class="flex justify-between ">
            <label><strong>📽️ Video</strong></label>
            <button  type="button" onclick="enableEdit('video-input')" class="text-sm edit-button bg-blue-500 text-white px-3 py-2 mt-2 rounded hover:bg-blue-600">✏️ Edit Video   </button>
          </div>
        <div class="input-group flex items-center space-x-2">
            <input type="file" name="video" id="video-input">
        </div><br>
        <video style="width: 100%" class="object-cover rounded mx-auto mb-4" controls poster="{{ asset('chapitres/'.$chapitre->id.'/thumbnail.jpg') }}">
          <source src="{{ asset('chapitres/'.$chapitre->id.'/'.$chapitre->video) }}" type="video/mp4">
          Votre navigateur ne supporte pas la vidéo.
        </video>
      </div>

     
    </div>
  </div>
  </div>
  <div class="save-button-container">
        <button  type="submit" class="save-button">
          💾 Enregistrer
        </button>
  </div>
</form>

  <script>
    function enableEdit(id) {
      const input = document.getElementById(id);
      input.removeAttribute('readonly');
      input.focus();
      input.classList.add('editable');
    }
  </script>

</x-app-layout>
