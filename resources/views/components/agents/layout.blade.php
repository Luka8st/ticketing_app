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

<body class="font-hanken-grotesk pb-20 bg-gray-200 absolute w-full">
    <div class="">
        <nav
            class="fixed z-10 w-full text-white flex justify-between items-center px-6 py-4 mx-auto border-b border-white/10 h-16 bg-red-800">
            <div class="">
                <a href="/">
                    <img src="{{ Vite::asset('resources/images/logoipsum-325.svg') }}" alt="" />
                </a>
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
                                <i>{{ Auth::user()->name }}</i>
                            </div>
                            <hr>
                            <form method="POST" action="/logout" class="max-h-12.4">
                                @csrf
                                @method('DELETE')

                                <button class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-200/60">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth

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
            <x-agents.sidebar/> 
            <main class="mt-20 mx-auto bg-white rounded-xl px-4 py-4 w-4/5 absolute right-6">
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
