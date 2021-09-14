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
                            <li class="breadcrumb-item active">Liste de mes Client</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Client</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row mb-2">
            <div class="col-md-6 row">
                <a href="javascript: void(0);" data-toggle="modal" data-target="#modalNewCustomer" class="btn btn-primary text-white waves-effect waves-light mb-3 ml-2"><i class="mdi mdi-plus"></i> Ajouter un client</a>
            </div>
            <div class="col-md-6">
            </div>
            <!-- end col-->
        </div>
        <!-- end row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-center">Prenom Nom</th>
                                        <th class="text-center">Adresse</th>
                                        <th class="text-center">Numero Téléphone</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $key => $item)
                                        <tr>
                                            <th scope="row">{{$key+1}}</th>
                                            <td class="text-center">{{$item->prenom_nom}}</td>
                                            <td class="text-center">{{$item->adresse}}</td>
                                            <td class="text-center">
                                                {{$item->telephone}}
                                                <a href="https://wa.me/{{$item->telephone}}?text=Bonjour%20{{$item->prenom_nom}}," target="_blank" class="btn btn-xs btn-success">
                                                    <i class="mdi mdi-whatsapp"></i>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" data-toggle="modal" data-target="#modalEditCustomer{{$item->id}}" class="btn btn-xs btn-purple">
                                                    <i class="mdi mdi-pencil"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>

        </div>
        <!-- end row -->

        <ul class="pagination pagination-rounded justify-content-end mb-0 mt-2">
            {{ $clients->links() }}
        </ul>

    </div>
    <!-- end container-fluid -->

</div>
<!-- end content -->

@foreach ($clients as $item)

<!-- Modal Update Category -->
    <div class="modal fade" id="modalEditCustomer{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="text-uppercase" id="updateModalLongTitle">Modifier information client</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('agent.client-update', [$item->id])}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-body" >
                        <div class="form-group">
                            <label>Prenom Nom</label>
                            <input type="text" class="form-control @error('prenom_nom') is-invalid @enderror" value="{{$item->prenom_nom}}" name="prenom_nom" data-toggle="flatpicker" placeholder="Prenom Nom" required>
                            @error('prenom_nom')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Adresse</label>
                            <input type="text" class="form-control @error('adresse') is-invalid @enderror" value="{{$item->adresse}}" name="adresse" data-toggle="flatpicker" placeholder="Adresse">
                            @error('adresse')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Telephone</label>
                            <input type="text" class="form-control @error('telephone') is-invalid @enderror" value="{{$item->telephone}}" name="telephone" data-toggle="flatpicker" placeholder="Numéro Téléphone" required>
                            @error('telephone')
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

@endforeach

<!-- Modal Create Category -->
<div class="modal fade" id="modalNewCustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="text-uppercase" id="updateModalLongTitle">Nouveau client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('agent.client-store')}}" method="post">
                @csrf
                <div class="modal-body" >
                    <div class="form-group">
                        <label>Prenom Nom</label>
                        <input type="text" class="form-control @error('prenom_nom') is-invalid @enderror" name="prenom_nom" data-toggle="flatpicker" placeholder="Prenom Nom" required>
                        @error('prenom_nom')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Adresse</label>
                        <input type="text" class="form-control @error('adresse') is-invalid @enderror" name="adresse" data-toggle="flatpicker" placeholder="Adresse">
                        @error('adresse')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Telephone</label>
                        <input type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" data-toggle="flatpicker" placeholder="Numéro Téléphone" required>
                        @error('telephone')
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
<!-- content -->

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
