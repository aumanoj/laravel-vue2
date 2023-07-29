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
  <div class="container">
    <form id="brand_form" name="" method="GET" action="{{ url('/') }}">
      @csrf      
      <div class="row">
        <div class="form-group col-md-12">
        <div class="form-group col-md-4">
          <select class="form-control select2" id="brand_id" name="brand_id"> 
            <option value=''>Select Brand</option>
            @foreach($brands as $brand)                                     
              <option value="{{$brand->manu_id}}">{{$brand->manu_name}}</option>
            @endforeach                                
          </select>
          <div class="form-group" id="brand-errors" role="alert"></div>
        </div>

        <div class="form-group col-md-4">
          <select class="form-control select2" id="model_id" name="model_id">
            <option value=''>Select Model</option>       
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
    $('#brand_id').select2();
    $('#model_id').select2();
    
    $('#brand_id').change(function(){
      var brandID = $(this).val();

      $('#model_id').find('option').not(':first').remove();

      $.ajax({
        url: 'getModelAjax/'+brandID,
        type: 'GET',
        dataType: 'HTML',
        success: function(data){
          console.log(data);
          $("#model_id").html(data);
       } 
      });
    });
  });

  $('#submit_form').click(function(){
    var brandID = $('#brand_id option:selected').text();
    var modelID = $('#model_id option:selected').text();
    var errBrand = document.getElementById('brand-errors');
    var errModel = document.getElementById('model-errors');

    errBrand.textContent = '';
    errModel.textContent = '';
    event.preventDefault();
    if (brandID == 'Select Brand')
    {
      errBrand.textContent = "Select Manufacturer";
    }
    else if (modelID == 'Select Model')
    {
      errModel.textContent = 'Select Model';
    }
    else
    {
      var strBrand = brandID.replace('-',"~");
      var strModel = modelID.replace('-',"~");
      var strBrand = strBrand.replace(/ /g,"-");
      var strModel = strModel.replace(/ /g,"-");
      var strBrand = strBrand.toLowerCase();
      var strModel = strModel.toLowerCase();

      var url = '/unlock-'+strBrand+'+'+strModel;
      window.location.href = url;
    }

  });
  </script>
@endsection