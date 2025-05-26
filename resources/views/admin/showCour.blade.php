<link rel="stylesheet" href="{{asset('assets/css/admin/showCour.css')}}">
@extends('layoutsAdmin.adminApp')
@section('content')
<div class="course-container">
    <div class="course-header flex justify-between">
        <div class="course-header-content">
            <h1>{{ $course->title }}</h1>
            <p class="course-formateur">Par {{ $course->user->nom }} {{ $course->user->prenom }}</p>
            <div class="course-info">
                <span class="course-category">{{ $course->categorie->title }}</span>
            </div>
        </div>
        @if($course->image)
            <div class="course-image">
                <img src="{{ asset('Cours/'.$course->id.'/'.$course->image) }}" alt="Course Image">
            </div>
        @endif
    </div>
    
    <div class="course-details">
        <div class="course-info2">
            <div class="course-dates">
                <span><i class="fas fa-calendar-alt"></i> Créé le {{ $course->created_at->format('d/m/Y') }}</span>
                {{-- <span><i class="fas fa-clock"></i> {{ $course->chapitres->sum('duree') }} min</span> --}}
            </div>
            
            <div class="course-description">
                <strong><h1>Description</h1></strong>
                <p>{{ $course->description }}</p>
            </div>
            
            
        </div>

        <div class="course-section">
            <h2><i class="fas fa-list-ol"></i> <strong>Chapitres ({{ $course->chapitres->count() }})</strong></h2>
            
            <div class="chapter-list">
                @forelse($course->chapitres as $chapitre)
                <div class="chapter-item">
                    <div class="chapter-content">
                        <strong><h2>{{ $chapitre->title }}</h2></strong>
                        <p class="chapter-duration"><i class="fas fa-clock"></i> {{ $chapitre->duree }} min</p>
                        @if($chapitre->resume)
                        <div class="chapter-summary">
                            {{ $chapitre->resume }}
                        </div>
                        @endif
                    </div>
                    <div class="chapter-actions">
                        <a href="{{route('admin.cours.show.chapitre',$chapitre->id)}}" class="btn-view">
                            <i class="fas fa-play"></i> Voir
                        </a>
                    </div>
                </div>
                @empty
                <div class="empty-state">
                    Aucun chapitre disponible pour ce cours.
                </div>
                @endforelse
            </div>
        </div>

        <div class="course-section">
            <strong><h2><i class="fas fa-question-circle"></i> Quiz ({{ $course->quizzes->count() }})</h2></strong>
            
            <div class="quiz-list">
                @forelse($course->quizzes as $quiz)
                <div class="quiz-item">
                    <div class="quiz-content">
                        <h3>{{ $quiz->title }}</h3>
                        <p class="quiz-questions">{{ $quiz->questions->count() }} questions</p>
                        @if($quiz->description)
                        <div class="quiz-description">
                            {{ $quiz->description }}
                        </div>
                        @endif
                    </div>
                    <div class="quiz-actions">
                        <a href="{{route('admin.cours.show.quiz',$quiz->id)}}" class="btn-view">
                            <i class="fas fa-eye"></i> Voir
                        </a>
                    </div>
                </div>
                @empty
                <div class="empty-state">
                    Aucun quiz disponible pour ce cours.
                </div>
                @endforelse
            </div>
        </div>
    </div>
     <div class="flex flex-wrap justify-between gap-4 mt-6">
        <a href="{{ route('admin.cours.attente') }}" 
           class=" text-bold inline-flex items-center px-5 py-2.5 bg-gray-400 border border-gray-600 rounded-lg shadow-sm text-gray-700 hover:bg-gray-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
            <i class="fas fa-arrow-left mr-2"></i> Retour au cours
        </a>
        
    
    </div>
</div>
@endsection