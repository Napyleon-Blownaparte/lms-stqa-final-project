<header class="absolute inset-x-0 top-0 z-50">
    <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="flex">
            <a href="#" class="">
                <span class="sr-only">Your Company</span>
                <img class="h-16 w-auto" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRV_AmbN0Xg1Nf8m6vhjNWoDJgCmJCO7E-UAA&s" alt="">
            </a>
        </div>
        <div class="flex lg:hidden">
            <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700" id="menu-button">
                <span class="sr-only">Open main menu</span>
                <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
        <div class="hidden lg:flex lg:gap-x-12 lg:justify-center w-full max-w-screen-lg mx-auto translate-x-[-2em]">
            <div class="flex items-center gap-x-12">
                <a href="{{ route('flights.index') }}" class="text-sm font-bold text-gray-900 hover:text-indigo-600 transform hover:scale-105 transition duration-300 ease-in-out">
                    Show All Flights
                </a>
                @auth
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-sm font-bold text-gray-900 hover:text-indigo-600 transform hover:scale-105 transition duration-300 ease-in-out">
                            Logout
                        </button>
                    </form>
                @endauth
            </div>


            <!-- Button for guests (Login) -->
            @guest
                <a href="{{ route('login') }}" class="text-sm font-bold text-gray-900 hover:text-indigo-600 transform hover:scale-105 transition duration-300 ease-in-out">
                    Login
                </a>
            @endguest
        </div>
    </nav>

    <!-- Mobile menu for small screens -->
    <div class="lg:hidden" id="mobile-menu" role="dialog" aria-modal="true">
        <div class="fixed inset-0 z-50 bg-gray-500 opacity-50" id="backdrop"></div>
        <div class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
            <div class="flex items-center justify-between">
                <a href="#" class="-m-1.5 p-1.5">
                    <span class="sr-only">Your Company</span>
                    <img class="h-8 w-auto" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRV_AmbN0Xg1Nf8m6vhjNWoDJgCmJCO7E-UAA&s" alt="">
                </a>
                <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700" id="close-button">
                    <span class="sr-only">Close menu</span>
                    <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="mt-6 flow-root">
                <div class="-my-6 divide-y divide-gray-500/10">
                    <div class="space-y-2 py-6">
                        <a href="{{ route('flights.index')  }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-gray-50">Add Purchase</a>

                        <!-- Mobile Login and Logout buttons -->
                        @auth
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-gray-50">
                                    Logout
                                </button>
                            </form>
                        @endauth

                        @guest
                            <a href="{{ route('login') }}" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-gray-50">Login</a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    const menuButton = document.getElementById('menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const closeButton = document.getElementById('close-button');
    const backdrop = document.getElementById('backdrop');

    menuButton.addEventListener('click', () => {
        mobileMenu.classList.remove('hidden');
        backdrop.classList.remove('hidden');
    });

    closeButton.addEventListener('click', () => {
        mobileMenu.classList.add('hidden');
        backdrop.classList.add('hidden');
    });

    backdrop.addEventListener('click', () => {
        mobileMenu.classList.add('hidden');
        backdrop.classList.add('hidden');
    });
</script>
