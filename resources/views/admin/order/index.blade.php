@extends('admin.layout')

@section('title') Commandes @endsection

@section('main')
    <section class="padding">
        <h1 class="section-title">Gestion des commandes</h1>

        <div class="my-5 rounded shadow-lg flex flex-col md:flex-row gap-3 px-3">
            <div class="pb-3 @if($state == 'all') border-b-2 border-red-500 @endif">
                <a href="{{ route('admin:order:index', ['state' => 'all']) }}">Toutes les commandes</a>
            </div>
            <div class="pb-3 @if($state == 'saved') border-b-2 border-red-500 @endif">
                <a href="{{ route('admin:order:index', ['state' => 'saved']) }}">Nouvelles commandes</a>
            </div>
            <div class="pb-3 @if($state == 'preparation') border-b-2 border-red-500 @endif">
                <a href="{{ route('admin:order:index', ['state' => 'preparation']) }}">En préparation</a>
            </div>
            <div class="pb-3 @if($state == 'ready') border-b-2 border-red-500 @endif">
                <a href="{{ route('admin:order:index', ['state' => 'ready']) }}">Commande prête</a>
            </div>
            <div class="pb-3 @if($state == 'delivery') border-b-2 border-red-500 @endif">
                <a href="{{ route('admin:order:index', ['state' => 'delivery']) }}">En cours de livraison</a>
            </div>
            <div class="pb-3 @if($state == 'delivered') border-b-2 border-red-500 @endif">
                <a href="{{ route('admin:order:index', ['state' => 'delivered']) }}">Livré</a>
            </div>
        </div>

        <div class="my-5 grid gap-3 grid-cols-1 md:grid-cols-2 text-white">
            <div class="vae rounded shadow-lg p-5 text-center">
                <p class="text-xl font-bold">Ventes à emporter</p>
                <p>{{ $nb_vae }}</p>
            </div>
            <div class="liv rounded shadow-lg p-5 text-center">
                <p class="text-xl font-bold">Livraisons</p>
                <p>{{ $nb_liv }}</p>
            </div>
        </div>

        <div class="mt-10 hidden md:block">
            <div class="grid grid-cols-7 gap-5 px-2 pb-2">
                <span>ID Commande</span>
                <span>Nom client</span>
                <span>Nb. produits</span>
                <span>Type</span>
                <span>Date</span>
                <span>Heure</span>
                <span>Action</span>
            </div>
            <div>
                @forelse($orders as $ord)
                    <div class="grid grid-cols-7 gap-5 px-2 py-3 rounded mb-1 border-t @if($ord->ord_type == 'LSP') liv @endif @if($ord->ord_type == 'VAE') vae @endif"
                    >
                        <span>{{ $ord->ord_id }}</span>
                        <span>{{ $ord->customer->cus_fullname }}</span>
                        <span>{{ $ord->products->count() }}</span>
                        <span>{{ $ord->ord_type }}</span>
                        <span>{{ $ord->ord_date }}</span>
                        <span>{{ $ord->ord_time }}</span>
                        <div class="flex gap-3">
                            @if($ord->ord_status == 'SAVED')
                                <form action="{{ route('admin:order:start_preparation') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="ord_id" value="{{ $ord->ord_id }}" />
                                    <button>Commencer</button>
                                </form>
                            @elseif($ord->ord_status == 'PREPARATION')
                                <form action="{{ route('admin:order:end_preparation') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="ord_id" value="{{ $ord->ord_id }}" />
                                    <button>Terminer</button>
                                </form>
                            @elseif($ord->ord_type == 'LSP' && $ord->ord_status == 'READY')
                                <form action="{{ route('admin:order:start_delivery') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="ord_id" value="{{ $ord->ord_id }}" />
                                    <button>Commencer la livraison</button>
                                </form>
                            @elseif($ord->ord_type == 'LSP' && $ord->ord_status == 'DELIVERY')
                                <form action="{{ route('admin:order:end_delivery') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="ord_id" value="{{ $ord->ord_id }}" />
                                    <button>Terminer la livraison</button>
                                </form>
                            @endif
                                @if($ord->ord_status != 'SAVED')
                                    <form action="{{ route('admin:order:roll_status_back') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="ord_id" value="{{ $ord->ord_id }}" />
                                        <button>Retour</button>
                                    </form>
                                    @endif
                        </div>
                    </div>
                @empty
                <span>Aucune commande</span>
                @endforelse
            </div>
        </div>

        <div class="mt-10 md:hidden">
            <div>
                @forelse($orders as $ord)
                    <div class="grid grid-cols-1 gap-2 px-2 py-3 rounded mb-1 border-t @if($ord->ord_type == 'LSP') liv @endif @if($ord->ord_type == 'VAE') vae @endif"
                    >
                        <span>#ID: {{ $ord->ord_id }}</span>
                        <span>Client: {{ $ord->customer->cus_fullname }}</span>
                        <span>Nb produits: {{ $ord->products->count() }}</span>
                        <span>Type: {{ $ord->ord_type }}</span>
                        <span>Date: {{ $ord->ord_date }}</span>
                        <span>Heure: {{ $ord->ord_time }}</span>
                        <div class="flex flex-col gap-1 border rounded-lg p-3 mt-4">
                            @if($ord->ord_status == 'SAVED')
                                <form action="{{ route('admin:order:start_preparation') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="ord_id" value="{{ $ord->ord_id }}" />
                                    <button>Commencer</button>
                                </form>
                            @elseif($ord->ord_status == 'PREPARATION')
                                <form action="{{ route('admin:order:end_preparation') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="ord_id" value="{{ $ord->ord_id }}" />
                                    <button>Terminer</button>
                                </form>
                            @elseif($ord->ord_type == 'LSP' && $ord->ord_status == 'READY')
                                <form action="{{ route('admin:order:start_delivery') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="ord_id" value="{{ $ord->ord_id }}" />
                                    <button>Commencer la livraison</button>
                                </form>
                            @elseif($ord->ord_type == 'LSP' && $ord->ord_status == 'DELIVERY')
                                <form action="{{ route('admin:order:end_delivery') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="ord_id" value="{{ $ord->ord_id }}" />
                                    <button>Terminer la livraison</button>
                                </form>
                            @endif
                            @if($ord->ord_status != 'SAVED')
                                <form action="{{ route('admin:order:roll_status_back') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="ord_id" value="{{ $ord->ord_id }}" />
                                    <button>Retour</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <span>Aucune commande</span>
                @endforelse
            </div>
        </div>
    </section>
@endsection
