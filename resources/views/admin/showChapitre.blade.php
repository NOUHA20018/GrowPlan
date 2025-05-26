@extends('layoutsAdmin.adminApp')

@section('content')
<div class="container mx-auto px-4 py-8">

    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-6 border border-gray-200">
        <div class="p-6  text-black">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold">{{ $chapitre->title }}</h1>
                    <p class="mt-1 text-black">Chapitre du cours: {{ $chapitre->cour->title }}</p>
                </div>
                <span class=" text-blue-500 px-4 py-2 bg-blue-200 rounded-full font-bold ">
                    <i class="fas fa-clock mr-1.5"></i> {{ $chapitre->duree }} min
                </span>
            </div>
        </div>

        <div class="p-6">
            @if($chapitre->video)
            <div class="mb-6 ">
                <video  controls controlsList="nodownload" class="w-full aspect-video bg-black">
                    <source src="{{ asset('chapitres/'.$chapitre->id.'/'.$chapitre->video) }}" type="video/mp4">
                    <div class="absolute inset-0 flex items-center justify-center bg-gray-900 text-white">
                        Votre navigateur ne supporte pas la lecture vidéo.
                    </div>
                </video>
            </div>
            @endif
            

            <div class="space-y-6">
                <div class="prose max-w-none">
                    <h3 class="text-xl font-semibold mb-3 text-gray-800 border-b pb-2">Résumé du chapitre</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $chapitre->resume }}</p>
                </div>
                

                @if($chapitre->resume)
                @php
                    $extension = pathinfo($chapitre->resume, PATHINFO_EXTENSION);
                    $path = asset('resumes/'.$chapitre->id.'/'.$chapitre->resume);
                @endphp
                <div class="mt-6 border border-gray-200 rounded-lg p-4 bg-gray-50">
                    <h4 class="font-medium text-lg mb-3 text-gray-700 flex items-center">
                        <i class="fas fa-file-alt mr-2 text-blue-600"></i> Fichier attaché
                    </h4>
                    
                    <div class="flex flex-col items-start gap-4">
                        @if($extension === 'pdf')
                        <div class="w-full h-96 border border-gray-300 rounded-lg overflow-hidden">
                            <iframe src="{{ $path }}#toolbar=0" class="w-full h-full" frameborder="0"></iframe>
                        </div>
                        <a href="{{ $path }}" download class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-download mr-2"></i> Télécharger le PDF
                        </a>
                        @elseif(in_array($extension, ['docx','pptx','xlsx']))
                        <div class="w-full h-96 border border-gray-300 rounded-lg overflow-hidden">
                            <iframe src="https://view.officeapps.live.com/op/embed.aspx?src={{ urlencode($path) }}" class="w-full h-full" frameborder="0"></iframe>
                        </div>
                        <a href="{{ $path }}" download class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-download mr-2"></i> Télécharger le fichier
                        </a>
                        @else
                        <div class="flex items-center gap-3">
                            <i class="fas fa-paperclip text-2xl text-gray-500"></i>
                            <div>
                                <p class="font-medium">{{ $chapitre->resume }}</p>
                                <a href="{{ $path }}" download class="text-blue-600 hover:underline inline-flex items-center mt-1">
                                    <i class="fas fa-download mr-1.5 text-sm"></i> Télécharger
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>


    <div class="flex justify-end mt-6">
        <a href="{{ route('admin.cours.show', $chapitre->cour_id) }}" 
           class="inline-flex items-center px-5 py-2.5 bg-blue-300 border border-gray-300 rounded-lg shadow-sm text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
            <i class="fas fa-arrow-left mr-2"></i> Retour au cours
        </a>
    </div>
</div>

<style>
    #chapter-video::-webkit-media-controls-enclosure {
        border-radius: 0;
    }
    .prose {
        line-height: 1.6;
    }
    .prose p {
        margin-bottom: 1em;
    }
</style>


@endsection