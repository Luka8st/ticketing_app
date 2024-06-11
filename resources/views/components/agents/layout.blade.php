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
        <nav class="text-white flex justify-between items-center px-10 py-4 mx-auto border-b border-white/10 h-20 bg-red-800">
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
            <main class="mt-10 mx-auto bg-white rounded-xl px-4 py-4 w-full">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
