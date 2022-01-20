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
                <nav class="md:hidden padding border-b">
                    <ul class="flex gap-3 pb-2 items-center">
                        <li class="flex-1"><a href="/"><img src="{{ asset('img/logo.webp') }}" alt="Logo Envie d'Afrique"></a></li>
                        <li><a href="{{ route('cart') }}"><i class="fas fa-shopping-bag mr-1"></i> Panier</a></li>
                        <li><i class="fas fa-bars cursor-pointer" @click="showNavigation = !showNavigation"></i></li>
                    </ul>
                    <nav x-show="showNavigation" class="border-t padding">
                        <ul class="flex flex-col gap-2">
                            <li class="border-b pb-2"><a href="/">&Agrave; propos</a></li>
                        </ul>
                    </nav>
                </nav>
                <nav class="hidden md:block padding border-b">
                    <ul class="flex gap-3 items-center">
                        <li class="flex-1"><a href="/"><img height="110" width="110" src="{{ asset('img/logo.webp') }}" alt="Logo Envie d'Afrique"></a></li>
                        <li><a href="{{ route('cart') }}"><i class="fas fa-shopping-bag mr-1"></i> Panier</a></li>
                        <li><a href="/">&Agrave; propos</a></li>
                        <li><a href="" class="btn"><i class="fas fa-phone mr-1"></i> +33 6 16 552 934</a></li>
                    </ul>
                </nav>
            </header>
            <main class="min-h-screen">
                @yield('main')
            </main>

            <footer class="bg-primary padding grid grid-cols-1">
                <div class="flex items-center justify-between gap-3">
                    <p class="text-white text-xl font-bold">
                        © 2022 Envie d’Afrique
                    </p>
                    <p class="text-white text-sm">Site créé par <a href="https://linkedin.com/in/imhassane">Hassane SOW</a></p>
                </div>
            </footer>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.8.0/gsap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js" integrity="sha512-fzff82+8pzHnwA1mQ0dzz9/E0B+ZRizq08yZfya66INZBz86qKTCt9MLU0NCNIgaMJCgeyhujhasnFUsYMsi0Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script src="{{ asset('js/app.js') }}"></script>
            <script>
                function slideContainer(container, elements, prev, next) {
                    if(!window[container]) window[container] = 0;

                    const update = direction => {
                        let index = window[container];

                        if(index <= 0) index = elements.length -1;
                        else if(index >= elements.length-1) index = 0;
                        else index += direction;

                        window[container] = index;

                        elements.forEach((elt, idx) => {
                            if(idx !== index)
                                elt.style.display = "none";
                            else
                                elt.style.display = "block";
                        });
                    };

                    prev.addEventListener('click', () => update(-1));
                    next.addEventListener('click', () => update(1));
                }
            </script>
            @yield('script')
        </div>
    </body>
</html>
