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
                            <li class="breadcrumb-item active">Liste des utilisateurs</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Utilisateurs</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row mb-2">
            <div class="col-md-6 row">
                <a href="javascript: void(0);" data-toggle="modal" data-target="#modalCreateUser" class="btn btn-primary text-white waves-effect waves-light mb-3 ml-2"><i class="mdi mdi-plus"></i> Ajouter un utilisateur</a>

                <div class="col-md-6">
                    <button type="button" class="btn btn-secondary dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="false"> Exporter <i class="mdi mdi-chevron-down"></i> </button>
                    <ul class="dropdown-menu" style="">
                        <li><a href="javascript: void(0);" class="dropdown-item">EXCEL</a></li>
                        <li><a href="javascript: void(0);" class="dropdown-item">CSV</a></li>
                    </ul>
                </div>

            </div>
            <div class="col-md-6">
                <form action="javascript: void(0);" method="get">
                    <div class="input-group">
                        <input type="text" id="recherche" name="recherche" class="form-control" placeholder="Rechercher un utilisateur">
                        <span class="input-group-append">
                            <button type="submit" class="btn waves-effect waves-light btn-primary">Recherche</button>
                        </span>
                    </div>
                </form>
            </div>
            <!-- end col-->
        </div>
        <!-- end row-->

        <div class="row" id="userList">
            @if (!empty($users))
                @include('admin.users.liste-users')
            @endif
        </div>
        <!-- end row -->

        <ul class="pagination pagination-rounded justify-content-end mb-0 mt-2">
            {{ $users->links() }}
        </ul>

    </div> <!-- end container-fluid -->

</div> <!-- end content -->
<!-- content -->
@foreach($users as $user)
    <!-- Modal Show User -->
    <div class="modal fade bd-example-modal-lg" id="showUserInfo{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-light">
                    <h5 class="text-uppercase" id="exampleModalLongTitle"><i class="mdi mdi-account-circle mr-1"></i> Détails utilisateur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="media mb-3">
                        <img class="d-flex mr-3 rounded-circle avatar-lg" src="{{ $user->photo_profil }}" alt="Generic placeholder image">
                        <div class="media-body">
                            <h4 class="mt-0 mb-1">{{ $user->name }}</h4>
                            @if($user->is_active == 1)
                                <p class="text-muted">Compte : Activé</p>
                            @else
                                <p class="text-muted">Compte : Désactivé</p>
                            @endif
                            <a href="javascript: void(0);" class="btn- btn-xs btn-success text-white">{{ ucfirst(trans($user->profil->nom_role)) }}</a>
                            <a href="javascript: void(0);" class="btn- btn-xs btn-secondary text-white">{{ $user->email }}</a>
                        </div>

                    </div>

                    <div class="row col-md-12">

                        <div class="col-md-4">
                            <h4 class="font-13 text-muted text-uppercase mb-1">Téléphone</h4>
                            <p class="mb-3"> {{ ($user->numero_telephone) }}</p>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
@endforeach


<!-- Modal Create Category -->
<div class="modal fade" id="modalCreateUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="text-uppercase" id="updateModalLongTitle">Nouveau utilisateur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.user-store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Date View -->
                            <div class="form-group">
                                <label>Prénom Nom</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" data-toggle="flatpicker" placeholder="Prénom Nom" required>
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <!-- Date View -->
                            <div class="form-group">
                                <label>Login</label>
                                <input type="text" name="login" class="form-control @error('login') is-invalid @enderror" data-toggle="flatpicker" placeholder="login" required>
                                @error('login')
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
                                <label>Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" data-toggle="flatpicker" placeholder="Email" required>
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <!-- Date View -->
                            <div class="form-group">
                                <label>Téléphone</label>
                                <input type="tel" name="numero_telephone" class="form-control @error('numero_telephone') is-invalid @enderror" data-toggle="flatpicker" placeholder="Numéro Téléphone" required>
                                @error('numero_telephone')
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
                                <label>Photo profil</label>
                                <input type="file" class="form-control @error('photo_profil') is-invalid @enderror" name="photo_profil" data-toggle="flatpicker">
                                @error('photo_profil')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <!-- Date View -->
                            <div class="form-group">
                                <label>Role d'utilisateur</label>
                                <select name="role_id" id="role_id" class="form-control @error('role_id') is-invalid @enderror">
                                    @foreach ($roles as $item)
                                        <option value="{{$item->id}}">{{$item->nom_role}}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success mr-1">Enregistrer</button>
                    <button type="close" class="btn btn-secondary" data-dismiss="modal" >Annuler</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Update Statut -->
<div class="modal fade" id="modalUpdateUserStatut" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header bg-light">
                <h5 class="text-uppercase" id="updateModalLongTitle">
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="updateUserForm" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
            <div class="modal-body" >
                    <p class="text-center" id="updateModalLongBody" style="font-size:16px"></p>
            </div>
            <div class="modal-footer">
                    <button type="submit" class="btn btn-danger mr-1" id="submitModalButton" data-dismiss="modal" onclick="formSubmit()">Désactiver</button>

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
            url : "{{URL::to( route('admin.user-search') )}}",
            data: {'recherche' : $value},
            success:function(data){
                $('#userList').html('');
                $('#userList').html(data);
            }
        });
    });
</script>

<script type=text/javascript>
    function updateUserForm(idUser, statut)
    {
        var id = idUser;
        var url = '{{ route("admin.user-statut", ":id") }}';
        var title = document.getElementById('updateModalLongTitle');
        var body = document.getElementById('updateModalLongBody');
        var button = document.getElementById('submitModalButton');
        title.innerHTML = '<i class="mdi mdi-account-circle mr-1"></i>';
        body.innerHTML = "";
        button.innerHTML = "";

        if (statut == 1){
            title.append("Désactivation utilisateur");
            body.append("Etes-vous sûr de vouloir désactiver ce compte ?");
            button.append("Désactiver");
            button.classList.remove("btn-success");
            button.classList.add("btn-danger");
        }
        else {
            title.append("Activation utilisateur");
            body.append("Etes-vous sûr de vouloir activer ce compte ?");
            button.append("Activer");
            button.classList.remove("btn-danger");
            button.classList.add("btn-success");
        }
        url = url.replace(':id', id) ;
        $("#updateUserForm").attr('action', url);
    }

    function formSubmit()
    {
        $("#updateUserForm").submit();
    }
</script>
@endsection
