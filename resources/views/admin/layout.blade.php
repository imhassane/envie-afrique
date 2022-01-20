<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') - Envies d'Afrique</title>
@yield('head')

<!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Belleza&family=Jost:wght@200;400&family=Lobster&family=Raleway:wght@100;300&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        * {
            font-family: Railway, Jost, SansSerif;
        }
    </style>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="antialiased" data-barba="wrapper" x-data="{ showNavigation: false }">
<div data-barba="container" data-barba-namespace="main">
    <header class="sticky top-0 bg-white z-50">
        <!-- Mobile navigation -->
        <nav class="padding border-b">
            <ul class="flex justify-center gap-3 pb-2 items-center">
                <li class="flex-1"><a href="/">Espace d'administration</a></li>
            </ul>
        </nav>
    </header>
    <section class="md:flex gap-5">
        <aside class="bg-dark padding rounded-lg text-white text-xl shadow-lg">
            <nav>
                <ul class="flex flex-col gap-3">
                    <li><a href="{{ route('admin:category:index') }}"><i class="fas fa-database mr-1"></i> Catégories</a></li>
                    <li><a href="{{ route('admin:product:index') }}"><i class="fas fa-tags mr-1"></i> Produits</a></li>
                    <li><a href="{{ route('admin:customer:index') }}"><i class="fas fa-users mr-1"></i> Clients</a></li>
                    <li><a href="{{ route('admin:order:index', ['state' => 'saved']) }}"><i class="fas fa-gifts mr-1"></i> Commandes</a></li>
                </ul>
            </nav>
        </aside>
        <main class="min-h-screen flex-1">
            @yield('main')
        </main>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js" integrity="sha512-fzff82+8pzHnwA1mQ0dzz9/E0B+ZRizq08yZfya66INZBz86qKTCt9MLU0NCNIgaMJCgeyhujhasnFUsYMsi0Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @yield('script')
</div>
</body>
</html>
