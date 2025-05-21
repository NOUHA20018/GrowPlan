<link href="{{ asset('css/apprenantStyle/index.css') }}" rel="stylesheet">       
@extends('layoutsApprenant.apprenantApp')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tous les Cours</h1>
        
        <form method="GET" action="{{ route('apprenant.index') }}" class="form-inline">
            <div class="input-group">
                <select name="categorie" class="form-control" onchange="this.form.submit()">
                    <option value="all">Toutes les catégories</option>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}" 
                            {{ request('categorie') == $categorie->id ? 'selected' : '' }}>
                            {{ $categorie->title }}
                        </option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-filter"></i> Filtrer
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        @forelse($cours as $cour)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <!-- Category Badge -->
                    @if($cour->categorie)
                    <div class="position-absolute top-0 end-0 m-2">
                        <span class="badge bg-{{ $cour->categorie->couleur ?? 'primary' }}">
                            {{ $cour->categorie->title }}
                        </span>
                    </div>
                    @endif
                    
                    <!-- Course Image -->
                    <img src="{{ asset($cour->image ?? 'images/default-course.jpg') }}" 
                         class="card-img-top" 
                         alt="{{ $cour->titre }}"
                         style="height: 180px; object-fit: cover;">
                    
                    <div class="card-body">
                        <h5 class="card-title">{{ $cour->titre }}</h5>
                        <p class="card-text text-muted">
                            {{ Str::limit($cour->description, 100) }}
                        </p>
                        
                        <!-- Difficulty and Duration -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <i class="fas fa-signal text-{{ 
                                    $cour->difficulte == 'débutant' ? 'success' : 
                                    ($cour->difficulte == 'intermédiaire' ? 'warning' : 'danger') 
                                }}"></i>
                                <small class="text-muted ms-1">{{ ucfirst($cour->difficulte) }}</small>
                            </div>
                            <div>
                                <i class="far fa-clock text-primary"></i>
                                <small class="text-muted ms-1">{{ $cour->duree }} heures</small>
                            </div>
                        </div>
                        
                        <!-- Progress Bar -->
                        <div class="progress mb-3" style="height: 8px;">
                            <div class="progress-bar bg-success" 
                                 role="progressbar" 
                                 style="width: {{ rand(0, 100) }}%" 
                                 aria-valuenow="{{ rand(0, 100) }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100"></div>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-white border-top-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-primary fw-bold">
                                @if($cour->prix > 0)
                                    {{ number_format($cour->prix, 2) }} MAD
                                @else
                                    Gratuit
                                @endif
                            </span>
                            <a href="{{ route('apprenant.cours.show', $cour->id) }}" 
                               class="btn btn-sm btn-outline-primary">
                                Voir détails <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle fa-2x mb-3"></i>
                    <h4>Aucun cours disponible pour le moment</h4>
                    <p class="mb-0">Revenez plus tard pour découvrir nos nouveaux cours.</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $cours->links() }}
        </div>
    </div>
</div>
@endsection