<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-6 text-left">
                    <h3 class="header-title mb-2">Liste des Approvisionnements</h3>
                </div>
                <div class="col-md-6 text-right">
                    <div class="row">
                        <div class="col-6">
                            <button class="btn btn-warning waves-effect waves-light btn-xs">
                                <i class="mdi mdi-trending-neutral"></i>
                            </button>
                            En attente
                        </div>
                        <div class="col-3">
                            <button class="btn btn-success waves-effect waves-light btn-xs">
                                <i class="mdi mdi-check"></i>
                            </button>
                            Validé
                        </div>
                        <div class="col-3">
                            <button class="btn btn-danger waves-effect waves-light btn-xs">
                                <i class="mdi mdi-alert-circle-outline"></i>
                            </button>
                            Refusé
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th class="text-center font-weight-bold">Agent</th>
                            <th class="text-center font-weight-bold">Article</th>
                            <th class="text-center font-weight-bold">Quantité de depart</th>
                            <th class="text-center font-weight-bold">Date/heure de depart</th>
                            <th class="text-center font-weight-bold">Quantité de retour</th>
                            <th class="text-center font-weight-bold">Date/heure de retour</th>
                            <th class="text-center font-weight-bold">Activite</th>
                            <th class="text-center font-weight-bold">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($approvisionnement as $key => $item)
                            <tr>
                                <td class="text-center font-weight-bold">{{$item->agent->name}}</td>
                                <td class="text-center">{{$item->article->nom_article}}</td>
                                <td class="text-center">{{$item->quantite_approv_depart}}</td>
                                <td class="text-center text-uppercase">{{$item->created_at}}</td>
                                <td class="text-center">{{$item->quantite_approv_retour}}</td>
                                <td class="text-center text-uppercase">{{$item->updated_at}}</td>
                                <td class="text-center">
                                    @if ($item->activite == 1)
                                        <button class="btn btn-success btn-xs"><i class="mdi mdi-check"></i></button>
                                    @endif
                                    @if ($item->activite == 2)
                                        <button class="btn btn-danger btn-xs"><i class="mdi mdi-alert-circle-outline"></i></button>
                                    @endif
                                    @if ($item->activite == 0)
                                        <button class="btn btn-warning btn-xs"><i class="mdi mdi-trending-neutral"></i></button>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($item->confirmed == 0)
                                        <a href="{{route('admin.article-edit', [$item->id])}}" class="btn btn-xs btn-purple">
                                            <i class="mdi mdi-pencil"></i>
                                        </a>
                                        <a href="{{route('admin.article-edit', [$item->id])}}" class="btn btn-xs btn-danger">
                                            <i class="mdi mdi-delete"></i>
                                        </a>
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
