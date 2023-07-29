<?php $actual_link = URL::to('/'); ?>
@extends('layouts/unlock')



@section('head')
<title> Secure Checkout | demoninja.com</title>
{!! !empty($asset_header->content) ? $asset_header->content:''!!}  
@endsection

@section('content')
  <div class="container">
    <form id="order_form" name="" method="POST" action="{{ url('/order/payment') }}">
      @csrf
      <input type="hidden" class="form-control" name="country_id" value={{$networks->country_id}}>
      <input type="hidden" class="form-control" name="order_id" value={{$OrderID}}>
      <input type="hidden" class="form-control" name="network_id" value={{$networks->network_id}}>
      <input type="hidden" class="form-control" name="brand_id" value={{$brands->manu_id}}>
      <input type="hidden" class="form-control" name="model_id" value={{$models->model_id}}>
      <input type="hidden" class="form-control" name="email" value={{$emails}}>
      <section class="payment-page02">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-sm-7 col-12 bg-fff minHeight300">
        
        <div class="left-box">
        <div class="network-box">
          <span class="brand-img">
            <div class="dis-tab">
              <div class="var-mid">
                <img src="/images/banners/thumb/{{$bnr_image}}" class="img-fluid" style="margin:0 auto; display:table;" width="65" alt="Unlock -">
                </div>
              </div>
            </span>
            <h2>Pay now to use your phone with any network in the world!</h2>
            <div class="clearfix"></div>
          </div>
          <div class="clearfix"></div>
          <div class="selected-filed">
            <table class="table">
              <tbody>
                <tr>
                  <td width="10%">
                    <strong>Phone</strong>
                  </td>
                  <td width="5%">:</td>
                  <td width="85%">{{ $brands->manu_name }}, {{$models->model_num}}</td>
                </tr>
                <tr>
                  <td>
                    <strong>Network</strong>
                  </td>
                  <td>:</td>
                  <td>{{ $networks->network_name}}, {{$networks->country_name}}</td>
                </tr>
                <tr>
                  <td>
                    <strong>Email</strong>
                  </td>
                  <td>:</td>
                  <td>{{ $emails }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="clearfix"></div>
          <div class="dis">
            <img src="images/moneyback.png" style="position: absolute;left: -28px;top: -20px;"> 100% money back guarantee in case unlock code is not available for your phone. You will be prompted to provide IMEI number once you have made the payment.
            </div>
            <h3>Unlock Service(s) available for your {{ $brands->manu_name }} {{$models->model_num}}:</h3>
            <br>
            @php($i = 0)
            @foreach ($enabletools as $enatool)
            <div class="radio">
              @if ($i==0)
                <input type="radio" class="serviceClass" mrp="{{$enatool->mrp}}" data="{{$enatool->selling_price}}" name="toolID" price="{{$enatool->selling_price}}" id="toolID[]" value="{{$enatool->tool_id}}" checked="true">
                @php($i = 1)
                @php($tSellingPrice = $enatool->selling_price)
              @else
                <input id="r11" type="radio" class="serviceClass" mrp="{{$enatool->mrp}}" data="{{$enatool->selling_price}}" name="toolID" price="{{$enatool->selling_price}}" id="toolID[]" value="{{$enatool->tool_id}}" value="{{$enatool->tool_id}}">
              @endif
              
              <a data-toggle="collapse" class="clsclk" data-parent="#accordion" href="#collapse2-{{$enatool->tool_id}}">
              <label for="r11" class="levclicked">
              <h2>{{$enatool->selling_price}} -
              <small>Expected delivery: {{$enatool->estimated_time}}</small>
              </h2>
              </label>
              </a>
              <div class="contain-box mt-2"> {!! $enatool->summary !!}
              <br>
                <a class="read-more-collaspe" href="#block-id2-1625" data-toggle="collapse" aria-expanded="false" aria-controls="block-id"></a>
              </div>
            </div>
            <br>
            @endforeach
            
        </div>
      </div>


      <div class="col-md-4 col-sm-5 col-12 bgf7f7f7">
        


          <div class="right-boxPP">
            <?php   if($enabletools[0]->mrp != 0.00){   ?>
            <div class="discount" > 
              <span id="mrpdiscount">$<?php 
                        $disCotPri = $enabletools[0]->mrp - $enabletools[0]->selling_price;
                          echo number_format($disCotPri,2);?></span> <span class="off">off</span>
            </div>
            <?php } ?>
            <h3>
              <?php   if($enabletools[0]->mrp != 0.00){   ?>
              <p id="subtotalid"> Subtotal: <small class="green-discounted">$<?php echo number_format($enabletools[0]->mrp,2);?></small></p>
              <?php } ?>
              <small class="uniprice">$<?php echo number_format($enabletools[0]->selling_price,2);?></small>
              <img src="images/svg/purse.svg" class="order-purse-img"></img>
            </h3>
            <div class="pay-include">
              <h2>All Inclusive:</h2>

              <ul><li> <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Once your phone is unlocked - it stays unlocked :) "> 
                <img src="images/svg/check-box2.svg"></img> 
                <span>Permanent Unlock</span> </a></li><li> <a data-toggle="tooltip" data-placement="top" title="" data-original-title="No shady software to be installed, no jail breaking, no sim cover. Plain simple unlock code."> 
                <img src="images/svg/check-box2.svg"></img> 
                <span>Safe for Phone</span> </a></li><li> <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Our support team is eager to help should you need any assistance with our services. "> 
                <img src="images/svg/check-box2.svg"></img> 
                <span>After Sales Support</span> </a></li><li> <a data-toggle="tooltip" data-placement="top" title="" data-original-title="You will get a full payment if we are unable to unlock your phone. "> 
                <img src="images/svg/check-box2.svg"></img> 
                <span>Money back Guarantee</span> </a></li><li> <a data-toggle="tooltip" data-placement="top" title="" data-original-title="We will work with your network provider or phone manufacturer to unlock your phone. "> 
                <img src="images/svg/check-box2.svg"></img> 
                <span>100% Legal</span> </a></li><li> <a data-toggle="tooltip" data-placement="top" title="" data-original-title="One lucky customer wins $100 each month at demoninja.com and you can too."> 
                <img src="images/svg/check-box2.svg"></img> 
                <span>Chance to WIN $100</span> </a></li>
              </ul>

            </div>
            <div class="tatal-price">
              <h4>Total 
                <small class="uniprice">{{$totalPrice}}</small>
              </h4>
            </div>
            <input name="submit" id="nikedoit" style="display:none" class="apply-btn" type="submit" value="Pay Now">
              <button type="button" class="blue-btn" data-toggle="modal" data-target="#exampleModalCenter">Pay Now</button>
            <!--  <button type="submit" id="samdoit" style="display:none;"></button> -->
              <div class="secureG">
                <img></img> 100% Secure.
              </div>
              <button type="button" class="pay-btn-img" data-toggle="modal" data-target="#exampleModalCenter">
                <img src="{{url('/images/pay-mode2.jpg')}}" alt="" class="img-fluid">
              </button>

              <div class="clearfix"></div>
            </div>




      </div>
    </div>
  </div>
  
</section>

<div class="modal fade payment-mode" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      

      <div class="modal-content">
          <div class="modal-body">
            <button type="submit" id="paypalpay" class="paypal1" href="https://www.paypal.com/in/home" style="width: 100% !important; display: block; text-align: center;" disabled>Pay with Paypal &nbsp; 
              <img src="images/right-arrow-circular-button.png" width="18px">
              </button>
              <div class="or">
                <span>Or</span>
              </div>
              <div class="">
                <div class="cards">Pay by credit card: 
                  <img src="images/card.jpg">
                  </div>
                  <span class="showerrorr" style="color:red;font-size:16px; display:none;"></span>
                  <div class="">
                    <div class="row form-group">
                        <div class="col-6">
                          <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name">
                            <span class="showerror fname" style="color:red;font-size:16px; display:none;">Please Enter First Name</span>
                          </div>
                          <div class="col-6">
                            <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name">
                              <span class="showerror lname" style="color:red;font-size:16px; display:none;">Please Enter Last Name</span>
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col-md-12">
                            <input type="text" name="card_number" id="card_number" size="16" maxlength="16" class="form-control" placeholder="Card Number">
                            <span class="showerror card_number" style="color:red;font-size:16px; display:none;">Please Enter Card Number</span>
                          </div>
                      </div>

                          <label class="billing-address">Card Expiry</label>
                          <label class="billing-address" style="float: right; margin-left: 0; text-align: left; width: 103px;">CVV</label>
                          <div class="row form-group">
                              <div class="col-md-4 col-sm-4 col-xs-4 dash">
                                <select class="form-control" name="card_month" id="card_month">
                                  <option value="" selected="">Month</option>
                                  <option value="01">01/Jan</option>
                                  <option value="02">02/Feb</option>
                                  <option value="03">03/Mar</option>
                                  <option value="04">04/Apr</option>
                                  <option value="05">05/May</option>
                                  <option value="06">06/Jun</option>
                                  <option value="07">07/Jul</option>
                                  <option value="08">08/Aug</option>
                                  <option value="09">09/Sept</option>
                                  <option value="10">10/Oct</option>
                                  <option value="11">11/Nov</option>
                                  <option value="12">12/Dec</option>
                                </select>
                                <span class="showerror card_month" style="color:red;font-size:16px; display:none;">Select Month</span>
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-4 dash">
                                <select class="form-control" name="card_year" id="card_year">
                                  <option value="" selected="">Year</option>
                                  <option value="21">2021</option>
                                  <option value="22">2022</option>
                                  <option value="23">2023</option>
                                  <option value="24">2024</option>
                                  <option value="25">2025</option>
                                  <option value="26">2026</option>
                                  <option value="27">2027</option>
                                  <option value="28">2028</option>
                                  <option value="29">2029</option>
                                  <option value="30">2030</option>
                                  <option value="31">2031</option>
                                  <option value="32">2032</option>
                                  <option value="33">2033</option>
                                  <option value="34">2034</option>
                                  <option value="35">2035</option>
                                  <option value="36">2036</option>
                                  <option value="37">2037</option>
                                  <option value="38">2038</option>
                                  <option value="39">2039</option>
                                  <option value="40">2040</option>
                                </select>
                                <span class="showerror card_year" style="color:red;font-size:16px; display:none;">Select Year</span>
                              </div>
                              <div class="col-md-4 col-sm-4 col-xs-4" style="position:relative;">
                                <input type="text" class="form-control " name="cvd" id="cvd" size="3" maxlength="3" placeholder="CVV">
                                  <span class="showerror cvd" style="color:red;font-size:16px; display:none;">Enter CVV</span>
                                  <span data-placement="top" class="append text-info tip cvv" data-tip="tip-first" data-original-title="" title="">
                                    <img src="images/cvv.jpg">
                                  </span>
                                  <div id="tip-first" class="tip-content hidden" style="display: none;"> Your CVV number can be located by looking on your credit or debit card, as illustrated in the image below: 
                                      <img src="images/cvv2.jpg" style="margin-top:10px;">
                                  </div>
                              </div>
                          </div>
                        </div>
                      </div>
                  </div>

                  <div class="modal-footer">
                    <div class="secureG" style="text-align: center;font-size: 16px;font-weight: 400;color: #999;padding-bottom: 10px; width: 100%;">
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="15px" height="15px" viewBox="0 0 361.118 361.118" style="enable-background:new 0 0 361.118 361.118; color: #999; font-size: 16px;" xml:space="preserve" class="svg replaced-svg">
                        <g>
                          <g id="_x32_37._Locked">
                            <g>
                              <path d="M274.765,141.3V94.205C274.765,42.172,232.583,0,180.559,0c-52.032,0-94.205,42.172-94.205,94.205V141.3     c-17.34,0-31.4,14.06-31.4,31.4v157.016c0,17.344,14.06,31.402,31.4,31.402h188.411c17.341,0,31.398-14.059,31.398-31.402V172.7     C306.164,155.36,292.106,141.3,274.765,141.3z M117.756,94.205c0-34.69,28.12-62.803,62.803-62.803     c34.685,0,62.805,28.112,62.805,62.803V141.3H117.756V94.205z M274.765,329.715H86.354V172.708h188.411V329.715z      M164.858,262.558v20.054c0,8.664,7.035,15.701,15.701,15.701c8.664,0,15.701-7.037,15.701-15.701v-20.054     c9.337-5.441,15.701-15.456,15.701-27.046c0-17.348-14.062-31.41-31.402-31.41c-17.34,0-31.4,14.062-31.4,31.41     C149.159,247.102,155.517,257.117,164.858,262.558z" fill="#999"></path>
                            </g>
                          </g>
                        </g>
                        <g></g>
                        <g></g>
                        <g></g>
                        <g></g>
                        <g></g>
                        <g></g>
                        <g></g>
                        <g></g>
                        <g></g>
                        <g></g>
                        <g></g>
                        <g></g>
                        <g></g>
                        <g></g>
                        <g></g>
                      </svg> 100% Secure.
                    </div>
                    <button type="image" id="samdoitt" data-target=".bs-example-modal-lg" class="blue-btn mt20">MAKE PAYMENT</button>
                  </div>
                </div>
    </div>
  </div>


            
    </form>
    
    
  </div>

  <section class="paymentPP"><div class="copyright"> <img src="{{url('/images/logo.png')}}" class="" height="25px" alt="logo"> <span class="">© 2021 demoninja.com All rights reserved. | <a href="https://demoninja.com/contacts" itemprop="name">Contact us</a> | <a href="https://demoninja.com/pages/display/terms-conditions/" itemprop="name">Terms &amp; conditions</a></span></div> </section>

@endsection

@section('footer')


{!! !empty($asset_footer->content) ? $asset_footer->content:''!!}  
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script>


    $(".serviceClass").click(function(){
    var price=$(this).attr('data');
    var mrp =$(this).attr('mrp');
    $(".uniprice").html("$"+price);
    $("#grossamount").html("$"+price);
    if(mrp != 0){
         $("#subtotalid").show();
         $(".discount").show();
        $(".green-discounted").html("$"+mrp);
        var mrpdiscount = (mrp - price).toFixed(2);
        $("#mrpdiscount").html("$"+ mrpdiscount);
       // $("#mrpdiscount").html("$10");
       // alert('hello');
    }else{
        $("#subtotalid").hide();
         $(".discount").hide();
       // $(".green-discounted").hide();
        $(".discount").hide();
        
    }
    $("#discount").hide();
    });
  
  function isJson(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}
  $(document).ready(function() { 
  
  $("#fname").keyup(function() {
            $('.fname').hide();
        });
    
    $("#lname").keyup(function() {
            $('.lname').hide();
        });
    
    $("#card_number").keyup(function() {
            $('.card_number').hide();
        });
    
    $("#card_month").change(function() {
            $('.card_month').hide();
        });
    
    $("#card_year").change(function() {
            $('.card_year').hide();
        });
    
    $("#cvd").keyup(function() {
            $('.cvd').hide();
        });
  
  $('#samdoitt').on('click', function(){

  var order_id = '<?php echo $OrderID; ?>';
  //alert(order_id);
  var price = $('#price').val();
  var tool = $('input[name="toolID"]:checked').val();;
  var fname = $('#fname').val();
  var lname = $('#lname').val();
  var card_number = $('#card_number').val();
  var card_month = $('#card_month').val();
  var card_year = $('#card_year').val();
  
  var expdate = $('#card_year').val() + $('#card_month').val();
  var cvd = $('#cvd').val();
  
   if(fname=='' || fname==null){
    
    //$('.showerror').text('Please enter first name');
    $('.fname').show();
    //return false;
  }
  
  if(lname=='' || lname==null){
    
    //$('.showerror').text('Please enter last name');
    $('.lname').show();
    ///return false;
  }
  
  if(card_number=='' || card_number==null){
    
    ///$('.showerror').text('Please enter card number');
    $('.card_number').show();
    //return false;
  }
  
  if(card_month=='' || card_month==null){
    
    //$('.showerror').text('Please select month');
    $('.card_month').show();
    //return false;
  }
  
  
  if(card_year=='' || card_year==null){
    
    //$('.showerror').text('Please select year');
    $('.card_year').show();
    //return false;
  }
  
  
  if(cvd=='' || cvd==null){
    
    //$('.showerror').text('Please enter cvd');
    $('.cvd').show();
    //return false;
  }
  
  
  if(card_number=='' || card_number==null || lname=='' || lname==null || card_number=='' || card_number==null || card_month=='' || card_month==null || card_year=='' || card_year==null || cvd=='' || cvd==null){
  return false;
  } 
  
  //$('.top-overlay').show();
  //alert('hello');
  //alert('<?php // echo $actual_link; ?>/customerordermoneris');
  //return false;
  //if(chekcorder == '' || chekcorder == null || chekcorder == ' '){
    //alert($('#moneris').serialize());
    
    $.ajax({
            type: 'post',
      url: '<?php echo $actual_link; ?>/customerordermoneris',
            
            data: { "_token": "{{ csrf_token() }}",'order_id': order_id, 'price': price , 'fname': fname, 'lname': lname, 'card_number': card_number, 'expdate': expdate , 'cvd': cvd , 'tool': tool },
            success: function (data) {

        //$('.top-overlay').hide();
        if(isJson(data)==true){
          
          var obj = JSON.parse(data);
          //alert(obj.fnamee);
          if(obj.fname==1){
            $('.fname').show();
          }
          
          if(obj.lname==1){
            $('.lname').show();
          }
          
          if(obj.card_number==1){
            $('.card_number').show();
          }
          
          if(obj.expdate==1){
            $('.card_month').show();
            $('.card_year').show();
          }
          
          if(obj.cvd==1){
            $('.cvd').show();
          }
          
          
          
        }else {
                if(data=='APPROVED'){
                    //$('#samdoitt').attr('disabled',true);
                    var chekcorder = $('#order_id').val();
                    window.location.href = "<?php  echo $actual_link; ?>/thankyou?cm="+chekcorder;
                } else {
                 // $('.top-overlay').hide();
                  $('.showerrorr').html('Declined: Please retry with correct details or another card <br> Or pay with <a href="#"  id="paypalpay1"> PayPal </a>');
                  $('.showerrorr').show(); 
                  
                } 
              } 
        
            }
          });  
        //alert('hello');
        return false;
  }); 
  });
  </script>
  <script type='text/javascript'>
    $(document).ready(function(){
      $('input[type="radio"]').change(function(){
        if ($(this).is(":checked"))
        {
          //$(this).attr('price');
          //var col1 = $(this).parent().parent().children("td:first");
         // var col2 = col1.next();
          //event.preventDefault();
          $('#selling_price').html($(this).attr('price'));
        }
      });
    }); 
  </script>
@endsection