<x-app-layout>
  <x-slot name="header">
    <h2 class=" m-2 p-3 font-semibold text-xl text-gray-800 leading-tight">
      <link rel="stylesheet" href="{{asset('assets/css/formateur/showCour.css')}}">
      <link  rel="stylesheet" href="{{asset('assets/css/formateur/listCour.css')}}">
      📘 {{ $chapitre->title }}
    </h2>
  </x-slot>
  <div class="form-container">
    {{-- <div class="left-column">
          <div class="chapters-header">
            <h3 class="chapters-title">📚 Chapitres</h3> --}}
            {{-- <a href="{{ route('formateur.chapters.create', $cours->id) }}" class="add-chapter-btn">+ Ajouter un chapitre</a> --}}
          </div>
          
          {{-- <div class="chapters-list"> --}}
            {{-- @foreach ($chapitres as $chapitre)
              <a href="{{ route('formateur.chapters.show', $chapitre->id) }}" class="chapter-item">
                📘 {{ $chapitre->title }}
              </a>
            @endforeach --}}
          {{-- </div>
    </div>
  <div class="right-column"> --}}
    <div class=" py-6 px-4 max-w-3xl mx-auto bg-white rounded shadow">
    <div class="bg-white dark:bg-gray-700 rounded-2xl shadow-lg overflow-hidden max-w-md mx-auto">
      <div class="p-4">
        <p class="text-lg font-semibold text-gray-800 dark:text-white">Chapitre </p>
      </div>
     <div class="flex justify-center">
       <video style="width: 60%" class="object-cover rounded mx-auto" controls poster="{{ asset('chapitres/'.$chapitre->id.'/thumbnail.jpg') }}">
        <source src="{{ asset('chapitres/'.$chapitre->id.'/'.$chapitre->video) }}" type="video/mp4">
          Votre navigateur ne supporte pas la vidéo.
        </video>
      </div>
      
      {{-- Résumé du chapitre --}}
      <div class="flex justify-center">
      @if($chapitre->resume)
        @php
          $extension = pathinfo($chapitre->resume, PATHINFO_EXTENSION);
          $path = asset('resumes/'.$chapitre->id.'/'.$chapitre->resume);
        @endphp

        <div class="p-4 " style="width: 60% ">
          <h4 class="text-md font-bold text-gray-700 dark:text-gray-200 mb-2">📄 Résumé</h4>
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
  </div>
  
  </div>
</x-app-layout>
