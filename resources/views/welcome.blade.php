@extends('layout')

@section('title') Bienvenue @endsection

@section('main')

    <section id="banner" class="grid grid-cols-1 md:grid-cols-2 place-items-center gap-5">
        <div class="order-2 md:order-1">
            <h1 class="text-primary title mb-7" style="font-family: Lobster">Découvrez & déguster le meilleur de la nourriture ouest africaine</h1>

            <p class="mb-4 leading-tight">Réservez votre plat sur notre site web et nous vous promettons un service de qualité</p>
            <p class="mb-10">Nous n'acceptons les commandes que le weekend de 12h à 17h</p>

            <div class="flex flex-col gap-8">
                <p><a href="/#menu" class="btn shadow-xl"><i class="fas fa-eye mr-1"></i>Voir notre menu</a></p>
                <p><a href="/" class="btn-link">Regardez nous préparer vos plats</a></p>
            </div>
        </div>
        <div class="order-1 md:order-2">
            <img src="{{ asset('img/banner.webp') }}" class="shadow-xl object-center object-cover rounded-xl" width="100%" height="200" alt="Bannière" />
        </div>
    </section>

    @if($suggestion)
        <section class="bg-secondary text-dark">
            <p class="section-title mb-4">Suggestion du chef</p>
            <p class="mb-5 leading-tight">Le plat du jour suggéré par le chef en personne</p>

            <div class="flex flex-col md:flex-row gap-3 md:gap-8">
                <div class="md:w-1/3">
                    <img src="{{ asset($suggestion->pro_cover) }}" alt="{{ $suggestion->pro_name }}" class="object-cover object-center rounded-lg" />
                </div>
                <div class="flex-1">
                    <p class="text-3xl font-bold">{{ $suggestion->pro_name }} - <span class="text-sm">{{ $suggestion->pro_country }}</span></p>
                    <p>{{ $suggestion->pro_price }}€</p>
                    <p class="text-sm mt-2 mb-3">{{ $suggestion->pro_description }}</p>
                    <form action="{{ route('cart') }}" method="post" class="flex my-3">
                        @csrf
                        <input type="hidden" value="{{ $suggestion->pro_id }}" name="item[id]" />
                        <input type="hidden" value="{{ $suggestion->pro_name }}" name="item[name]" />
                        <input type="hidden" value="{{ $suggestion->pro_price }}" name="item[price]" />
                        <input type="hidden" value="{{ $suggestion->pro_cover }}" name="item[cover]" />
                        <button type="submit" class="btn bg-dark">Ajouter au panier</button>
                    </form>
                </div>
            </div>
        </section>
    @endif

    <section id="menu">
        <p class="section-title mb-4">Notre menu</p>
        <p class="mb-2 leading-tight">Commandez sur notre plateforme est très simple et rapide</p>
        <p class="text-primary font-light mb-5">Nous facturons 3€ de plus sur les livraisons</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
            @forelse($meals as $meal)
                <div class="shadow-xl rounded-b-lg">
                    <div class="flex justify-center relative">
                        <a href="{{ route('product', ['productId' => $meal->pro_id]) }}" class="w-full h-72">
                            <img loading="lazy" src="{{ asset($meal->pro_cover) }}" class="rounded-t-lg object-cover object-center w-full h-72" alt="{{ $meal->pro_name }}" />
                        </a>
                    </div>
                    <p class="text-center text-xl mt-3">{{ $meal->pro_name }} - <span class="text-xs">{{ $meal->pro_country }}</span></p>
                    <p class="mt-1 mb-2 text-center">{{ $meal->pro_price }}€</p>
                    <p class="font-light text-center text-sm mt-2">{{ $meal->pro_description }}</p>

                    <form action="{{ route('cart') }}" method="post" class="flex justify-center my-3">
                        @csrf
                        <input type="hidden" value="{{ $meal->pro_id }}" name="item[id]" />
                        <input type="hidden" value="{{ $meal->pro_name }}" name="item[name]" />
                        <input type="hidden" value="{{ $meal->pro_price }}" name="item[price]" />
                        <input type="hidden" value="{{ $meal->pro_cover }}" name="item[cover]" />
                        <button type="submit" class="btn">Ajouter au panier</button>
                    </form>
                </div>
                @empty
                <div class="bg-primary text-white padding rounded shadow-lg">
                    <p>Aucun plat encore publié, nous le ferons bientôt</p>
                </div>
            @endforelse
        </div>
    </section>

    <section class="grid grid-cols-1 md:grid-cols-4">
        @forelse($feed as $i)
            <img loading="lazy" class="w-full h-72 object-center object-cover" src="{{ $i }}" width="500" heigth="500" alt="">
        @empty
        @endforelse
    </section>

@endsection
