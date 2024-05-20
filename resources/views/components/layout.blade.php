<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticketing app</title>
    @vite(['resources/js/app.js','resources/css/app.css'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body class="bg-black text-white font-hanken-grotesk pb-20">
    
    <div class="px-10">
        <nav class="flex justify-between items-center py-4 border-b border-white/10">
            <div>
                <a href="/">
                    <img src="{{ Vite::asset('resources/images/logoipsum-325.svg') }}" alt=""/>
                </a>
            </div>

            <div class="space-x-6 font-bold">
                <a href="/tickets">My tickets</a>
                <a href="/departments">Departments</a>
            </div>

            @auth
                <div class="font-bold space-x-6 flex">
                    <a href="/tickets/create">Post a Ticket</a>

                    <form method="POST" action="/logout">
                        @csrf
                        @method('DELETE')

                        <button>Log Out</button>
                    </form>
                </div>
            @endauth
            
            @guest
            <div class="space-x-6 font-bold">
                <a href="/register">Sign up</a>
                <a href="/login">Log in</a>
            </div>
            @endguest
        </nav>

        <main class="mt-10 max-w-[986px] mx-auto">
            {{ $slot }}
        </main>
    </div>
</body>
</html>