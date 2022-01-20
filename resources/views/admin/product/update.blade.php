@extends('admin.layout')

@section('title') Nouveau produit @endsection

@section('main')
    <section class="padding">
        <h1 class="section-title pb-2 border-b">Edition d'un produit</h1>

        <form method="post" class="mt-4 flex flex-col gap-3" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="p[name]" value="{{ $p->pro_name }}" />
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                <div class="form-group">
                    <label>Prix</label>
                    <input type="number" step="0.1" name="p[price]" value="{{ $p->pro_price }}" />
                </div>
                <div class="form-group">
                    <label>Pays d'origine</label>
                    <input type="text" name="p[country]" value="{{ $p->pro_country }}" />
                </div>
                <div class="form-group">
                    <label>Statut</label>
                    <select name="p[status]">
                        <option selected="{{ $p->pro_status === 'INACTIVE' ? 'selected' : '' }}" value="INACTIVE">Désactiver</option>
                        <option selected="{{ $p->pro_status === 'ACTIVE' ? 'selected' : '' }}" value="ACTIVE">Activer</option>
                        <option selected="{{ $p->pro_status === 'OUT_OF_STOCK' ? 'selected' : '' }}" value="OUT_OF_STOCK">En rupture de stock</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="p[cover]" value="{{ old('p[cover]') }}" />
                </div>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="p[description]" class="">{{ $p->pro_description }}</textarea>
            </div>
            <div class="form-group">
                <label>Article</label>
                <textarea name="p[article]" id="editor">{{ $p->pro_article }}</textarea>
            </div>
            <div>
                <button type="submit" class="btn">Enregistrer le produit</button>
            </div>
        </form>
    </section>
@endsection

@section('script')
    <script src="{{ asset('js/ckeditor.js') }}"></script>
    <script>
        window.onload = async () => {
            const editor = document.querySelector("#editor");

            await ClassicEditor.create(editor);
        }
    </script>
@endsection
