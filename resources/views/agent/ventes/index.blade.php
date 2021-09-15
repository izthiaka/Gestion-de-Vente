@extends('layouts.agent')

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
                            <li class="breadcrumb-item"><a href="{{route('agent.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Liste de mes Ventes</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Ventes</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row mb-2">
            <div class="col-md-6 row">
                <a href="{{route('agent.vente-create')}}" class="btn btn-primary text-white waves-effect waves-light mb-3 ml-2"><i class="mdi mdi-plus"></i> Vendre</a>
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
                @include('agent.ventes.liste-ventes')
            @endif
        </div>
        <!-- end row -->

        <ul class="pagination pagination-rounded justify-content-end mb-0 mt-2">
            {{ $ventes->links() }}
        </ul>

    </div>
</div>

@foreach ($ventes as $item)


    <!-- Modal modalStatutValid -->
    <div class="modal fade" id="modalStatutValid{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header bg-light">
                    <h5 class="text-uppercase" id="updateModalLongTitle">
                        Validation de l'approvisionnement
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route("agent.approvisionnement-valid", [$item->id]) }}" method="post">
                    @csrf
                    @method('GET')
                    <div class="modal-body" >
                        <p class="text-center" style="font-size:16px">
                            Etes-vous sûr de vouloir approuver cet approvisionnement ?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success mr-1">Valider</button>
                        <button type="close" class="btn btn-info" data-dismiss="modal" >Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal modalStatutRefuse -->
    <div class="modal fade" id="modalStatutRefuse{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header bg-light">
                    <h5 class="text-uppercase" id="updateModalLongTitle">
                        Refus de l'approvisionnement
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route("agent.approvisionnement-refuse", [$item->id]) }}" id="updateUserForm" method="post">
                    @csrf
                    @method('GET')
                    <div class="modal-body" >
                        <p class="text-center" style="font-size:16px">
                            Etes-vous sûr de vouloir refuser cet approvisionnement ?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger mr-1">Refuser</button>
                        <button type="close" class="btn btn-info" data-dismiss="modal" >Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal RetourSave -->
    <div class="modal fade" id="RetourSave{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="text-uppercase" id="updateModalLongTitle">Retour de l'approvisionnement ({{$item->article->nom_article}})</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('agent.approvisionnement-RetourSave', [$item->id])}}" method="post">
                    @csrf
                    @method('GET')
                    <div class="modal-body" >
                        <div class="form-group">
                            <label>Quantite de départ</label>
                            <input type="number" class="form-control" name="quantite_approv_depart" value="{{$item->quantite_approv_depart}}" readonly>
                            @error('quantite_approv_depart')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Quantite de retour</label>
                            <input type="number" class="form-control" name="quantite_approv_retour" max="{{$item->quantite_approv_depart}}">
                            @error('quantite_approv_retour')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success mr-1">Enregister</button>
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
            url : "{{URL::to( route('agent.vente-search') )}}",
            data: {'recherche' : $value},
            success:function(data){
                $('#venteList').html('');
                $('#venteList').html(data);
            }
        });
    });
</script>
@endsection
