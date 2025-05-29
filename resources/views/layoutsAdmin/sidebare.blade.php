
<script src="//unpkg.com/alpinejs" defer></script>

<nav x-data="{ open: false }" class="bg-blue-900 text-white shadow-md sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-4">
    <div class="flex justify-between items-center h-16">
      
      <div class="flex items-center">
        <i class="fas fa-user-cog text-xl mr-2"></i>
        <span class="text-xl font-semibold">Admin Panel</span>
      </div>
      <div class="md:hidden flex items-center space-x-4">
        
        <a href="{{ route('admin.notifications') }}" class="relative p-2 rounded-full hover:bg-blue-700">
          <i class="fas fa-bell"></i>
          @if($notificationsCount > 0)
            <span class="absolute top-0 right-0 h-4 w-4 bg-red-500 rounded-full text-xs flex items-center justify-center">{{ $notificationsCount }}</span>
          @endif
        </a>
        
        <button @click="open = !open" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-white hover:bg-blue-700 focus:outline-none">
          <span class="sr-only">Open main menu</span>
          <i class="fas fa-bars"></i>
        </button>
      </div>
      <div class="hidden md:flex items-center space-x-1">
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-blue-700' : 'hover:bg-blue-700' }} px-3 py-2 rounded-md text-sm font-medium flex items-center">
          <i class="fas fa-chart-line mr-1"></i> Dashboard
        </a>
        <a href="{{ route('admin.cours.attente') }}" class="{{ request()->routeIs('admin.cours.attente') ? 'bg-blue-700' : 'hover:bg-blue-700' }} px-3 py-2 rounded-md text-sm font-medium flex items-center">
          <i class="fas fa-hourglass-half mr-1"></i> Cours en attente
          @if($enAttenteCount > 0)
            <span class="ml-2 bg-yellow-500 text-black text-xs font-bold px-2 py-0.5 rounded-full">{{ $enAttenteCount }}</span>
          @endif
        </a>

        <a href="{{ route('admin.cours.valides') }}" class="{{ request()->routeIs('admin.cours.valides') ? 'bg-blue-700' : 'hover:bg-blue-700' }} px-3 py-2 rounded-md text-sm font-medium flex items-center">
          <i class="fas fa-check-double mr-1"></i> Cours validés
          @if($valideCount > 0)
            <span class="ml-2 bg-green-500 text-black text-xs font-bold px-2 py-0.5 rounded-full">{{ $valideCount }}</span>
          @endif
        </a>

        <a href="{{ route('admin.cours.refuses') }}" class="{{ request()->routeIs('admin.cours.refuses') ? 'bg-blue-700' : 'hover:bg-blue-700' }} px-3 py-2 rounded-md text-sm font-medium flex items-center">
          <i class="fas fa-ban mr-1"></i> Cours refusés
          @if($refuseCount > 0)
            <span class="ml-2 bg-red-500 text-black text-xs font-bold px-2 py-0.5 rounded-full">{{ $refuseCount }}</span>
          @endif
        </a>

        <a href="{{ route('admin.formateurs') }}" class="{{ request()->routeIs('admin.formateurs') ? 'bg-blue-700' : 'hover:bg-blue-700' }} px-3 py-2 rounded-md text-sm font-medium flex items-center">
          <i class="fas fa-user-tie mr-1"></i> Formateurs
        </a>

        <a href="{{ route('admin.apprenants') }}" class="{{ request()->routeIs('admin.apprenants') ? 'bg-blue-700' : 'hover:bg-blue-700' }} px-3 py-2 rounded-md text-sm font-medium flex items-center">
          <i class="fas fa-user-graduate mr-1"></i> Apprenants
        </a>
        
       
        <div class="relative mx-2">
          <a href="{{ route('admin.notifications') }}" class="p-2 rounded-full hover:bg-white relative">
          <i class="fa-light fa-bell text-white"></i>
            @if($notificationsCount > 0)
              <span class="absolute top-0 right-0 h-4 w-4 bg-red-500 rounded-full text-xs flex items-center justify-center">{{ $notificationsCount }}</span>
            @endif
          </a>
        </div>


        <x-dropdown align="right" width="48">
          <x-slot name="trigger">
              <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-800 hover:bg-blue-700 focus:outline-none transition ease-in-out duration-150">
                  <i class="fas fa-user-circle mr-2"></i>
                  <div>{{ Auth::user()->name }}</div>
                  <div class="ms-1">
                      <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                      </svg>
                  </div>
              </button>
          </x-slot>
          <x-slot name="content">
              <x-dropdown-link :href="route('profile.edit')">
                <i class="fas fa-user-cog mr-2"></i> {{ __('Profile') }}
              </x-dropdown-link>
              <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="fas fa-sign-out-alt mr-2"></i> {{ __('Log Out') }}
                  </x-dropdown-link>
              </form>
          </x-slot>
        </x-dropdown>
      </div>
    </div>
  </div>

  
  <div x-show="open" x-transition class="md:hidden absolute bg-blue-900 w-full z-40 top-full left-0">
    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
      <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-blue-700' : 'hover:bg-blue-700' }} block px-3 py-2 rounded-md text-base font-medium flex items-center">
        <i class="fas fa-chart-line mr-2"></i> Dashboard
      </a>

      <a href="{{ route('admin.cours.attente') }}" class="{{ request()->routeIs('admin.cours.attente') ? 'bg-blue-700' : 'hover:bg-blue-700' }} block px-3 py-2 rounded-md text-base font-medium flex items-center">
        <i class="fas fa-hourglass-half mr-2"></i> Cours en attente
        @if($enAttenteCount > 0)
          <span class="ml-2 bg-red-500 text-black text-xs font-bold px-2 py-0.5 rounded-full">{{ $enAttenteCount }}</span>
        @endif
      </a>

      <a href="{{ route('admin.cours.valides') }}" class="{{ request()->routeIs('admin.cours.valides') ? 'bg-blue-700' : 'hover:bg-blue-700' }} block px-3 py-2 rounded-md text-base font-medium flex items-center">
        <i class="fas fa-check-double mr-2"></i> Cours validés
      </a>

      <a href="{{ route('admin.cours.refuses') }}" class="{{ request()->routeIs('admin.cours.refuses') ? 'bg-blue-700' : 'hover:bg-blue-700' }} block px-3 py-2 rounded-md text-base font-medium flex items-center">
        <i class="fas fa-ban mr-2"></i> Cours refusés
      </a>

      <a href="{{ route('admin.formateurs') }}" class="{{ request()->routeIs('admin.formateurs') ? 'bg-blue-700' : 'hover:bg-blue-700' }} block px-3 py-2 rounded-md text-base font-medium flex items-center">
        <i class="fas fa-user-tie mr-2"></i> Formateurs
      </a>

      <a href="{{ route('admin.apprenants') }}" class="{{ request()->routeIs('admin.apprenants') ? 'bg-blue-700' : 'hover:bg-blue-700' }} block px-3 py-2 rounded-md text-base font-medium flex items-center">
        <i class="fas fa-user-graduate mr-2"></i> Apprenants
      </a>
      
      <a href="{{ route('admin.notifications') }}" class="block px-3 py-2 rounded-md text-base font-medium flex items-center hover:bg-blue-700">
        <i class="fas fa-bell mr-2"></i> Notifications
        @if($notificationsCount > 0)
          <span class="ml-2 bg-red-500 text-black text-xs font-bold px-2 py-0.5 rounded-full">{{ $notificationsCount }}</span>
        @endif
      </a>
      
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full text-left px-3 py-2 rounded-md text-base font-medium flex items-center hover:bg-blue-700">
          <i class="fas fa-sign-out-alt mr-2"></i> Se déconnecter
        </button>
      </form>
    </div>
  </div>
</nav>