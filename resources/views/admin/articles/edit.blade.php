@extends('layouts.admin')
@section('content')
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.article-list')}}">Articles</a></li>
                            <li class="breadcrumb-item active">{{$article->nom_article}}</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Modifier article</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('admin.article-update', [$article->id])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-6">
                                    <!-- Date View -->
                                    <div class="form-group">
                                        <label>Nom article</label>
                                        <input type="text" value="{{$article->nom_article}}" class="form-control @error('nom_article') is-invalid @enderror" name="nom_article" data-toggle="flatpicker" placeholder="Nom article" required>
                                        @error('nom_article')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <!-- Date View -->
                                    <div class="form-group">
                                        <label>Prix</label>
                                        <input type="number" value="{{$article->prix_article}}" name="prix_article" class="form-control @error('prix_article') is-invalid @enderror" data-toggle="flatpicker" placeholder="Prix article" required>
                                        @error('prix_article')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row">
                                <div class="col-lg-6">
                                    <!-- Date View -->
                                    <div class="form-group">
                                        <label>Quantite</label>
                                        <input type="number" value="{{$article->quantite_article}}" class="form-control @error('quantite_article') is-invalid @enderror" name="quantite_article" data-toggle="flatpicker" placeholder="Quantite article" required>
                                        @error('quantite_article')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <!-- Date View -->
                                    <div class="form-group">
                                        <label>Categorie Article</label>
                                        <select name="categorie_id" id="categorie_id" class="form-control @error('categorie_id') is-invalid @enderror">
                                            @foreach ($categories as $item)
                                                <option value="{{$item->id}}" @if ($item->id == $article->categorie_id) selected @endif>{{$item->nom_categorie}}</option>
                                            @endforeach
                                        </select>
                                        @error('categorie_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row">
                                <div class="col-6">
                                    <!-- Date View -->
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description_article" id="description_article" class="form-control @error('description_article') is-invalid @enderror">{{$article->description_article}}</textarea>
                                        @error('description_article')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <!-- Date View -->
                                    <div class="form-group">
                                        <label>Photo Article</label>
                                        <input type="file" class="form-control @error('photo_article') is-invalid @enderror" name="photo_article" data-toggle="flatpicker">
                                        @error('photo_article')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row mt-3">
                                <div class="col-12 text-center">

                                    <button type="submit" class="btn btn-success waves-effect waves-light m-1">
                                        <i class="fe-check-circle mr-1"></i>
                                        Modifier
                                    </button>

                                    <a href="{{ route('admin.article-list') }}" class="btn btn-light waves-effect waves-light m-1">
                                        <i class="fe-x mr-1"></i>
                                        Annuler
                                    </a>

                                </div>
                            </div>

                        </form>

                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card-->
            </div>
            <!-- end col-->
        </div>
        <!-- end row-->

    </div>
</div>

@endsection
