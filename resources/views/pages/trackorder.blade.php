
@extends('frontend_layouts.app')

@section('head')
  <link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
  <section class="content-header">
    <h1>Track your Order</h1>
  </section>
  <div class="payment-form-box">
    <form method="POST" id="track_order">
      @csrf
      <div class="form-row">
        @if (!isset($orders))
        <div class="form-group col-md-6">
          <label for="inputEmail4">IMEI Number</label>
          <input type="text" class="form-control" name="imei" id="imei" placeholder="IMEI Number" autocomplete="off" value="{{ $app->request->get('imei') }}">
          <div id="imei-errors" role="alert"></div>
          @if($errors->has('imei'))
            <p class="text-danger">{{ $errors->first('imei') }}</p>
          @endif
        </div>
        <div class="form-group col-md-6">
          <label for="inputEmail4">Your Email</label>
          <input type="text" class="form-control" name="email" id="email" placeholder="Your Email ID" autocomplete="off" value="{{ $app->request->get('email') }}">
          <div id="email-errors" role="alert"></div>
          @if($errors->has('email'))
            <p class="text-danger">{{ $errors->first('email') }}</p>
          @endif
        </div>
        <div class="form-group col-md-12 text-center">
          <button type="submit" id="order" name="order" class="btn unlock-btn">Check Order</button>
        </div>
        @endif
        @if (isset($orders))
          @if (count($orders) > 0)
            <table  class="table table-hover">
              <thead>
                <th>OrderID</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Country</th>
                <th>Network</th>
                <th>Price</th>
                <th>Paid Amount</th>
                <th>Unlock Status</th>
                <th>Unlock Code</th>
                <th>IMEI No</th>
                <th>Order On</th>
              </thead>
              <tbody>
                <tr>
                  <td>{{$orders[0]->id}}</td>
                  <td>{{$orders[0]->brand->name}}</td>
                  <td>{{$orders[0]->modal->name}}</td>
                  <td>{{$orders[0]->country->country_name}}</td>
                  <td>{{$orders[0]->network->network_name}}</td>
                  <td>{{$orders[0]->total_amount}}</td>
                  <td>{{$orders[0]->paid_amount}}</td>
                  <td>{{$orders[0]->unlock_status}}</td>
                  <td>{{$orders[0]->unlock_code}}</td>
                  <td>{{$orders[0]->imei_code}}</td>
                  <td>{{$orders[0]->created_at}}</td>
                </tr>
              </tbody>
            </table>
          @else
            <p>Sorry we don't have a order avaliable for your selection. If you feel that you have place the order please don't hestitate to <a href = "{{ url('/contact-us')}}">contact us</p>
          @endif
        @endif
        
      </div>
    </form>
  </div>    
@endsection

@section('footer')
  <script>
    /*$(document).ready(function(){
      $('#order').click(function(){
  
        var imei = $('#imei').val();
        var email = $('#email').val();
        var chkEmail = /^[A-Z0-9\._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        var errorIMEI = document.getElementById('imei-errors');
        var errorEmail = document.getElementById('email-errors');
        var form = document.getElementById('track_order');

        errorIMEI.textContent = "";
        errorEmail.textContent="";
        errIMEI="";
        errEmail="";
        if (imei.length == 0)
        {
          errIMEI = 'Please fill IMEI';
        }
        else if (imei.length < 15)
        {
          errIMEI = "IMIE required minimum 15 characters long."
        }
        if (email.length == 0)
        {
          errEmail = "Please fill Email";
        }
        else if (!chkEmail.test(email))
        {
          errEmail = "Please enter valid Email."
        }
        
        if (errIMEI.length > 0)
        {
          errorIMEI.textContent = errIMEI;
          if (errEmail.length > 0)
          {
            errorEmail.textContent = errEmail;
          }
          event.preventDefault();
        }
        else if (errEmail.length > 0)
        {
          errorEmail.textContent = errEmail;
          event.preventDefault();
        }
        else
        {
          alert('here');

          form.submit();
        }
      });
    });*/
  </script>
@endsection
