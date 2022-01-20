@extends('admin.layout')

@section('main')
    <section class="padding pt-0" x-data="{ displayAddForm: false, }">
        <h1 class="pb-2 border-b section-title mb-5">Catégories</h1>

        <div class="mb-3">
            <button @click="displayAddForm = !displayAddForm">
                <span x-show="!displayAddForm">Ajouter une catégorie</span>
                <span x-show="displayAddForm">Masquer l'ajout</span>
            </button>
        </div>

        <div x-show="displayAddForm" class="bg-dark padding rounded-xl shadow-xl text-white">
            <p class="font-semibold text-lg">Nouvelle catégorie</p>

            <form method="post" action="{{ route('admin:category:index') }}" class="mt-3" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" name="category[name]" class="text-black" value="{{ old('category[name]') }}" />
                    </div>
                    <div class="form-group">
                        <label>Image de la catégorie</label>
                        <input type="file" name="category[cover]" class="text-black" value="{{ old('category[cover]') }}" />
                    </div>
                </div>
                <div class="my-3 form-group">
                    <label>Description</label>
                    <textarea class="w-full rounded h-64 text-black padding" name="category[description]">{{ old('category[description]') }}</textarea>
                </div>
                <div>
                    <button type="submit" class="btn">Ajouter</button>
                </div>
            </form>
        </div>

        <div class="mt-5 grid grid-cols-1 md:grid-cols-3">
            @forelse($categories as $cat)
                <div class="p-2 border rounded-lg" x-data="{ showEditForm: false }">
                    <img src="{{ Storage::url($cat->cat_avatar) }}" alt="{{ $cat->cat_name }}" />
                    <p class="text-lg font-semibold">{{ $cat->cat_name }}</p>
                    <p class="text-sm mb-1">{{ $cat->cat_description }}</p>
                    <p class="text-xs mb-3">Actuellement: {{ $cat->cat_visible ? "Visible au public" : "Masqué au public" }}</p>

                    <div class="text-sm mb-3">
                        <button x-show="!showEditForm" class="btn-link" @click="showEditForm = true">Modifier</button>
                        <button x-show="showEditForm" class="btn-link" @click="showEditForm = false">Masquer</button>
                    </div>

                    <form action="{{ route('admin:category:update', $cat->cat_id) }}" x-show="showEditForm" method="post" enctype="multipart/form-data" class="border-t pt-1 flex flex-col gap-3">
                        @csrf
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" name="cat[name]" value="{{ $cat->cat_name }}" />
                        </div>
                        <div class="my-3 form-group">
                            <label>Description</label>
                            <textarea name="cat[description]" class="p-2 h-32 rounded border bg-gray-50">{{ $cat->cat_description }}</textarea>
                        </div>
                        <div class="form-group">
                            <p>Visibilité</p>
                            <p class="text-xs">Actuellement: {{ $cat->cat_visible ? "Visible au public" : "Masqué au public" }}</p>
                            <select name="cat[visible]" class="w-full p-2">
                                <option value="false">Invisible</option>
                                <option value="true">Visible</option>
                            </select>
                        </div>
                        <div>
                            <button class="btn">Enregistrer</button>
                        </div>
                    </form>
                </div>
            @empty
                <div class="bg-primary rounded-xl shadow-xl text-white">
                    Aucune catégorie, veuillez ajouter une
                </div>
            @endforelse
        </div>
    </section>
@endsection
