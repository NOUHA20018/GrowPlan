<link href="{{ asset('assets/css/apprenantStyle/index.css') }}" rel="stylesheet">       
<link href="{{ asset('assets/css/apprenantStyle/showQuiz.css') }}" rel="stylesheet">
@extends('layoutsApprenant.apprenantApp')

@section('content')
<div class="quiz-show-container">
     <form action="{{route('apprenant.reponses',$quiz->id)}}" method="post">
        @csrf
    <div class="quiz-card">
        <div class="quiz-header">
            <div class="quiz-header-content">
                <div>
                    <h1 class="quiz-title">{{ $quiz->title }}</h1>
                    <div class="quiz-meta">
                        <span class="quiz-meta-item">
                            {{ $quiz->cour->title }}
                        </span>
                        <span class="quiz-meta-item">
                           Crée par : {{ $quiz->user->nom }} {{ $quiz->user->prenom }}
                        </span>
                        @if($quiz->chapitre)
                        <span class="quiz-meta-item">
                            {{ $quiz->chapitre->title }}
                        </span>
                        @endif
                    </div>
                </div>
                <div class="quiz-badges">
                    <span class="quiz-badge">
                        <i class="fas fa-question-circle"></i> {{ $quiz->questions->count() }} questions
                    </span>
                    <span class="quiz-badge">
                        <i class="fas fa-users"></i> {{ $quiz->apprenants->count() }} participants
                    </span>
                </div>
            </div>
        </div>
        
        <div class="quiz-description">
            @if($quiz->description)
            <h3>Description</h3>
            <p>{{ $quiz->description }}</p>
            @else
            <p class="no-description">Aucune description fournie pour ce quiz.</p>
            @endif
        </div>
        <div class="questions-section">
            <h3><i class="fas fa-list-ul"></i> Liste des questions</h3>
            <div class="questions-list">
                @forelse($quiz->questions as $index=> $question)
                <div class="question-card">
                    <div class="question-header">
                        <h4 class="question-text">
                            <span class="question-number">{{ $loop->iteration }}</span>
                            {{ $question->question_text }}
                        </h4>
                    </div>
                    <div class="options-list">
                        <ul>
                            @foreach($question->reponses_possible as  $response)
                            <li class="option-item">
                            <input type="radio" name="option_text[{{ $question->id }}]" value="{{ $response->id }}">
                                    {{ $response->option_text }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @empty
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <p>Aucune question disponible pour ce quiz.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="action-buttons">
        <a href="{{ route('admin.cours.show', $quiz->cour_id) }}" class="btn btn-back">
            <i class="fas fa-arrow-left"></i> Retour au cours
        </a>
        
        <button class="btn btn-danger" type="submit">Envoyer</button>
    </div>
</form>
</div>
@endsection