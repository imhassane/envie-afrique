@extends('layout')

@section('title') Panier @endsection

@section('main')
    <section>
        <h1 class="section-title pb-3 border-b">Panier</h1>

        <div class="grid grid-cols-1 gap-3 mt-4">
            @forelse($items as $item)
                <div class="p-2  border-b flex items-center gap-3">
                    <img src="{{ $item["cover"] }}" alt="{{  $item["name"] }}" width="50" height="50" />
                    <p class="flex-1">{{ $item["name"] }}</p>
                    <p class="w-20">{{ $item["price"] * $item["quantity"] }} €</p>
                    <div class="flex items-center gap-2">
                        <form action="{{ route('cart-reduce', $item["id"]) }}" method="post">
                            @csrf
                            <button type="submit">-</button>
                        </form>
                        <input type="text" value="{{ $item['quantity'] }}" class="w-16 text-center" />
                        <form action="{{ route('cart-add', $item["id"]) }}" method="post">
                            @csrf
                            <button type="submit">+</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="bg-primary text-white padding rounded shadow-lg">
                    <p>Aucun article n'est présent dans votre panier, veuillez choisir un sur le menu</p>
                </div>
            @endforelse
        </div>

        @if($total_price > 0)
            <div class="mt-5">
                <p><span class="mr-2">Total</span> {{ $total_price }}€</p>
                <div class="mt-3 py-4">
                    <a href="{{ route('order') }}" class="btn">Valider le panier & enregistrer la commande</a>
                </div>
            </div>
        @endif
    </section>
@endsection
