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
                            <li class="breadcrumb-item active">Liste des Ventes</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Ventes</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row mb-2">
            <div class="col-md-6 row">
            </div>
            <div class="col-md-6">
                <form action="javascript: void(0);" method="get">
                    <div class="input-group">
                        <input type="text" id="recherche" name="recherche" class="form-control" placeholder="Rechercher une vente">
                        <span class="input-group-append">
                            <button type="submit" class="btn waves-effect waves-light btn-primary">Recherche</button>
                        </span>
                    </div>
                </form>
            </div>
            <!-- end col-->
        </div>
        <!-- end row-->

        <div class="row" id="venteList">
            @if (!empty($ventes))
                @include('admin.ventes.liste-ventes')
            @endif
        </div>
        <!-- end row -->

        <ul class="pagination pagination-rounded justify-content-end mb-0 mt-2">
            {{ $ventes->links() }}
        </ul>

    </div>
</div>

@foreach ($ventes as $item)
    <!-- Modal Update Category -->
    <div class="modal fade" id="modalEditArticle{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="text-uppercase" id="updateModalLongTitle">Modifier la vente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.vente-update', [$item->id])}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body" >
                        <div class="form-group">
                            <label>Article</label>
                            <select class="col-md-12 selectpicker article_id" data-style="btn-light btn-rounded" id="article_id" name="article_id" data-live-search="true" title="Choisissez l'article">
                                <option disabled selected>Choisissez l'article</option>
                                @foreach ($articles as $article)
                                    <option @if ($item->article_id == $article->article_id) selected @endif value="{{$article->id}}">{{$article->article->nom_article}} ({{$article->article->quantite_article}})</option>
                                @endforeach
                            </select>
                            @error('article_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Quantite Article</label>
                            <input type="text" class="form-control" name="quantite_article" value={{$item->quantite_article}}>
                            @error('quantite_article')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success mr-1">Modifier</button>
                        <button type="close" class="btn btn-secondary" data-dismiss="modal" >Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete Approv -->
    <div class="modal fade" id="modalDeleteApprov{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header bg-light">
                    <h5 class="text-uppercase" id="updateModalLongTitle">
                        Suppression De la vente
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route("admin.vente-delete", [$item->id]) }}" id="updateUserForm" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body" >
                        <p class="text-center" style="font-size:16px">
                            Etes-vous sûr de vouloir supprimer cette vente ?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger mr-1">Supprimer</button>
                        <button type="close" class="btn btn-secondary" data-dismiss="modal" >Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

@endsection

@section('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
    });

    $('#recherche').on('keyup',function(){
        $value=$(this).val();

        $.ajax({
            type : 'get',
            url : "{{URL::to( route('admin.vente-search') )}}",
            data: {'recherche' : $value},
            success:function(data){
                $('#venteList').html('');
                $('#venteList').html(data);
            }
        });
    });
</script>
@endsection
