@extends('admin.layout')

@section('title') Gestion des utilisateurs @endsection

@section('main')
    <section class="padding">
        <h1 class="section-title">Gestion des clients</h1>

        <div class="my-5 rounded shadow-lg p-3 flex gap-3">
            <div>
                <p>Trier</p>
            </div>
            <div>
                <a href="{{ route('admin:customer:index', ['mode' => 'all']) }}">Tous les clients</a>
            </div>
            <div>
                <a href="{{ route('admin:customer:index', ['mode' => 'most_expenses']) }}">Par dépenses</a>
            </div>
            <div>
                <a href="{{ route('admin:customer:index', ['mode' => 'most_orders']) }}">Par nombre de commandes</a>
            </div>
        </div>

        <div class="mt-10 rounded shadow-lg">
            <div class="p-4">
                <div class="flex gap-4 pb-2 text-left">
                    <span class="w-72">Nom complet</span>
                    <span class="flex-1">Adresse</span>
                    <span class="w-48">Numéro de téléphone</span>
                    <span class="w-32">Nombre de commandes</span>
                    <span class="w-32">Montant total de dépenses</span>
                </div>
                @forelse($customers as $cus)
                    <div class="flex gap-4 py-3 border-t text-sm">
                        <span class="w-72">{{ $cus->cus_fullname }}</span>
                        <span class="flex-1">{{ $cus->cus_address }}</span>
                        <span class="w-48">{{ $cus->cus_phone }}</span>
                        <span class="w-32">{{ $cus->cus_nb_orders }}</span>
                        <span class="w-32">{{ $cus->cus_total_spendings }} €</span>
                    </div>
                    @empty
                        <div>
                            Aucun client pour le moment
                        </div>
                @endforelse
                <div class="mt-3">
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
