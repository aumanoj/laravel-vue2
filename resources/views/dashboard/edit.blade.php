@extends('layouts/unlock')

@section('headcontent')
  <title>Unlock Ninja</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/sweetalert/css/sweetalert.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
@endsection

@section('content')
    <form method="POST" action="{{ url('/dashboard/update') }}">
    @csrf
    <div class="form-group">
        <input type="hidden" name="order_id" value="{{$orders->id}}">
        <label> Please Enter your IMEI for order {{$orders->order_id}} - {{$orders->Manufacturer->manu_name}} {{$orders->Model->model_num}} ({{$orders->Network->country_name}}) {{$orders->Network->network_name}} </label>
        <input type="text" name='imei' id='imei' class="form-control p_input" value="{{$orders->imei_code}}">
        @if($errors->has('imei'))
            <p class="text-danger"> {{ $errors->first('imei') }} </p>
        @endif
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-primary btn-block enter-btn">Process My Order</button>
    </div>
  </form>
@endsection

@section('footer')
    <script type="text/javascript" src="{{ asset('assets/vendors/sweetalert/js/sweetalert.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/sweetalert/js/sweetalert-dev.js') }}"></script>

    @if (session('error'))
        <script type="text/javascript">
            swal({
                title: "Error!",
                text: "<?= session('error'); ?>",
                type: "error",
            });
        </script>
    @endif
@endsection
