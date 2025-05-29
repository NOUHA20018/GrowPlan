<link href="{{ asset('assets/css/apprenantStyle/index.css') }}" rel="stylesheet">    
<link href="{{ asset('assets/css/apprenantStyle/chapitre.css') }}" rel="stylesheet">    

@extends('layoutsApprenant.apprenantApp')


@section('content')
<div class="chapter-container">
    <!-- Chapter Header -->
    <div class="chapter-header">
        <div class="breadcrumb">
            <a href="{{ route('apprenant.cours.show', $chapitre->cour_id) }}">
                <i class="fas fa-arrow-left"></i> Retour au cours
            </a>
            <span> / {{ $chapitre->title }}</span>
        </div>
        <h1>{{ $chapitre->title }}</h1>
        <div class="chapter-meta">
            <span class="duration"><i class="far fa-clock"></i> {{ $chapitre->duree }} min</span>
            <span class="course-name">{{ $chapitre->cour->title }}</span>
        </div>
    </div>

    <!-- Video Section -->
    @if($chapitre->video)
    <div class="video-section">
        <h2><i class="fas fa-play-circle"></i> Vidéo du chapitre</h2>
        <div class="video-wrapper">
            <video id="chapter-video" controls controlsList="nodownload">
                <source src="{{ asset('chapitres/'.$chapitre->id.'/'.$chapitre->video) }}" type="video/mp4">
                Votre navigateur ne supporte pas la lecture vidéo.
            </video>
        </div>
        <div class="video-controls">
            <button id="play-pause" class="video-btn"><i class="fas fa-play"></i></button>
            <input type="range" id="progress-bar" min="0" max="100" value="0">
            <span id="time-display">00:00 / 00:00</span>
            <button id="fullscreen" class="video-btn"><i class="fas fa-expand"></i></button>
        </div>
    </div>
    @endif

    <!-- Resume Section -->
    @if($chapitre->resume)
    <div class="resume-section">
        <h2><i class="fas fa-file-alt"></i> Ressources du chapitre</h2>
        <div class="resume-card">
            @php
                $extension = pathinfo($chapitre->resume, PATHINFO_EXTENSION);
                $icon = '';
                $type = '';
                
                switch(strtolower($extension)) {
                    case 'pdf':
                        $icon = 'fa-file-pdf';
                        $type = 'Document PDF';
                        break;
                    case 'doc':
                    case 'docx':
                        $icon = 'fa-file-word';
                        $type = 'Document Word';
                        break;
                    case 'ppt':
                    case 'pptx':
                        $icon = 'fa-file-powerpoint';
                        $type = 'Présentation';
                        break;
                    case 'xls':
                    case 'xlsx':
                        $icon = 'fa-file-excel';
                        $type = 'Fichier Excel';
                        break;
                    default:
                        $icon = 'fa-file-download';
                        $type = 'Fichier à télécharger';
                }
            @endphp
            
            <div class="resume-icon">
                <i class="fas {{ $icon }}"></i>
            </div>
            <div class="resume-info">
                <h3>Résumé du chapitre</h3>
                <p>{{ $type }} - {{ strtoupper($extension) }}</p>
                <a href="{{ asset('chapitres/'.$chapitre->id.'/'.$chapitre->resume) }}" download class="download-btn">
                    <i class="fas fa-download"></i> Télécharger
                </a>
                @if(in_array(strtolower($extension), ['pdf', 'doc', 'docx', 'ppt', 'pptx']))
                <a href="{{ route('apprenant.viewResume', $chapitre->id) }}" target="_blank" class="view-btn">
                    <i class="fas fa-eye"></i> Visualiser
                </a>
                @endif
            </div>
        </div>
    </div>
    @endif


    <div class="chapter-navigation">
        @if($previousChapter)
        <a href="{{ route('apprenant.showChapter', $previousChapter->id) }}" class="nav-btn prev-btn">
            <i class="fas fa-chevron-left"></i> Chapitre précédent
        </a>
        @endif
        
        @if($nextChapter)
        <a href="{{ route('apprenant.showChapter', $nextChapter->id) }}" class="nav-btn next-btn">
            Chapitre suivant <i class="fas fa-chevron-right"></i>
        </a>
        @else
        <a href="{{ route('apprenant.cours.show', $chapitre->cour_id) }}" class="nav-btn complete-btn">
            <i class="fas fa-check-circle"></i> Terminer le cours
        </a>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const video = document.getElementById('chapter-video');
    const playPauseBtn = document.getElementById('play-pause');
    const progressBar = document.getElementById('progress-bar');
    const timeDisplay = document.getElementById('time-display');
    const fullscreenBtn = document.getElementById('fullscreen');
    
    if(video) {
       
        playPauseBtn.addEventListener('click', function() {
            if(video.paused) {
                video.play();
                playPauseBtn.innerHTML = '<i class="fas fa-pause"></i>';
            } else {
                video.pause();
                playPauseBtn.innerHTML = '<i class="fas fa-play"></i>';
            }
        });
        
       
        video.addEventListener('timeupdate', function() {
            const percent = (video.currentTime / video.duration) * 100;
            progressBar.value = percent;
            
           
            const currentMins = Math.floor(video.currentTime / 60);
            let currentSecs = Math.floor(video.currentTime % 60);
            if(currentSecs < 10) currentSecs = '0' + currentSecs;
            
            const durationMins = Math.floor(video.duration / 60);
            let durationSecs = Math.floor(video.duration % 60);
            if(durationSecs < 10) durationSecs = '0' + durationSecs;
            
            timeDisplay.textContent = `${currentMins}:${currentSecs} / ${durationMins}:${durationSecs}`;
        });
        
       
        progressBar.addEventListener('input', function() {
            const seekTime = (progressBar.value / 100) * video.duration;
            video.currentTime = seekTime;
        });
        
        fullscreenBtn.addEventListener('click', function() {
            if(video.requestFullscreen) {
                video.requestFullscreen();
            } else if(video.webkitRequestFullscreen) {
                video.webkitRequestFullscreen();
            } else if(video.msRequestFullscreen) {
                video.msRequestFullscreen();
            }
        });
        
       
        video.addEventListener('play', function() {
            playPauseBtn.innerHTML = '<i class="fas fa-pause"></i>';
        });
        
        video.addEventListener('pause', function() {
            playPauseBtn.innerHTML = '<i class="fas fa-play"></i>';
        });
    }
});
</script>
@endsection