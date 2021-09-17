<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-md-6 text-left">
                    <h3 class="header-title mb-2">Liste des Ventes</h3>
                </div>

                <p class="sub-header text-center">
                    Une modification ou suppression serait possible que 1 jour aprés un processus de vente.
                </p>
            </div>
            <div class="table-responsive">
                <table class="table m-0">
                    <thead>
                        <tr>
                            <th class="text-center font-weight-bold">Vendu par</th>
                            <th class="text-center font-weight-bold">Vendu à</th>
                            <th class="text-center font-weight-bold">Article</th>
                            <th class="text-center font-weight-bold">Quantite</th>
                            <th class="text-center font-weight-bold">Prix Unitaire</th>
                            <th class="text-center font-weight-bold">Montant Total</th>
                            <th class="text-center font-weight-bold">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ventes as $key => $item)
                            <tr>
                                <td class="text-center">{{$item->agent->name}}</td>
                                <td class="text-center">{{$item->client->prenom_nom}}
                                    <button href="https://wa.me/{{$item->client->telephone}}?text=Bonjour%20{{$item->client->prenom_nom}}," target="_blank" class="btn btn-success btn-circle btn-xs">
                                        <i class="mdi mdi-whatsapp"></i>
                                    </button>
                                </td>
                                <td class="text-center">{{$item->article->nom_article}}</td>
                                <td class="text-center">{{$item->quantite_article}}</td>
                                <td class="text-center font-weight-bold">{{number_format($item->article->prix_article, 0, ',', '.')}}</td>
                                <td class="text-center font-weight-bold">{{number_format($item->montant_total, 0, ',', '.')}}</td>
                                <td class="text-center">
                                    @if ($item->created_at->diffInDays(now()) < 1)
                                        <button class="btn btn-xs btn-purple" data-toggle="modal" data-target="#modalEditArticle{{$item->id}}">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                        <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modalDeleteApprov{{$item->id}}">
                                            <i class="mdi mdi-delete"></i>
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
