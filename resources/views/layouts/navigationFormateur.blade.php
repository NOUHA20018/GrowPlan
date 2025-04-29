<nav x-data="{ open: false }" class="navbar-custom">
    <div class="navbar-inner">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="ml-4 text-gray-800">
                        <h1>Hello {{ Auth::user()->name }}!</h1>
                    </div>
                </div>

                <div class="flex justify-center flex-1 items-center">
                    <div class="relative w-full max-w-xl">
                        <input type="text" class="w-full px-4 py-2 pl-10 pr-4 border rounded-md text-sm text-gray-700 placeholder-gray-500" placeholder="Search..." />
                        {{-- <i class='fa fa-search'></i>                 --}}
                        <div class="absolute top-3 right-3">
                            <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 18a8 8 0 100-16 8 8 0 000 16zm0 0l6 6" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <button class="p-2 text-gray-500 hover:text-gray-700">
                        <span class="material-symbols-outlined">notifications</span>
                    </button>

                    <div class="relative">
                        <button class="p-2 text-gray-500 hover:text-gray-700">
                            <img src="{{ Auth::user()->image }}" alt="User Image" class="h-8 w-8 rounded-full">
                        </button>
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>