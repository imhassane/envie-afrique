@extends('layout')

@section('title') Commande @endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('js/calendar/flatpickr.min.css') }}">
@endsection

@section('main')
    <section>
        <h1 class="section-title pb-4 border-b mb-5">Confirmation de votre commande</h1>

        <p>La dernière étape du passage de votre commande, assurez vous d'entrer les bonnes informations.</p>

        <form action="{{ route('order') }}" method="post" class="flex flex-col gap-3 mt-4">
            @csrf

            <div class="shadow-xl bg-dark text-white padding rounded-xl">
                <p class="font-bold">Mode de reception</p>
                <p class="text-sm mt-1 mb-2">Si vous choisissez la livraison aujourd'hui, vous pourrez changer le mode de reception jusqu'au jour de la commande</p>
                <select name="type" onchange="onMethodSelection(this)" class="bg-primary py-2 px-3 rounded">
                    <option value="VAE">Je viens chercher</option>
                    <option value="LSP">Je souhaite être livré</option>
                </select>
            </div>

            @if($errors->any())
                <div class="py-2 px-4 text-white bg-red-50 shadow-lg">
                    <p class="error">Veuillez remplir correctement les informations demandées</p>

                    <ul class="my-2 mx-3" style="list-style-type: disc;">
                        @foreach($errors->all() as $err)
                            <li class="error">{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-5">
                <div class="form-group">
                    <label for="fullname">Nom complet</label>
                    <input type="text" name="fullname" value="{{ old('fullname') }}" />
                    @error('fullname')
                    <p class="help error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Numéro de téléphone</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}" />
                    @error('phone')
                    <p class="help error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="address">Votre adresse</label>
                <input type="text" name="address" value="{{ old('address') }}" />
                <p class="help">Veuillez laisser ce champ vide si ce n'est pas une livraison       </p>
                @error('address')
                <p class="help error">{{ $message }}</p>
                @enderror
            </div>
            <div class="grid grid-cols-2 gap-2 hidden">
                <div class="form-group">
                    <label for="postal_code">Code postal</label>
                    <input type="text" disabled name="postal_code" value="29200" />
                    @error('postal_code')
                    <p class="help error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="postal_code">Ville de résidence</label>
                    <input type="text" disabled name="city" value="Brest" />
                    @error('city')
                    <p class="help error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="bg-secondary p-4 rounded-lg">
                <p class="text-lg font-semibold">Date souhaitée</p>
                <p class="mb-2 mt-1 text-xs">Les commandes ne peuvent être passées que le weekend</p>
                <div class="grid grid-cols-2 gap-2">
                    <div class="form-group">
                        <label for="">Date de reception</label>
                        <input type="text" placeholder="DD / MM / YYYY" id="flatpickr" name="date" value="{{ old('date') }}" />
                        @error('date')
                        <p class="help error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Heure voulue</label>
                        <input type="time" name="time" min="12:00" max="17:00" value="{{ old('time') }}" />
                        @error('time')
                        <p class="help error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <p>
                <label for=""><input type="checkbox" name="confirm_city" checked="{{ old('confirm_city') }}" class="mr-1" /> Je confirme que j'habite à Brest, France</label>
                @error('confirm_city')
                <p class="help error">{{ $message }}</p>
                @enderror
            </p>
            <p>
                <label for=""><input type="checkbox" name="confirm_info" checked="{{ old('confirm_info') }}" class="mr-1"> Je confirme que les informations sont correctes</label>
                @error('confirm_info')
                <p class="help error">{{ $message }}</p>
                @enderror
            </p>

            <div>
                <p class="text-sm">Nous ne partageons pas vos données, nous prenons le moins d'informations possibles afin de ne pas exposer vos données personnelles</p>
            </div>

            <div>
                <p><span class="mr-2">Total commande</span> {{ $total_price }}€</p>
                <p id="delivery-fees" class="hidden"><span class="mr-2">Frais de livraison</span> {{ $delivery_fees }}€</p>
                <button type="submit" class="btn mt-3">Enregistrer ma commande</button>
            </div>

        </form>
    </section>
@endsection


@section('script')
    <script src="{{ asset('js/calendar/flatpickr.js') }}"></script>
    <script>
        const deliveryFees = document.querySelector("#delivery-fees");
        flatpickr("#flatpickr", {
            "disable": [
                function(date) {
                    return ![0, 6].includes(date.getDay());

                }
            ],
            "locale": {
                "firstDayOfWeek": 1 // start week on Monday
            }
        });

        function onMethodSelection({ value }) {
            if(value !== "VAE")
                deliveryFees.classList.remove("hidden");
            else
                if(!deliveryFees.classList.contains("hidden"))
                    deliveryFees.classList.add("hidden");
        }
    </script>
@endsection
