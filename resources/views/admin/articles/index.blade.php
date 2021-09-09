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
                            <li class="breadcrumb-item active">Liste des Articles</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Articles</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row mb-2">
            <div class="col-md-6 row">
                <a href="{{route('admin.article-create')}}" class="btn btn-primary text-white waves-effect waves-light mb-3 ml-2"><i class="mdi mdi-plus"></i> Ajouter une article</a>
            </div>
            <div class="col-md-6">
                <form action="javascript: void(0);" method="get">
                    <div class="input-group">
                        <input type="text" id="recherche" name="recherche" class="form-control" placeholder="Rechercher une article">
                        <span class="input-group-append">
                            <button type="submit" class="btn waves-effect waves-light btn-primary">Recherche</button>
                        </span>
                    </div>
                </form>
            </div>
            <!-- end col-->
        </div>
        <!-- end row-->

        <div class="row" id="articleList">
            @if (!empty($articles))
                @include('admin.articles.liste-articles')
            @endif
        </div>
        <!-- end row -->

        <ul class="pagination pagination-rounded justify-content-end mb-0 mt-2">
            {{ $articles->links() }}
        </ul>

    </div>
</div>

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
            url : "{{URL::to( route('admin.article-search') )}}",
            data: {'recherche' : $value},
            success:function(data){
                $('#articleList').html('');
                $('#articleList').html(data);
            }
        });
    });
</script>
@endsection

