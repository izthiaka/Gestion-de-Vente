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
                            <li class="breadcrumb-item active">Liste des Categories</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Categories</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row mb-2">
            <div class="col-md-6 row">
                <a href="javascript: void(0);" data-toggle="modal" data-target="#modalCreateCategory" class="btn btn-primary text-white waves-effect waves-light mb-3 ml-2"><i class="mdi mdi-plus"></i> Ajouter une categorie</a>
            </div>
            <div class="col-md-6">
                <form action="javascript: void(0);" method="get">
                    <div class="input-group">
                        <input type="text" id="recherche" name="recherche" class="form-control" placeholder="Rechercher une categorie">
                        <span class="input-group-append">
                            <button type="submit" class="btn waves-effect waves-light btn-primary">Recherche</button>
                        </span>
                    </div>
                </form>
            </div>
            <!-- end col-->
        </div>
        <!-- end row-->

        <div class="row" id="categoryList">
            @if (!empty($categories))
                @include('admin.categories.liste-categories')
            @endif
        </div>
        <!-- end row -->

        <ul class="pagination pagination-rounded justify-content-end mb-0 mt-2">
            {{ $categories->links() }}
        </ul>

    </div> <!-- end container-fluid -->

</div> <!-- end content -->
<!-- content -->

@foreach ($categories as $item)

<!-- Modal Update Category -->
<div class="modal fade" id="modalEditCategory{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="text-uppercase" id="updateModalLongTitle">Modifier la categorie ({{$item->nom_categorie}})</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.categorie-update', [$item->id])}}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body" >
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" value="{{$item->nom_categorie}}" class="form-control @error('nom_categorie') is-invalid @enderror" name="nom_categorie" data-toggle="flatpicker" placeholder="Nom categorie" required>
                        @error('nom_categorie')
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

<!-- Modal Delete Category -->
<div class="modal fade" id="modalDeleteCategory{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header bg-light">
                <h5 class="text-uppercase" id="updateModalLongTitle">
                    Suppression catégorie
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route("admin.categorie-destroy", [$item->id]) }}" id="updateUserForm" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-body" >
                    <p class="text-center" style="font-size:16px">
                        Etes-vous sûr de vouloir supprimer cette categorie ?
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

<!-- Modal Create Category -->
<div class="modal fade" id="modalCreateCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="text-uppercase" id="updateModalLongTitle">Nouvelle categorie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.categorie-store')}}" method="post">
                @csrf
                <div class="modal-body" >
                    <div class="form-group">
                        <label>Nom</label>
                        <input type="text" class="form-control @error('nom_categorie') is-invalid @enderror" name="nom_categorie" data-toggle="flatpicker" placeholder="Nom categorie" required>
                        @error('nom_categorie')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success mr-1">Ajouter</button>
                    <button type="close" class="btn btn-secondary" data-dismiss="modal" >Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                2016 - 2020 &copy; Codefox theme by <a href="#">Coderthemes</a>
            </div>
            <div class="col-md-6">
                <div class="text-md-right footer-links d-none d-sm-block">
                    <a href="#">About Us</a>
                    <a href="#">Help</a>
                    <a href="#">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end Footer -->

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
            url : "{{URL::to( route('admin.categorie-search') )}}",
            data: {'recherche' : $value},
            success:function(data){
                $('#categoryList').html('');
                $('#categoryList').html(data);
            }
        });
    });
</script>
@endsection
