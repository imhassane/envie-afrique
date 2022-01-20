@extends('layout')

@section('title') {{ $pro->pro_name }} @endsection

@section('main')
    <section class="padding">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-10">
            <img src="{{ asset($pro->pro_cover) }}" width="500px" height="500px" class="rounded-xl" alt="{{ $pro->pro_name }}" />
            <div>
                <h1 class="text-2xl font-bold section-title">{{ $pro->pro_name }}</h1>
                <div class="text-lg mt-2 mb-4">{{ $pro->pro_description }}</div>
                <p class="font-bold text-xl">{{ $pro->pro_price }}€</p>

                <form action="{{ route('cart') }}" method="post" class="flex my-3">
                    @csrf
                    <input type="hidden" value="{{ $pro->pro_id }}" name="item[id]" />
                    <input type="hidden" value="{{ $pro->pro_name }}" name="item[name]" />
                    <input type="hidden" value="{{ $pro->pro_price }}" name="item[price]" />
                    <input type="hidden" value="{{ $pro->pro_cover }}" name="item[cover]" />
                    <button type="submit" class="btn">Ajouter au panier</button>
                </form>
            </div>
        </div>
        @if(!is_null($pro->pro_article))
            <div class="mt-10 p-6 rounded-lg bg-gray-50">
                <h2 class="font-bold pb-2 border-b mb-5">Description</h2>
                {!! $pro->pro_article !!}
            </div>
        @endif
    </section>
@endsection
