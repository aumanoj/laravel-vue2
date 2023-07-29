@extends('layouts/unlock')

@section('headcontent')
  <title>Unlock Ninja</title>

  <link href="{{asset('assets/vendors/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('assets/vendors/select2/css/select2-bootstrap.css')}}" rel="stylesheet" type="text/css">

  <style>
    div#brand-errors,#model-errors {
        padding: 6px 0;
        color: #fa755a;
        font-weight: 600;
      }

  </style>
@endsection

@section('content')

@include('layouts.header')
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{url('/')}}">Unlock Cellphone</a>
    </li>
    <li class="breadcrumb-item active" area-current="page">Unlock {{ucfirst(trans($brands_href))}}</li>
  </ol>
  <div class="container">
    <form id="model_form" name="" method="GET" action="{{ url('/') }}">
      @csrf
      <div class="row">
        <input type="hidden" name='brand_id' id='brand_id' value={{$brands_href}}>
        <div class="form-group col-md-4">
          <select class="form-control select2" id="model_id" name="model_id"> 
            <option value=''>Select Model</option>
            @if (count($modelsGT) > 0)
              <option value='' disabled="true">----Top Model----</option>
              @foreach($modelsGT as $model)                                     
                <option value="{{$model->model_id}}">{{$model->model_num}}</option>
              @endforeach
              <option value='' disabled="true">----</option>
            @endif
            @foreach($modelsEQ as $model)                                     
              <option value="{{$model->model_id}}">{{$model->model_num}}</option>
            @endforeach
          </select>
          <div class="form-group" id="model-errors" role="alert"></div>
        </div>
 
        <div class="form-group col-md-4">
          <button type="button" id="submit_form" class="btn btn-success form-control">Unlock Now</button>
        </div>
      </div>
    </div>
    </form>
  </div>
@endsection

@section('footer')
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="{{asset('assets/vendors/select2/js/select2.js')}}" type="text/javascript"></script>
  <script type='text/javascript'>

  $(document).ready(function(){
    $('#model_id').select2();
    
    $('#submit_form').click(function(){
      var brandID = $('#brand_id').val();
      var modelID = $('#model_id option:selected').text();
      var errModel = document.getElementById('model-errors')

      errModel.textContent = '';
      event.preventDefault();
      if (modelID == 'Select Model')
      {
        errModel.textContent = 'Select Model';
        window.history.go(-1);
      }
      else
      {
        var strBrand = brandID.replace(/-/g,"~");
        var strModel = modelID.replace(/-/g,'~');
        var strBrand = strBrand.replace(/ /g,"-");
        var strModel = strModel.replace(/ /g,"-");
        var strBrand = strBrand.toLowerCase();
        var strModel = strModel.toLowerCase();

        var url = '/unlock-'+strBrand+'+'+strModel;
        window.location.href = url;
      }
    });
  });

  </script>
@endsection
