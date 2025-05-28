<link href="{{ asset('assets/css/apprenantStyle/index.css') }}" rel="stylesheet">       
<link href="{{ asset('assets/css/apprenantStyle/quizResults.css') }}" rel="stylesheet">
@extends('layoutsApprenant.apprenantApp')

@section('content')
<div class="quiz-results-container">
    <div class="quiz-header">
        <h1 class="quiz-title">
            <i class="fas fa-clipboard-check"></i> Résultats du Quiz: {{ $quiz->title }}
        </h1>
        <div class="quiz-score-container">
            <div class="score-circle {{ $progression >= 70 ? 'high-score' : ($progression >= 50 ? 'medium-score' : 'low-score') }}">
                <span class="score-value">{{ $progression }}%</span>
            </div>
            <div class="score-details">
                <p><span class="correct-count">{{ $pivot->pivot->score}}</span> bonnes réponses</p>
                <p><span class="total-questions">{{ $quiz->questions->count() }}</span> questions total</p>
            </div>
        </div>
    </div>

    <div class="questions-results">
        @foreach($quiz->questions as $question)
        @php
            $correctAnswer = $question->reponses_possible->where('is_correct', 1)->first();
            $userAnswerId = $responses[$question->id] ?? null;
            $userAnswer = $question->reponses_possible->firstWhere('id', $userAnswerId);
            $isCorrect = $userAnswer && $userAnswer->is_correct;
        @endphp
        
        <div class="question-card {{ $isCorrect ? 'correct' : 'incorrect' }}">
            <div class="question-header">
                <span class="question-number">Question {{ $loop->iteration }}</span>
                <h3 class="question-text">{{ $question->question_text }}</h3>
            </div>

            <div class="answers-comparison">
                <div class="user-answer">
                    <h4 class="answer-label">Votre réponse:</h4>
                    <div class="answer-content">
                        @if($userAnswer)
                            <span class="answer-text">{{ $userAnswer->option_text }}</span>
                            <span class="answer-status-icon">
                                @if($isCorrect)
                                    <i class="fas fa-check-circle correct-icon"></i>
                                @else
                                    <i class="fas fa-times-circle incorrect-icon"></i>
                                @endif
                            </span>
                        @else
                            <span class="no-answer">Non répondu</span>
                        @endif
                    </div>
                </div>

                @if(!$isCorrect)
                <div class="correct-answer">
                    <h4 class="answer-label">Bonne réponse:</h4>
                    <div class="answer-content">
                        <span class="answer-text">{{ $correctAnswer->option_text }}</span>
                        <span class="answer-status-icon">
                            <i class="fas fa-check-circle correct-icon"></i>
                        </span>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <div class="quiz-footer">
        <a href="{{ route('apprenant.cours.show', $quiz->cour_id) }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Retour au cours
        </a>
    </div>
</div>
@endsection