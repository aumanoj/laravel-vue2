@extends('layouts/unlock')

@section('headcontent')
<title>Unlock Ninja</title>

<!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/sweetalert/css/sweetalert.css') }}" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"> -->
<!-- <script type="text/javascript">
$(document).ready(function() {
$(".clsorder" ).click(function() {
  var order_id = $(this).attr('order_id');
  var brand = $(this).attr('brand');
 //alert(brand);
  //return false;
  if(brand == 'Alcatel'){
      $("#prd").show();
      $("#prd").prop('required',true);
  }else {
       $("#prd").hide();
       $("#prd").prop('required',false);
  }
  $('#order_id').val(order_id);
  var order_detail = $(this).attr('order_detail');
  //alert(order_detail);
  $('.modelclss').html(order_detail);
  $("#openmodal").trigger("click");
}); 
});
</script> -->


@endsection


@section('content')

<nav class="navbar  navbar-expand-lg navbar-light container home-nav">
    <a class="navbar-brand logo" href="#">
        <img src="{{url('/images/logo.png')}}" class="img-fluid" width="185px">
    </a>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="/clients/logout">Logout</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
    <section class="content paddingleft_right15">
        <div class="row panel-body mt-5"><br />

            <div class="col-md-8 panel-body">
                <h3 class="heading panel-body">
                    Order Details
                </h3>
            </div>
            <br />
            <div class="col-md-12">
                <table class="table table-striped table-bordered table-hover data-table" id="postTable">
                    <thead>
                        <tr>
                            <th>OrderID</th>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Country</th>
                            <th>Network</th>
                            <th>OrderDate</th>
                            <th>IMEI</th>
                            <!-- <th>Actions</th> -->
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orderDetails as $order)
                        <tr class="item{{$order->id}}">
                            <td>{{$order->order_id}}</td>
                            <td>{{$order->Manufacturer->manu_name}}</td>
                            <td>{{$order->Model->model_num}}</td>
                            <td>{{$order->Network->country_name}}</td>
                            <th>{{$order->Network->network_name}}</th>
                            <th>{{$order->order_dt_tm}}</th>
                            @if($order->imei_code !='')
                            <th>{{$order->imei_code}}</th>
                            @else
                            <td class="sorting_1">
                                <button class="edit-modal btn btn-info clsorder" data-id="{{$order->id}}" data-toggle="modal" data-target="#editmodal" data-prd="{{$order->Tool->is_sip}}" data-brand="{{$order->Manufacturer->manu_name}}" data-model="{{$order->Model->model_num}}" data-network="{{$order->Network->network_name}}" data-country="{{$order->Network->country_name}}" data-imei="{{$order->imei_code}}">Please Enter IMEI No.</button>
                            </td>
                            @endif
                            <td>{{$order->status}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </section>
</div>

<div id="editmodal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <label class="control-label col-sm-10" for="imei" id="imeiLabel" style="text-align:left">Title:</label>
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
            
                <form id="imei_form" class="form-horizontal" role="form" method="POST" action="{{ url('/dashboard/update') }}">
                    @csrf
                    <div class="form-group">
                        <div class="col-sm-12">
                            <!-- <label class="control-label col-sm-12" for="imei" id="imeiLabel" style="text-align:left">Title:</label> -->
                        </div>
                        <div class="alert alert-success " id="successimei">   
                        Successfully updated IMEI!
                        </div>
                        <div class="alert alert-success " id="processimei">   
                        IMEI Processing ....
                        </div>
                        <input type="hidden" class="form-control" id="order_id">
                        
                        <div class="col-sm-12">

                            <input type="text" name="imei_edit" class="form-control" id="imei_edit" autocomplete="off" maxlength="15" autofocus placeholder="Please Enter your 15 characters Mobile IMEI" style="border:1px solid #ccc; width:80%; margin:10px auto 0; height:48px; ">
                            <br/><p class="errorimei text-center alert alert-danger hidden" id="errorimei1"></p>
                                <div id="errorimei" role="alert"></div>
                            <input type="text" id="prd" name="prd" placeholder="Your PRD No*" autocomplete="off" pattern=".{5,}" title="Please enter prd" maxlength="20" class="form-control" style="border:1px solid #ccc; width:80%; margin:10px auto 0; height:48px; ">

                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <a><button type="button" class="btn btn-primary edit" >
                            <span class='glyphicon glyphicon-check'></span> Process my order
                        </button></a>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')


@if (session('success'))
<script type="text/javascript">
    swal({
        title: "Success!",
        text: "<?= session('success'); ?>",
        type: "success",
    });
</script>
@endif

<!-- jQuery -->
<!-- <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script> -->

<!-- Bootstrap JavaScript -->
<!-- <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.1/js/bootstrap.min.js"></script> -->

<!-- toastr notifications -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Delay table load until everything else is loaded -->



<!-- AJAX CRUD operations -->
<script type="text/javascript">
    // Edit a post
    $(document).on('click', '.edit-modal', function() {
        var lbl = "Please Enter your IMEI for Order " + $(this).data('id') + ' - ' + $(this).data('brand') + ' ' + $(this).data('country') + ' ' + $(this).data('network');
        $('#imeiLabel').html(lbl);

        $('.modal-title').text('');
        $('#imei_edit').val($(this).data('imei'));
        
        $('#order_id').val($(this).data('id'));
        imei = $('#imei_edit').val();
        id = $('#order_id').val();
        $('.errorimei').hide('hidden');
        $('.errorimei').text('');
        $('#successimei').hide();
        $('#processimei').hide();
        $('#editModal').modal('show');
    });

    $('.modal-footer').on('click', '.edit', function() {
        orderID = $('#order_id').val();
        orderIMEI = $('#imei_edit').val();



        if (orderIMEI.length == 0) {
            setTimeout(function() {
                $('#editModal').modal('show');
                toastr.error('Validation error!', 'Error Alert', {
                    timeOut: 5000
                });
            }, 500);

            $('.errorimei').show('hidden');
            $('.errorimei').text("Please fill 15 characters of your mobile IMEI No.");
        } else if (orderIMEI.length < 15) {
            setTimeout(function() {
                $('#editModal').modal('show');
                toastr.error('Validation error!', "Error Alert", {
                    timeOut: 5000
                });
            }, 500);
            $('.errorimei').show('hidden');
            $('.errorimei').text('IMEI required minimum 15 characters.');
        }
        $('#processimei').show();    
        $.ajax({
            type: 'POST',
            url: 'dashboard/update/' + id + '/' + orderIMEI,
            data: {

                'imei_code': $("#imei_edit").val(),
                'prd': $("#prd").val(),
            },

            success: function(data) {
                $('.errorimei').addClass('hidden');
                console.log(data);
                if ((data.errors)) {
                    setTimeout(function() {
                        $('#processimei').hide();
                        $('#editModal').modal('show');
                        toastr.error('Validation error!', 'Error Alert', {
                            timeOut: 5000
                        });
                    }, 500);

                    if (data.errors.imei) {
                        $('.errorimei').removeClass('hidden');
                        $('.errorimei').text(data.errors.imei);
                    }
                } else {
                    $('#processimei').hide();
                    $('#successimei').show();
                    toastr.success('Successfully updated IMEI!', 'Success Alert', {
                        timeOut: 5000
                    });
                    setTimeout(function() {
                    window.location.reload();
                    },2000); 
                }
            }
        });


    });
    // for prd show and hide
    $(document).ready(function() {
        $(".clsorder").click(function() {
            var prd = $(this).data('prd');
            // alert(prd);
            if (prd == 1) {
                $("#prd").show();
                $("#prd").prop('required', true);
            } else {
                $("#prd").hide();
                $("#prd").prop('required', false);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
   // $(window).load(function() {
        $('#postTable').removeAttr('style');
    }) 
</script>

<script type="text/javascript">
    $(document).ready(function() {
        /*$('#imei_number').popover({ 
            html : true,
            placement: 'bottom',
            container: 'body',
            trigger: 'focus',
            content: function() {
              return "<p>To find your IMEI (serial number), type <span style=\"font-size:18px\">*#06#</span> on the phone keyboard.<br> <span style=\"color: #CC0000; font-weight: bold; font-size:11px;\">Please enter the 15 digits, without any other character.</span></p><p>You can also find the IMEI on the sticker located under the battery, and on the original box :</p><p align=\"center\"><img width=\"200\" height=\"155\" style=\"border: 1px solid #333333;\" title=\"IMEI for Phone Unlock Code\" alt=\"IMEI for Phone Unlock Code\" src=\"/img/imei-for-phone-unlock-code.jpg\"></p><p>However, we suggest you use the <b>*#06#</b> method in case the phone has been repacked.</p>";
            }
          }); */
        $('#imeiover').popover({
            html: true,
            placement: 'left',
            container: 'body',
            trigger: 'focus',
            content: function() {
                return "<p>The IMEI code is a 15 to 17 degit number unique to your phone which you can obtain by typing *#06# .</p><p>Simple type the first 15 numbers into the request form, ignoring all other characters such as letters, dashes, hyphens etc. </p><p>If your IMEI code is longer than 15 degit, just insert first 15. </p><p>CAUTION! Make sure you enter the IMEI number as displayed your phone and not on the box or packaging.</p>";
            }
        });
        $('#imei_edit').popover({
            html: true,
            placement: 'left',
            container: 'body',
            content: function() {
                return "<p>To find your IMEI (serial number), type <span style=\"font-size:18px\">*#06#</span> on the phone keyboard.<br> <span style=\"color: #CC0000; font-weight: bold; font-size:11px;\">Please enter the 15 digits, without any other character.</span></p><p>You can also find the IMEI on the sticker located under the battery, and on the original box :</p><p align=\"center\"><img width=\"200\" height=\"155\" style=\"border: 1px solid #333333;\" title=\"IMEI for Phone Unlock Code\" alt=\"IMEI for Phone Unlock Code\" src=\"/images/imei-for-phone-unlock-code.jpg\"></p><p>However, we suggest you use the <b>*#06#</b> method in case the phone has been repacked.</p>";
            }
        });

        $('#prd').popover({
            html: true,
            placement: 'left',
            container: 'body',
            trigger: 'focus',
            content: function() {
                return "<p>To find your Provider ID<p align=\"center\"><img width=\"200\" height=\"155\" style=\"border: 1px solid #333333;\" title=\"IMEI for Phone Unlock Code\" alt=\"IMEI for Phone Unlock Code\" src=\"/images/srd.jpg\"></p>";
            }
        });
        $('#email').popover({
            html: true,
            placement: 'bottom',
            container: 'body',
            trigger: 'focus',
            content: function() {
                return "<p>Please make sure to enter a valid email address as this is where your unlock codes or confirmation will be sent upon completion of your order.</p>";
            }
        });
    });
</script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@endsection