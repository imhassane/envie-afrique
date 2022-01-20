@extends('layout')

@section('title') Suivi de commande @endsection

@section('main')
    <section class="padding">
        <h1 class="section-title">Suivi de commandes</h1>

        <div class="my-5 rounded border p-5 grid grid-cols-2 md:grid-cols-5 gap-5">
            <div>
                <p class="font-semibold text-lg">ID commande</p>
                <p>#{{ $order->ord_id }}</p>
            </div>
            <div>
                <p class="font-semibold text-lg">Date</p>
                <p>{{ $order->ord_date }}</p>
            </div>
            <div>
                <p class="font-semibold text-lg">Heure</p>
                <p>{{ $order->ord_time }}</p>
            </div>
            <div>
                <p class="font-semibold text-lg">Prix</p>
                <p>{{ $order->ord_price }}€</p>
            </div>
            <div>
                <p class="font-semibold text-lg">Paiement</p>
                <p>{{ $order->ord_paid ? 'Payée' : 'Non payée' }}</p>
            </div>
        </div>

        <div class="mt-10">
            <div class="p-5 border rounded bg-gray-50">
                <p class="text-lg font-semibold">Commande</p>
                <p class="help">{{ $order->products->count() }} produits</p>
                <div class="mt-3 py-3 grid grid-cols-1 gap-3 text-sm">
                    <div class="flex gap-2 pb-2 border-b">
                        <span class="w-72">Produit</span>
                        <span class="w-16">Quantité</span>
                    </div>
                    @foreach($order->products as $p)
                        <div class="flex gap-2">
                            <p class="w-72">{{ $p->product->pro_name }}</p>
                            <p class="w-16">{{ $p->opr_quantity }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mt-10">
            <p class="font-semibold pb-2 border-b mb-4">Historique de la commande</p>
            <div class="grid grid-cols-1 gap-4">
                @if(!is_null($order->ord_preparation_date))
                    <div class="border rounded p-3 bg-gray-50">
                        <p>Début de préparation de la commande</p>
                        <p class="text-sm text-gray-700 mt-1 ml-5">{{ $order->ord_preparation_date }}</p>
                    </div>
                @endif

                @if(!is_null($order->ord_ready_date))
                    <div class="border rounded p-3 bg-gray-50">
                        <p>Fin de préparation de la commande</p>
                        <p class="text-sm text-gray-700 mt-1 ml-5">{{ $order->ord_ready_date }}</p>
                    </div>
                @endif

                @if(!is_null($order->ord_delivery_date))
                    <div class="border rounded p-3 bg-gray-50">
                        <p>Début de livraison</p>
                        <p class="text-sm text-gray-700 mt-1 ml-5">{{ $order->ord_delivery_date }}</p>
                    </div>
                @endif

                @if(!is_null($order->ord_done_date))
                    <div class="border rounded p-3 bg-gray-50">
                        <p>Livraison terminée</p>
                        <p class="text-sm text-gray-700 mt-1 ml-5">{{ $order->ord_done_date }}</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
