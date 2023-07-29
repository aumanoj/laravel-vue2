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
                    <li class="breadcrumb-item active">Add Car</li>
                </ol>
            </div>
            <h4 class="page-title">Add Car</h4>
        </div>
        <!--end page-title-box-->
    </div>
    <!--end col-->
</div>
<!--end row-->
<!-- end page title end breadcrumb -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="make">Car</label>
                    <input type="text" class="form-control" id="make" required placeholder="Name" name="make" v-model="newCar.make">
                </div>
                <div class="form-group">
                    <label for="model">Model</label>
                    <input type="text" class="form-control" id="model" required placeholder="Model" name="model" v-model="newCar.model">
                </div>
                <button class="btn btn-primary" @click.prevent="createCar()">
                    Add Car
                </button>
            </div>
        </div>
    </div>
</div>
</div>

@endsection