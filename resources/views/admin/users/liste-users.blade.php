<div class="col-lg-12">
    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-center">Prenom Nom</th>
                            <th class="text-center">Login</th>
                            <th class="text-center">Adresse Email</th>
                            <th class="text-center">Numero telephone</th>
                            <th class="text-center">Profil Compte</th>
                            <th class="text-center">Statut</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $item)
                            <tr>
                                <td class="table-user">
                                    @if ($item->photo_profil != null)
                                        <img src="{{ $item->photo_profil }}" alt="{{ $item->login }}" class="mr-2 rounded-circle">
                                    @else
                                        <img src="{{asset('assets/images/logo-sm.png')}}" alt="table-user" class="mr-2 rounded-circle">
                                    @endif
                                </td>
                                <td class="text-center">{{$item->name}}</td>
                                <td class="text-center">{{$item->login}}</td>
                                <td class="text-center">{{$item->email}}</td>
                                <td class="text-center">{{$item->numero_telephone}}</td>
                                <td class="text-center">
                                    @if ($item->role_id == 1)
                                        <button class="btn btn-sm btn-warning btn-rounded">{{$item->profil->nom_role}}</button>
                                    @else
                                        <button class="btn btn-sm btn-primary btn-rounded">{{$item->profil->nom_role}}</button>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($item->is_active == 1)
                                        <button class="btn btn-sm btn-success btn-rounded">Activé</button>
                                    @else
                                        <button class="btn btn-sm btn-danger btn-rounded">Désactivé</button>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{route('admin.user-edit',[$item->id])}}" class="btn btn-xs btn-purple">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#showUserInfo{{$item->id}}">
                                        <i class="mdi mdi-eye"></i>
                                    </button>
                                    <input type="hidden" value="{{ $item->is_active }}" id="statusMember">
                                    @if($item->is_active == 1)
                                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" onclick="updateUserForm( {{ $item->id }}, {{ $item->is_active }} )" data-target="#modalUpdateUserStatut">
                                            <i class="mdi mdi-power-settings"></i>
                                        </button>
                                    @elseif($item->is_active == 0)
                                        <button type="button" class="btn btn-xs btn-success" data-toggle="modal" onclick="updateUserForm( {{ $item->id }}, {{ $item->is_active }} )" data-target="#modalUpdateUserStatut">
                                            <i class="mdi mdi-check"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
