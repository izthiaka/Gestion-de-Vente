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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Gestion Vente</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Bienvenue {{ Auth::user()->name }} !</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="row">

            <div class="col-xl-3 col-md-6">
                <div class="card widget-box-two bg-purple">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body wigdet-two-content">
                                <p class="m-0 text-uppercase text-white" title="Statistics">ADMIN</p>
                                <h2 class="text-white"><span data-plugin="counterup">{{$datas['admin']}}</span></h2>
                            </div>
                            <div class="avatar-lg rounded-circle bg-soft-light ml-2 align-self-center">
                                <i class="mdi mdi-account-network font-22 avatar-title text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <div class="card widget-box-two bg-info">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body wigdet-two-content">
                                <p class="m-0 text-white text-uppercase" title="User Today">AGENT</p>
                                <h2 class="text-white"><span data-plugin="counterup">{{$datas['agent']}}</span></h2>
                            </div>
                            <div class="avatar-lg rounded-circle bg-soft-light ml-2 align-self-center">
                                <i class="mdi mdi-tooltip-account  font-22 avatar-title text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <div class="card widget-box-two bg-pink">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body wigdet-two-content">
                                <p class="m-0 text-uppercase text-white" title="Request Per Minute">Client</p>
                                <h2 class="text-white"><span data-plugin="counterup">{{$datas['client']}}</span></h2>
                            </div>
                            <div class="avatar-lg rounded-circle bg-soft-light ml-2 align-self-center">
                                <i class="mdi mdi-apple-keyboard-command font-22 avatar-title text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <div class="card widget-box-two bg-success">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body wigdet-two-content">
                                <p class="m-0 text-white text-uppercase" title="New Downloads">Articles</p>
                                <h2 class="text-white"><span data-plugin="counterup">{{$datas['article']}}</span></h2>
                            </div>
                            <div class="avatar-lg rounded-circle bg-soft-light ml-2 align-self-center">
                                <i class="mdi mdi-package-variant-closed font-22 avatar-title text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->

        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">Top 5 vendeurs</h4>

                        <div dir="ltr">
                            {!! $chart->container() !!}
                            {{-- <div id="donut-chart"></div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">Total Revenue share</h4>
                        <div dir="ltr">
                            {!! $line->container() !!}
                            {{-- <div id="combine-chart"></div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->


        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">Ventes Recentes </h4>

                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="text-center">Article</th>
                                    <th class="text-center">Montant total</th>
                                    <th class="text-center">Vendu à</th>
                                    <th class="text-center">Numéro Tel</th>
                                    <th class="text-center">Vendu par</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ventes_recentes as $key => $item)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td class="text-center">{{$item->article->nom_article}}</td>
                                            <td class="text-center font-weight-bold">{{number_format($item->montant_total, 0, ',', ' ')}} Fcfa</td>
                                            <td class="text-center">{{$item->client->prenom_nom}}</td>
                                            <td class="text-center">{{$item->client->telephone}}</td>
                                            <td class="text-center font-weight-bold">{{$item->agent->name}}</td>
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

    </div> <!-- end container-fluid -->

</div> <!-- end content -->



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
<script src="{{ $chart->cdn() }}"></script>
<script src="{{ $line->cdn() }}"></script>
{{ $chart->script() }}
{{ $line->script() }}
@endsection
