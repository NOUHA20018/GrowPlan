@extends('layoutsApprenant.apprenantApp')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tableau de Bord</h1>
    </div>
    @include('layoutsApprenant.row')

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card welcome-card shadow">
                <div class="card-body">
                    <div class="text-center">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name.' '.auth()->user()->prenom) }}&background=ffffff&color=4e73df&size=100" alt="Profile" class="rounded-circle mb-3">
                        <h3 class="text-white">Bienvenue, {{ auth()->user()->prenom }} {{ auth()->user()->name }} !</h3>
                        <a href="{{ route('apprenant.index') }}" class="btn btn-light">
                            <i class="fas fa-arrow-right me-2"></i> Accéder à mes cours
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Progression des cours</h6>
                </div>
                <div class="card-body">
                    @foreach (auth()->user()->apprenant_cours as $cour)
                    <h4 class="small font-weight-bold">{{$cour->title}}<span class="float-right"> {{$cour->pivot->progression}}</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{$cour->pivot->progression}}%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>


        <div class="">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Derniers cours ajoutés</h6>
                </div>
                <div class="card-body">
                    
                    @foreach ($lastCours as $cour)
                    <div class="d-flex mb-3 p-3 border rounded shadow-sm">
                        <div class="flex-shrink-0 me-3">
                            @if($cour->image)
                                <img src="{{ asset('Cours/'.$cour->id.'/'. $cour->image) }}" alt="Image du cours" class="rounded" style="width: 100px; height: 100px; object-fit: cover;">
                            @else
                                <img src="https://via.placeholder.com/100x100?text=Cours" alt="Image par défaut" class="rounded">
                            @endif
                        </div>

                        <div class="flex-grow-1">
                            <h5 class="mb-1">{{ $cour->titre }}</h5>
                            <p class="mb-1 text-muted">{{ Str::limit($cour->description, 100) }}</p>
                            <p class="mb-1 text-muted"><i class="fas fa-user me-1"></i> Formateur : {{ $cour->user->name ?? 'Inconnu' }}</p>
                            <small class="text-muted"><i class="fas fa-clock me-1"></i> Ajouté {{ $cour->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    
                @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection