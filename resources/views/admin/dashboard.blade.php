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
                                <p class="m-0 text-uppercase text-white" title="Request Per Minute">Category</p>
                                <h2 class="text-white"><span data-plugin="counterup">{{$datas['category']}}</span></h2>
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
                                <h2 class="text-white"><span data-plugin="counterup">854</span></h2>
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
                        <h4 class="header-title mb-3">Last 30 days statistics</h4>

                        <div dir="ltr">
                            <div id="donut-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">Total Revenue share</h4>
                        <div dir="ltr">
                            <div id="combine-chart"></div>
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
                                    <th>Project Name</th>
                                    <th>Start Date</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th>Assign</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Codefox Admin v1</td>
                                        <td>01/01/2017</td>
                                        <td>26/04/2017</td>
                                        <td><span class="badge badge-info">Released</span></td>
                                        <td>Coderthemes</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Codefox Frontend v1</td>
                                        <td>01/01/2017</td>
                                        <td>26/04/2017</td>
                                        <td><span class="badge badge-success">Released</span></td>
                                        <td>Coderthemes</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Codefox Admin v1.1</td>
                                        <td>01/05/2017</td>
                                        <td>10/05/2017</td>
                                        <td><span class="badge badge-pink">Pending</span></td>
                                        <td>Coderthemes</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Codefox Frontend v1.1</td>
                                        <td>01/01/2017</td>
                                        <td>31/05/2017</td>
                                        <td><span class="badge badge-purple">Work in Progress</span></td>
                                        <td>Coderthemes</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Codefox Admin v1.3</td>
                                        <td>01/01/2017</td>
                                        <td>31/05/2017</td>
                                        <td><span class="badge badge-warning">Coming soon</span></td>
                                        <td>Coderthemes</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Codefox Admin v1</td>
                                        <td>01/01/2017</td>
                                        <td>26/04/2017</td>
                                        <td><span class="badge badge-info">Released</span></td>
                                        <td>Coderthemes</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Codefox Frontend v1</td>
                                        <td>01/01/2017</td>
                                        <td>26/04/2017</td>
                                        <td><span class="badge badge-success">Released</span></td>
                                        <td>Coderthemes</td>
                                    </tr>

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
