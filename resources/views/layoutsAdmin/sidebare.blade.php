<!-- Alpine.js for mobile menu toggle -->
<script src="//unpkg.com/alpinejs" defer></script>

<nav x-data="{ open: false }" class="bg-blue-900 text-white shadow-md sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-4">
    <div class="flex justify-between items-center h-16">
      <!-- Logo -->
      <div class="flex items-center">
        <i class="fas fa-user-shield text-xl mr-2"></i>
        <span class="text-xl font-semibold">Admin Panel</span>
      </div>

      <!-- Mobile menu button -->
      <div class="md:hidden flex items-center">
        <button @click="open = !open" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-white hover:bg-blue-700 focus:outline-none">
          <span class="sr-only">Open main menu</span>
          <i class="fas fa-bars"></i>
        </button>
      </div>

      <!-- Desktop menu -->
      <div class="hidden md:flex items-center space-x-1">
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-blue-700' : 'hover:bg-blue-700' }} px-3 py-2 rounded-md text-sm font-medium flex items-center">
          <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
        </a>

        <a href="{{ route('admin.cours.attente') }}" class="{{ request()->routeIs('admin.cours.attente') ? 'bg-blue-700' : 'hover:bg-blue-700' }} px-3 py-2 rounded-md text-sm font-medium flex items-center">
          <i class="fas fa-clock mr-1"></i> Cours en attente
          @if($enAttenteCount > 0)
            <span class="ml-2 bg-yellow-500 text-black text-xs font-bold px-2 py-0.5 rounded-full">{{ $enAttenteCount }}</span>
          @endif
        </a>

        <a href="{{ route('admin.cours.valides') }}" class="{{ request()->routeIs('admin.cours.valides') ? 'bg-blue-700' : 'hover:bg-blue-700' }} px-3 py-2 rounded-md text-sm font-medium flex items-center">
          <i class="fas fa-check-circle mr-1"></i> Cours validés
          @if($valideCount > 0)
            <span class="ml-2 bg-green-500 text-black text-xs font-bold px-2 py-0.5 rounded-full">{{ $valideCount }}</span>
          @endif
        </a>

        <a href="{{ route('admin.cours.refuses') }}" class="{{ request()->routeIs('admin.cours.refuses') ? 'bg-blue-700' : 'hover:bg-blue-700' }} px-3 py-2 rounded-md text-sm font-medium flex items-center">
          <i class="fas fa-times-circle mr-1"></i> Cours refusés
          @if($refuseCount > 0)
            <span class="ml-2 bg-red-500 text-black text-xs font-bold px-2 py-0.5 rounded-full">{{ $refuseCount }}</span>
          @endif
        </a>

        <a href="{{ route('admin.formateurs') }}" class="{{ request()->routeIs('admin.formateurs') ? 'bg-blue-700' : 'hover:bg-blue-700' }} px-3 py-2 rounded-md text-sm font-medium flex items-center">
          <i class="fas fa-chalkboard-teacher mr-1"></i> Formateurs
        </a>

        <a href="{{ route('admin.apprenants') }}" class="{{ request()->routeIs('admin.apprenants') ? 'bg-blue-700' : 'hover:bg-blue-700' }} px-3 py-2 rounded-md text-sm font-medium flex items-center">
          <i class="fas fa-users mr-1"></i> Apprenants
        </a>
        
        <a href="#" class="px-3 py-2 rounded-md text-sm font-medium flex items-center"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fas fa-users mr-1"></i> Se déconnecter
        </a>

        
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        
      </div>
    </div>
  </div>

  <!-- Mobile menu (visible seulement quand open == true) -->
  <div x-show="open" x-transition class="md:hidden absolute bg-blue-900 w-full z-40 top-full left-0">
    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
      <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-blue-700' : 'hover:bg-blue-700' }} block px-3 py-2 rounded-md text-base font-medium flex items-center">
        <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
      </a>

      <a href="{{ route('admin.cours.attente') }}" class="{{ request()->routeIs('admin.cours.attente') ? 'bg-blue-700' : 'hover:bg-blue-700' }} block px-3 py-2 rounded-md text-base font-medium flex items-center">
        <i class="fas fa-clock mr-2"></i> Cours en attente
        @if($enAttenteCount > 0)
          <span class="ml-2 bg-red-500 text-black text-xs font-bold px-2 py-0.5 rounded-full">{{ $enAttenteCount }}</span>
        @endif
      </a>

      <a href="{{ route('admin.cours.valides') }}" class="{{ request()->routeIs('admin.cours.valides') ? 'bg-blue-700' : 'hover:bg-blue-700' }} block px-3 py-2 rounded-md text-base font-medium flex items-center">
        <i class="fas fa-check-circle mr-2"></i> Cours validés
      </a>

      <a href="{{ route('admin.cours.refuses') }}" class="{{ request()->routeIs('admin.cours.refuses') ? 'bg-blue-700' : 'hover:bg-blue-700' }} block px-3 py-2 rounded-md text-base font-medium flex items-center">
        <i class="fas fa-times-circle mr-2"></i> Cours refusés
      </a>

      <a href="{{ route('admin.formateurs') }}" class="{{ request()->routeIs('admin.formateurs') ? 'bg-blue-700' : 'hover:bg-blue-700' }} block px-3 py-2 rounded-md text-base font-medium flex items-center">
        <i class="fas fa-chalkboard-teacher mr-2"></i> Formateurs
      </a>

      <a href="{{ route('admin.apprenants') }}" class="{{ request()->routeIs('admin.apprenants') ? 'bg-blue-700' : 'hover:bg-blue-700' }} block px-3 py-2 rounded-md text-base font-medium flex items-center">
        <i class="fas fa-users mr-2"></i> Apprenants
      </a>
    </div>
    
  </div>
</nav>
