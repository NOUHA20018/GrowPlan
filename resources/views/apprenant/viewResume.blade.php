 <link href="{{ asset('assets/apprenantStyle/index.css') }}" rel="stylesheet">    
<link href="{{ asset('assets/apprenantStyle/chapitre.css') }}" rel="stylesheet">    

@extends('layoutsApprenant.apprenantApp')


@section('content')
 @if($chapitre->resume)
        @php
          $extension = pathinfo($chapitre->resume, PATHINFO_EXTENSION);
          $path = asset('resumes/'.$chapitre->id.'/'.$chapitre->resume);
        @endphp

        <div class="p-4" style="width: 100% ">
          <h4 class="text-md font-bold text-gray-700 dark:text-gray-200 mb-2">📄 Résumé</h4>
          @if($extension === 'pdf')
            <object data="{{ $path }}" type="application/pdf" width="100%" height="90%">
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

      @endsection