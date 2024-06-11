<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticketing app</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@400;500;600&display=swap"
        rel="stylesheet">
</head>

<body class="font-hanken-grotesk pb-20 bg-gray-200">

    <div class="">
        <nav
            class="text-white flex justify-between items-center px-10 py-4 mx-auto border-b border-white/10 h-20 bg-red-800">
            <div class="">
                <a href="/">
                    <img src="{{ Vite::asset('resources/images/logoipsum-325.svg') }}" alt="" />
                </a>
            </div>

            <div class="space-x-6 font-bold">
                <x-agents.navbar-anchor :href="route('agent.tickets.indexNew')">
                    New Tickets
                </x-agents.navbar-anchor>
                <x-agents.navbar-anchor :href="route('agent.tickets.indexClosed')">
                    My Closed Tickets
                </x-agents.navbar-anchor>
            </div>


            @auth
                <div class="relative inline-block text-left">
                    <div>
                        <button type="button"
                            class="inline-flex justify-center rounded-md px-1 py-1 text-sm font-semibold text-gray-900 shadow-sm"
                            id="menu-button" aria-expanded="true" aria-haspopup="true">
                            <img src={{ asset(Auth::user()->image_path) }} alt="" class="w-12 h-12 rounded-full" />
                            <svg class="-mr-1 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>

                    <div class="hidden absolute text-gray-700 right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        id="menu-items" role="menu" aria-orientation="vertical" aria-labelledby="menu-button"
                        tabindex="-1">
                        <div class="py-1" role="none">
                            <div class="px-4 py-2">
                                {{ Auth::user()->name }}
                            </div>
                            <hr>
                            <form method="POST" action="/logout" class="max-h-12.4">
                                @csrf
                                @method('DELETE')

                                <button class="block w-full px-4 py-2 text-left text-sm text-gray-700">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth

            {{-- @auth
                <div class="font-bold space-x-6">
                    <form method="POST" action="/logout" class="max-h-12.4">
                        @csrf
                        @method('DELETE')

                        <button
                            class="group h-12.4 px-6 inline-block align-top max-w-xs mx-auto rounded-xl ring-1 ring-slate-900/5 shadow-lg space-y-3 bg-yellow-400/80 hover:bg-yellow-400/100 hover:ring-sky-500">
                            Log Out
                        </button>
                    </form>
                </div>
            @endauth --}}

            @guest
                <div class="space-x-6 font-bold">
                    <x-navbar-anchor href="/register">
                        Sign Up
                    </x-navbar-anchor>
                    <x-navbar-anchor href="/login">
                        Log In
                    </x-navbar-anchor>
                </div>
            @endguest
        </nav>

        <div class="px-10">
            <main class="mt-10 mx-auto bg-white rounded-xl px-4 py-4 w-full">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuButton = document.getElementById('menu-button');
        const menuItems = document.getElementById('menu-items');

        // Check if elements exist
        if (menuButton && menuItems) {
            menuButton.addEventListener('click', function() {
                const isExpanded = menuButton.getAttribute('aria-expanded') === 'true';
                menuButton.setAttribute('aria-expanded', !isExpanded);
                menuItems.classList.toggle('hidden');
            });

            // Close the dropdown if clicked outside
            document.addEventListener('click', function(event) {
                if (!menuButton.contains(event.target) && !menuItems.contains(event.target)) {
                    menuItems.classList.add('hidden');
                    menuButton.setAttribute('aria-expanded', 'false');
                }
            });
        } else {
            console.error('Menu button or menu items element not found');
        }
    });
</script>

</html>
