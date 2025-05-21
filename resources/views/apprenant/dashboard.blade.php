@extends('layoutsApprenant.apprenantApp')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tableau de Bord</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Générer Rapport
        </a>
    </div>
    <!-- Content Row -->
    @include('layoutsApprenant.row')

    <!-- Content Row -->
    <div class="row">
        <!-- Welcome Card -->
        <div class="col-lg-6 mb-4">
            <div class="card welcome-card shadow">
                <div class="card-body">
                    <div class="text-center">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name.' '.auth()->user()->prenom) }}&background=ffffff&color=4e73df&size=100" alt="Profile" class="rounded-circle mb-3">
                        <h3 class="text-white">Bienvenue, {{ auth()->user()->prenom }} {{ auth()->user()->name }} !</h3>
                        {{-- <p class="text-white-50 mb-4">Vous avez 3 nouvelles notifications et 2 cours à terminer cette semaine.</p> --}}
                        <a href="{{ route('apprenant.index') }}" class="btn btn-light">
                            <i class="fas fa-arrow-right me-2"></i> Accéder à mes cours
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progression des cours -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Progression des cours</h6>
                </div>
                <div class="card-body">
                    <h4 class="small font-weight-bold">Développement Web <span class="float-right">85%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Base de données <span class="float-right">60%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Framework Laravel <span class="float-right">30%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">JavaScript Avancé <span class="float-right">15%</span></h4>
                    <div class="progress">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Calendrier et Activités récentes -->
    <div class="row">
        <!-- Calendrier -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Calendrier</h6>
                </div>
                <div class="card-body text-center">
                    <div class="mb-4">
                        <span class="fs-3 fw-bold">Octobre 2023</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Lun</th>
                                    <th>Mar</th>
                                    <th>Mer</th>
                                    <th>Jeu</th>
                                    <th>Ven</th>
                                    <th>Sam</th>
                                    <th>Dim</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-muted">26</td>
                                    <td class="text-muted">27</td>
                                    <td class="text-muted">28</td>
                                    <td class="text-muted">29</td>
                                    <td class="text-muted">30</td>
                                    <td>1</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>4</td>
                                    <td>5</td>
                                    <td>6</td>
                                    <td>7</td>
                                    <td>8</td>
                                    <td>9</td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td class="bg-primary text-white">11</td>
                                    <td>12</td>
                                    <td>13</td>
                                    <td>14</td>
                                    <td>15</td>
                                    <td>16</td>
                                </tr>
                                <tr>
                                    <td>17</td>
                                    <td>18</td>
                                    <td>19</td>
                                    <td>20</td>
                                    <td>21</td>
                                    <td>22</td>
                                    <td>23</td>
                                </tr>
                                <tr>
                                    <td>24</td>
                                    <td>25</td>
                                    <td>26</td>
                                    <td>27</td>
                                    <td>28</td>
                                    <td>29</td>
                                    <td>30</td>
                                </tr>
                                <tr>
                                    <td>31</td>
                                    <td class="text-muted">1</td>
                                    <td class="text-muted">2</td>
                                    <td class="text-muted">3</td>
                                    <td class="text-muted">4</td>
                                    <td class="text-muted">5</td>
                                    <td class="text-muted">6</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        <span class="badge bg-primary me-2">Aujourd'hui</span>
                        <span class="badge bg-success me-2">Échéance</span>
                        <span class="badge bg-warning">Événement</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activités récentes -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Activités récentes</h6>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="d-flex position-relative mb-4">
                            <div class="flex-shrink-0 me-3">
                                <i class="fas fa-check-circle text-success fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Cours terminé</h6>
                                <p class="text-muted mb-1">Introduction à Laravel</p>
                                <small class="text-muted">Aujourd'hui, 10:45</small>
                            </div>
                        </div>
                        <div class="d-flex position-relative mb-4">
                            <div class="flex-shrink-0 me-3">
                                <i class="fas fa-book-open text-primary fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Nouveau chapitre</h6>
                                <p class="text-muted mb-1">Eloquent ORM - Relations</p>
                                <small class="text-muted">Hier, 14:30</small>
                            </div>
                        </div>
                        <div class="d-flex position-relative mb-4">
                            <div class="flex-shrink-0 me-3">
                                <i class="fas fa-certificate text-warning fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Certificat obtenu</h6>
                                <p class="text-muted mb-1">PHP Avancé</p>
                                <small class="text-muted">12 Oct, 2023</small>
                            </div>
                        </div>
                        <div class="d-flex position-relative mb-4">
                            <div class="flex-shrink-0 me-3">
                                <i class="fas fa-comment-alt text-info fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Nouveau commentaire</h6>
                                <p class="text-muted mb-1">Sur votre projet final</p>
                                <small class="text-muted">10 Oct, 2023</small>
                            </div>
                        </div>
                        <div class="d-flex position-relative">
                            <div class="flex-shrink-0 me-3">
                                <i class="fas fa-tasks text-danger fa-2x"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">Devoir à rendre</h6>
                                <p class="text-muted mb-1">Projet CRUD Laravel</p>
                                <small class="text-muted">Échéance: 15 Oct, 2023</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection