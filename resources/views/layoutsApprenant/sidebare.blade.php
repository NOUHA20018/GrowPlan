<style>
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 250px;
    height: 100vh; /* pleine hauteur */
    background-color: #343a40;
    color: white;
    padding: 1rem;
    display: flex;
    flex-direction: column;
    overflow-y: auto;
    z-index: 1030;
}

.sidebar .dropdown {
    margin-top: auto; /* pousse le dropdown en bas */
    position: relative; /* pour dropdown-menu */
}

.sidebar .dropdown-menu {
    z-index: 1055;
    background-color: #343a40;
    border: none;
}
</style>

<div class="sidebar">
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
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
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
