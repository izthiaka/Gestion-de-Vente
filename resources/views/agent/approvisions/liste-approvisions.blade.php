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
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                        <tr>
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
                                <td class="text-center">{{$item->article->nom_article}}</td>
                                <td class="text-center">{{$item->quantite_approv_depart}}</td>
                                <td class="text-center text-uppercase">{{$item->created_at}}</td>
                                <td class="text-center">{{$item->quantite_approv_retour}}</td>
                                <td class="text-center text-uppercase">{{$item->updated_at}}</td>
                                <td class="text-center">
                                    @if ($item->activite == 0 || $item->activite == 2)
                                        <button class="btn btn-warning btn-xs"><i class="mdi mdi-trending-neutral"></i></button>
                                    @endif
                                    @if ($item->activite == 1)
                                        <button class="btn btn-success btn-xs"><i class="mdi mdi-check"></i></button>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($item->activite != 1 && $item->confirmed == 0)
                                        <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#modalStatutValid{{$item->id}}">
                                            <i class="mdi mdi-check-underline-circle"></i>
                                        </button>
                                        <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalStatutRefuse{{$item->id}}">
                                            <i class="mdi mdi-close-circle"></i>
                                        </button>
                                    @endif
                                    @if ($item->activite == 1 && $item->confirmed == 1)
                                        <button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#modalDeleteArticle{{$item->id}}">
                                            <i class="mdi mdi-content-save-move"></i>
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
