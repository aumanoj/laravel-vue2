@extends('layouts.app')
@section('content')
<div class="container-fluid">
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="float-right">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <!--<li class="breadcrumb-item"><a href="javascript:void(0);">Franchise</a></li>-->
                    <li class="breadcrumb-item active">Car List</li>
                </ol>
            </div>
            <h4 class="page-title">Cars</h4>
        </div>
        <!--end page-title-box-->
    </div>
    <!--end col-->
</div>
<!--end row-->
</div>
<!-- end page title end breadcrumb -->

<!-- <cars-component></cars-component> -->

<router-view></router-view>
@endsection