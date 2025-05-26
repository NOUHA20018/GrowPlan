<link href="{{ asset('assets/css/apprenantStyle/index.assets/css') }}" rel="stylesheet">       
<link href="{{ asset('assets/css/apprenantStyle/show.css') }}" rel="stylesheet">
@extends('layoutsApprenant.apprenantApp')

@section('content')
<div class="course-show-container ">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
    @endif


    <div class="flex justify-between">
        <div><h1 class="course-title">{{ $cour->title }}</h1></div>
        <div>

        @if(!auth()->user()->coursInscrits->contains($cour->id))
         <a href="{{ route('apprenant.sinscrire', $cour->id) }}" class="btn btn-primary"> 
            S'inscrire
        </a> 
        @else
            <p class="text-success">Vous êtes déjà inscrit à ce cours </p>
        @endif
        </div>
    </div>
    
    <div class="course-content">
        <div class="course-details">
            <div class="course-description">
                <h3>Description du cours</h3>
                <p>{{ $cour->description }}</p>
            </div>
            
            <div class="course-image">
                <img src="{{ asset('Cours/'.$cour->id.'/'.$cour->image) }}" alt="{{ $cour->title }}" class="img-fluid">
            </div>
            
            <div class="course-meta">
                <div class="meta-item">
                    <span class="meta-label">Prix:</span>
                    <span class="meta-value">{{ $cour->prix }} dh</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Date de création:</span>
                    <span class="meta-value">{{ \Carbon\Carbon::parse($cour->date_creation)->format('d/m/Y') }}</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Catégorie:</span>
                    <span class="meta-value">{{ $cour->categorie->title }}</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Formateur:</span>
                    <span class="meta-value">{{ $cour->user->name }}</span>
                </div>
            </div>
        </div>
        
        <div class="chapters-section">
            <h2 class="section-title">Chapitres du cours</h2>
            
           @php
                $isInscrit = auth()->user()->coursInscrits->contains($cour->id);
            @endphp

        <div class="chapters-list">
            @foreach ($cour->chapitres as $chapitre)
                <div class="chapter-item">
                    <div class="chapter-icon">📘</div>
                    <div class="chapter-info">
                        <h3 class="chapter-title">{{ $chapitre->title }}</h3>
                        <span class="chapter-duration">{{ $chapitre->duree }} min</span>
                    </div>
                    <div class="chapter-arrow">
                        @if($isInscrit)
                            <a href="{{ route('apprenant.showChapter', $chapitre->id) }}">→</a>
                        @else
                            <span title="Veuillez vous inscrire pour accéder">🔒</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="quiz-list">
           
            @foreach ($cour->quizzes as $quiz)
                <div class="quiz-item">
                    <div class="quiz-icon">
                        <span class="text-2xl mr-2">📝</span>
                    </div>
                    <div class="quiz-info">
                    <div class="quiz-title">{{$quiz->title}}</div>
                    <div class="quiz-questions">{{$quiz->questions->count()}} question</div>
                    </div>
                     <div class="quiz-arrow">
                        @if($isInscrit)
                            <a class="quiz-btn" href="{{ route('apprenant.showQuiz', $quiz->id) }}">Commencer</a>
                        @else
                            <span title="Veuillez vous inscrire pour accéder">🔒</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        </div>
    </div>
</div>
@endsection