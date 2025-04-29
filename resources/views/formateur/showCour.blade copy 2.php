<x-app-layout>
  <x-slot name="header">
    <link rel="stylesheet" href="{{asset('assets/css/formateur/showCour.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/formateur/listCour.css')}}">
    <h2 class="font-semibold text-2xl mt-4 p-6  leading-tight">
      {{ __('📚 Informations du cours') }}
    </h2>
  </x-slot>

  <div class="p-6 bg-gray-300  min-h-screen">
    <div class="max-w-7xl mx-auto">
      {{-- Titre & Description --}}
      {{-- <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4"> --}}
        <div>
          <div class="flex justify-between items-center mb-2">
            <input id="title-input" type="text" name="title" class="text-3xl font-extrabold text-gray-900 dark:text-black bg-transparent border-none focus:outline-none" value="{{ $cours->title }}" readonly>
            <button type="button" onclick="enableEdit('title-input')" class="bg-gray-600 p-3 text-black">
              <i class="fa-solid fa-pencil"></i> Edit title
            </button>
          </div>
          {{-- <div class="flex justify-between ">
            <h1 class="flex text-3xl font-extrabold text-gray-900 dark:text-black">{{ $cours->title }}</h1>
            <a href="{{route('formateur.edit.courses',$cours->id)}}"><button class="flex bg-gray-600 p-3"><i class="fa-solid fa-pencil "></i> Edit title</button></a>
          </div> --}}
          <div class="flex justify-between items-center mb-2">
            <textarea id="description-input" name="description" class="w-full mt-2 text-lg text-gray-600 dark:text-black bg-transparent border-none focus:outline-none" rows="3" readonly>{{ $cours->description }}</textarea>
            <button type="button" onclick="enableEdit('description-input')" class="bg-gray-600 p-3 text-black">
              <i class="fa-solid fa-pencil"></i> Edit description
            </button>
          </div>
          
        </div>
        <div class="flex items-center gap-4">
          <button class="mode-switch p-2 rounded-full bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 transition">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
            </svg>
          </button>
          <a href="{{ route('formateur.chapters.create', $cours->id) }}"
             class="bg-blue-600 hover:bg-blue-700 text-black font-semibold px-4 py-2 rounded shadow transition">
            + Ajouter un Chapitre
          </a>
        </div>
      </div>

      {{-- Infos cours --}}
      <div class=" bg-gray-400 p-6 rounded-2xl shadow-md mb-8">
        {{-- <div class="flex justify-between">
        <p class=" flex mb-2 text-gray-800 dark:text-gray-200"><strong>🎓 Prix :</strong> {{ $cours->prix }} MAD</p> 
        <a href=""><button class="flex bg-gray-600 p-3"><i class="fa-solid fa-pencil "></i> Edit price </button></a>
        </div> --}}
        <div class="flex justify-between items-center mb-2">
          <strong>🎓 Prix :</strong>
          <input id="prix-input" type="text" name="prix" class="text-gray-800 dark:text-gray-200 bg-transparent border-none focus:outline-none" value="{{ $cours->prix }}" readonly>
          <button type="button" onclick="enableEdit('prix-input')" class="bg-gray-600 p-3 text-black">
            <i class="fa-solid fa-pencil"></i> Edit price
          </button>
        </div>
        
        {{-- <div class="flex justify-between">
        <p class="flex mb-2 text-gray-800 dark:text-gray-200"><strong>🗓 Date de création :</strong> {{ \Carbon\Carbon::parse($cours->date_creation)->format('d/m/Y') }}</p>
        <a href=""><button class="flex bg-gray-600 p-3"><i class="fa-solid fa-pencil "></i>  Edit date de creation </button></a>
        </div> --}}
        <div class="flex justify-between items-center mb-2">
          <strong>🗓 Date de création :</strong>
          <input id="prix-input" type="text" name="prix" class="text-gray-800 dark:text-gray-200 bg-transparent border-none focus:outline-none" value="{{ $cours->prix }}" readonly>
          <button type="button" onclick="enableEdit('prix-input')" class="bg-gray-600 p-3 text-black">
            <i class="fa-solid fa-pencil"></i> Edit Date creation
          </button>
        </div>
        {{-- <div class="flex justify-between">
        <p class="flex text-gray-800 dark:text-gray-200"><strong>👩‍🏫 Formateur :</strong> {{ $cours->user->name }}</p>
        <a href=""><button class="flex bg-gray-600 p-3"><i class="fa-solid fa-pencil "></i>  Edit creator </button></a>
        </div> --}}
        <div class="flex justify-between items-center mb-2">
          <strong>👩‍🏫 Formateur :</strong>
          <input id="prix-input" type="text" name="prix" class="text-gray-800 dark:text-gray-200 bg-transparent border-none focus:outline-none" value="{{ $cours->prix }}" readonly>
          <button type="button" onclick="enableEdit('prix-input')" class="bg-gray-600 p-3 text-black">
            <i class="fa-solid fa-pencil"></i> Edit Creator
          </button>
        </div>

        <div class="flex justify-between items-center mb-2">
          <strong>🏷 Catégorie :</strong> 
          <input id="prix-input" type="text" name="prix" class="text-gray-800 dark:text-gray-200 bg-transparent border-none focus:outline-none" value="{{ $cours->prix }}" readonly>
          <button type="button" onclick="enableEdit('prix-input')" class="bg-gray-600 p-3 text-black">
            <i class="fa-solid fa-pencil"></i> Edit Date creation
          </button>
        </div>

        {{-- <div class="flex justify-between">
        <p class="flex text-gray-800 dark:text-gray-200"><strong>🏷 Catégorie :</strong> {{ $cours->categorie->title }}</p>
        <a href=""><button class="flex bg-gray-600 p-3"><i class="fa-solid fa-pencil "></i>  Edit categorie </button></a>
        </div> --}}
        {{-- <p class="text-gray-800 dark:text-gray-200"><strong>📚 Cour :</strong> {{ optional($cours->cour)->title }}</p> --}}
      </div>
      <br>
      {{-- Chapitres --}}
      <div class=" grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 justify-center">
        @foreach ($cours->chapitres as $chapitre)
          <div class="bg-white dark:bg-gray-700 rounded-2xl shadow-lg overflow-hidden max-w-md mx-auto">
            <div class="p-4">
              <p class="text-lg font-semibold text-gray-800 dark:text-white">Chapitre {{ $loop->iteration }}</p>
            </div>
            <video class="w-full h-64 object-cover" controls poster="{{ asset('chapitres/'.$chapitre->id.'/thumbnail.jpg') }}">
              <source src="{{ asset('chapitres/'.$chapitre->id.'/'.$chapitre->video) }}" type="video/mp4">
              Votre navigateur ne supporte pas la vidéo.
            </video>

            {{-- Résumé du chapitre --}}
            @if($chapitre->resume)
              @php
                $extension = pathinfo($chapitre->resume, PATHINFO_EXTENSION);
                $path = asset('resumes/'.$chapitre->id.'/'.$chapitre->resume);
              @endphp

              <div class="p-4">
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
        @endforeach
      </div>
    </div>
  </div>
</x-app-layout>

<script>
  function enableEdit(id) {
    const input = document.getElementById(id);
    input.removeAttribute('readonly');
    input.focus();
    input.classList.add('bg-white', 'border', 'border-gray-300', 'rounded');
  }


  document.querySelector('.mode-switch')?.addEventListener('click', () => {
    document.body.classList.toggle('dark');
  });
</script>
