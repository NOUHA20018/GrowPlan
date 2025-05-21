<div class="sidebar d-none d-lg-flex flex-column p-3" style="width: 250px;">
            <a href="{{ route('apprenant.dashboard') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <i class="fas fa-graduation-cap me-2"></i>
                <span class="fs-4">Espace Apprenant</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('apprenant.dashboard') }}" class="nav-link active">
                        <i class="fas fa-tachometer-alt me-2"></i>
                        Tableau de bord
                    </a>
                </li>
                <li>
                    <a href="{{ route('apprenant.index') }}" class="nav-link text-white">
                        <i class="fas fa-book me-2"></i>
                        Mes cours
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white">
                        <i class="fas fa-calendar-alt me-2"></i>
                        Calendrier
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white">
                        <i class="fas fa-chart-bar me-2"></i>
                        Progression
                    </a>
                </li>
               
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name.' '.auth()->user()->prenom) }}&background=random" alt="Profile" width="32" height="32" class="rounded-circle me-2">
                    <strong>{{ auth()->user()->prenom }} {{ auth()->user()->name }}</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li><a class="dropdown-item" href="#">Profil</a></li>
                    <li><a class="dropdown-item" href="#">Paramètres</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Déconnexion</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>