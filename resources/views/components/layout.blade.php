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

<body class="bg-black text-white font-hanken-grotesk pb-20">

    <div class="px-10">
        <nav class="flex justify-between items-center py-4 border-b border-white/10 h-20">
            <div>
                <a href="/">
                    <img src="{{ Vite::asset('resources/images/logoipsum-325.svg') }}" alt="" />
                </a>
            </div>

            <div class="space-x-6 font-bold">
                <x-navbar-anchor href="/tickets">
                    My Tickets
                </x-navbar-anchor>
                <x-navbar-anchor href="/departments">
                    Departments
                </x-navbar-anchor>
                <x-navbar-anchor href="/tickets/create">
                    Post a Ticket
                </x-navbar-anchor>
            </div>

            @auth
                <div class="font-bold space-x-6">
                    <form method="POST" action="/logout" class="max-h-12.4">
                        @csrf
                        @method('DELETE')

                        <button
                            class="group h-12.4 px-6 inline-block align-top max-w-xs mx-auto rounded-xl ring-1 ring-slate-900/5 shadow-lg space-y-3 hover:bg-white/10 hover:ring-sky-500">
                            Log Out
                        </button>
                    </form>
                </div>
            @endauth

            @guest
                <div class="space-x-6 font-bold">
                    <x-navbar-anchor href="/register">
                        Sign up
                    </x-navbar-anchor>
                    <x-navbar-anchor href="/login">
                        Log in
                    </x-navbar-anchor>
                </div>
            @endguest
        </nav>

        <main class="mt-10 max-w-[986px] mx-auto">
            {{ $slot }}
        </main>
    </div>
</body>

</html>
