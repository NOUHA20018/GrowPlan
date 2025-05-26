@extends('layoutsAdmin.adminApp')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8 border border-gray-700">
        <div class="p-6 bg-gradient-to-r from-indigo-600 to-indigo-800 text-black">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold">{{ $quiz->title }}</h1>
                    <div class="flex flex-wrap items-center gap-3 mt-2">
                        <span class="text-indigo-900 flex items-center">
                             {{ $quiz->cour->title }}
                        </span>
                        <span class="text-indigo-900 flex items-center">
                           Crée par :  {{ $quiz->user->nom }} {{ $quiz->user->prenom }}
                        </span>
                        @if($quiz->chapitre)
                        <span class="text-indigo-900 flex items-center">
                            {{ $quiz->chapitre->title }}
                        </span>
                        @endif
                    </div>
                </div>
                <div class="flex flex-wrap gap-3">
                    <span class="px-4 py-1.5 bg-white/20 backdrop-blur-sm rounded-full text-sm font-semibold shadow-sm">
                        <i class="fas fa-question-circle mr-1.5"></i> {{ $quiz->questions->count() }} questions
                    </span>
                   
                </div>
            </div>
        </div>
        
        <div class="p-6 border-b border-gray-200">
            <div class="prose max-w-none">
                @if($quiz->description)
                <h3 class="text-xl font-semibold mb-3 text-gray-800">Description</h3>
                <p class="text-gray-700 leading-relaxed">{{ $quiz->description }}</p>
                @else
                <p class="text-gray-500 italic">Aucune description fournie pour ce quiz.</p>
                @endif
            </div>
        </div>
        
        <div class="p-6">
            <h3 class="text-xl font-semibold mb-4 text-gray-800 flex items-center">
                <i class="fas fa-list-ul mr-2 text-indigo-600"></i> Liste des questions
            </h3>
            
            <div class="grid sm:grid-cols-1 md:grid-cols-2 gap-4 space-y-6">
                @forelse($quiz->questions as $question)
                <div class=" border border-gray-200 rounded-lg overflow-hidden">
                    <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                        <h4 class="font-medium text-gray-800 flex items-center">
                            <span class="bg-indigo-600 text-white rounded-full w-6 h-6 flex items-center justify-center mr-3 text-sm">
                                {{ $loop->iteration }}
                            </span>
                            {{ $question->question_text }}
                        </h4>
                    </div>
                    <div class="p-4">
                        <ul class="space-y-2">
                            @foreach($question->reponses_possible as $response)
                            <li class="flex items-start">
                                <span class="mt-1 mr-2 flex-shrink-0">
                                    @if($response->is_correct)
                                    <span class="bg-green-300 text-green-800 rounded-full w-5 h-5 flex items-center justify-center">
                                        <i class="fas fa-check text-xs"></i>
                                    </span>
                                    @else
                                    <span class="bg-gray-300 text-gray-500 rounded-full w-5 h-5 flex items-center justify-center">
                                        <i class="fas fa-circle text-xs"></i>
                                    </span>
                                    @endif
                                </span>
                                <span class="@if($response->is_correct) font-medium text-green-700 @else text-gray-700 @endif">
                                    {{ $response->option_text }}
                                </span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @empty
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-inbox text-4xl mb-3 text-gray-300"></i>
                    <p>Aucune question disponible pour ce quiz.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    
    <div class="flex flex-wrap justify-between gap-4 mt-6">
        <a href="{{ route('admin.cours.show', $quiz->cour_id) }}" 
           class=" text-bold inline-flex items-center px-5 py-2.5 bg-gray-400 border border-gray-600 rounded-lg shadow-sm text-gray-700 hover:bg-gray-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
            <i class="fas fa-arrow-left mr-2"></i> Retour au cours
        </a>
        
    
    </div>
</div>

@endsection