@extends('admin.layout')

@section('title') Gestion des produits @endsection

@section('main')
    <section class="padding">
        <h1 class="section-title">Gestion des produits</h1>

        <div class="mt-3 mb-4 border-b pb-2">
            <a href="{{ route('admin:product:new') }}" class="btn-link">Nouveau produit</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
            @forelse($products as $p)
                <div class="bg-gray-50 p-2 rounded">
                    <p class="font-semibold">{{ $p->pro_name }}</p>
                    <p class="text-sm my-1">{{ $p->pro_description }}</p>
                    <p class="text-sm">{{ $p->pro_price }}€ - {{ $p->getStatus() }}</p>

                    <div class="mt-1 flex gap-2 text-sm">
                        <a href="{{ route('admin:product:update', $p->pro_id) }}">Modifier</a>
                        @if($p->pro_status == 'ACTIVE')
                            <form method="post" action="{{ route('admin:product:suggest', $p->pro_id) }}">
                                @method('PUT')
                                @csrf
                                <button type="submit">Suggérer</button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-primary rounded-xl shadow-xl text-white">
                    Aucun produit, veuillez ajouter un
                </div>
            @endforelse
        </div>
    </section>
@endsection
