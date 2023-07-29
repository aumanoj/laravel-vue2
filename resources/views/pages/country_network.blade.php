@extends('layouts/unlock')



@section('head')

<title>{{$content_mt['meta_title']}}</title>
<meta name="description" content="<?php echo $content_dsc['meta_desc'] ?>" />
<meta name="keywords" content="<?php echo $content_mk['meta_keyword'] ?>" />

<meta property="og:title" content="demoninja - {{$content_mt['meta_title']}}">
<meta property="og:site_name" content="demoninja">
<meta property="og:url" content="<?php echo url()->full(); ?>">
<meta property="og:description" content="<?php echo $content_dsc['meta_desc'] ?>">
<meta property="og:type" content="website">
<meta property="og:image" content="https://www.demoninja.com/images/banners/thumb/{{$bnr_image}}">

<script type="application/ld+json">
{
  "@context": "https://schema.org/", 
  "@type": "Product", 
  "name": "Unlock {{$brands}} {{$models}}",
  "image": "https://www.demoninja.com/images/banners/thumb/{{$bnr_image}}",
  "description": "<?php echo $content_dsc['meta_desc'] ?>",
  "brand": "demoninja",
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.8",
    "ratingCount": "108900"
  }
}
</script>

<link rel="canonical" href="<?php echo url()->full(); ?>" />

<style>
  .countyr-banner-sec{background-color: #0640a1;max-height: 400px;background-image: url(../images/home-banner.jpg);margin-bottom: 200px}article, aside, figcaption, figure, footer, header, hgroup, main, nav, section{display: block}.form-box-white{background-color: #fff;margin-top: 40px;box-shadow: 3px 3px 8px 2px #00000038;border-radius: 10px;z-index: 999;position: relative;}.row{display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-right: -15px;margin-left: -15px}.contryNetwork{padding: 10px 120px}.row{display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-right: -15px;margin-left: -15px}.contryNetwork{padding: 0px 120px}.contryNetwork{padding: 0 120px}.brand-img{border-right: solid 1px #eee;display: block;text-align: right;padding: 15px 25px;text-align: center}.brand-img img{width: 100px}.video-box1{margin-top: 50px;margin: 0 auto;position: relative;z-index: 1;padding-left: 0;margin-bottom: -160px}.video-box1 img{max-width: 100%; min-height: 440px;}.heart-sec{padding: 50px 0;width: 100%;float: left;background: #f7f7f7;position: relative;z-index: 0}.heart-sec2{padding: 200px 0 50px!important}.heart-sec{padding: 50px 0;width: 100%;background: #f7f7f7;position: relative;z-index: 0}.heart-sec{padding: 50px 0 70px}.heart-sec2{padding: 200px 0 50px !important}
  div#email-errors,#network-errors,#country-errors {
    padding: 6px 0;
    color: #fa755a;
    font-weight: 600;
    }

  .img {
    position: absolute;
    left: 145px;
    top: 30px;
    z-index: 2;
    }

</style>

<link rel="stylesheet" type="text/css" href="{{asset('/css/brand.css')}}" />

{!! !empty($asset_header->content) ? $asset_header->content:''!!}  

@endsection

@section('content')
@include('layouts.header')

<section class="countyr-banner-sec">

<div class="container">
  <div class="col-xs-12">
    <nav aria-label="breadcrumb" class="main-breadcrumb-wrapper">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{url('/')}}">Unlock Cellphone</a>
        </li>
        <li class="breadcrumb-item">
          <?php
          $brnd = str_replace("-", "~", $brands);
          $brnd = str_replace(" ", "-", $brnd);
          ?>
          <a href="{{url('/unlock-'.$brnd.'+phone')}}">{{$brands}}</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">{{$models}}</li>
      </ol>
    </nav>
  </div>
</div>

<div class="container">
<div class="form-box-white">
    
<section class="container section1-model">
  <div class="row contryNetwork">
    <div class="col-md-3 col-sm-4 col-3 text-center">
      <span class="brand-img">
        <img src="/images/banners/thumb/{{$bnr_image}}">
      </span>
    </div>
    <div class="col-md-9 col-sm-8 col-9 brand-des">
      <a name="id3" >
      {!! $content['heading_title'] !!}
      <p class="mb60" style="margin-bottom: -5px;">
        <strong>Important</strong> - Select the Current Network your Unlock {{ucfirst(trans($brands))}} is Locked to. Do NOT select the network you want to use.
      </p>
    </div>
  </div>
</section>


<div class="form-network model-form">
  <div class="container">
    <div id="model-form" class="row contryNetwork">
      <form id="country_form" name="" method="POST" class="green-form" action="{{ url('/order') }}">
        @csrf
        <input type="hidden" id='brand' name='brand' value="{{$brands}}">
        <input type="hidden" id="model" name='model' value="{{$models}}">
        <div class="row search-box" data-spy="affix" data-offset-top="450">
          <div class="col-md-4 col-sm-12 col-12" style="position:relative">
            <span class="mark">1</span>
            <input type="hidden" name="data[Page][country_text]" id="country_text" value="">
            <div class="selectize-control selectpicker single ">
                <div class="remove-down-arrow items not-full has-options fillcountry"  style="position:relative">
                <!-- <label >{{$countryID}}</label> -->
                <!-- <input type="text" autocomplete="off" tabindex="" id="brandid-selectized" placeholder=" Select Brand "> -->
                <div id="loader" style="display:none; position: absolute; text-align: center; z-index: 9999; right: 0; left: 0; margin: 0 auto; top: 10px;" class="dpnone img"><img src="/images/indicator.gif" /></div>
            <select id="country_id" onclick="getcountry();" name="country_id" class="selectpicker clknet" itemprop="name" data-live-search="true" data-live-search-placeholder="" >
                  <option value="146">USA (United States)</option>
                </select>
                <div class="form-group" id="country-errors" role="alert"></div>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-12 col-12 notranslate" id="mod" style="position:relative">
            <span class="mark1 mt-4">2</span>
            <div id="loaderr" style="display:none; position: absolute; text-align: center; z-index: 9999; right: 0; left: 0; margin: 0 auto; top: 10px;" class="dpnone img"><img src="/images/indicator.gif" /></div>
            <span id="modx">
              <div class="selectize-control selectpicker single ">
                <div class="remove-down-arrow items not-full disabled locked fillmodel ">
                  <!-- <input type="text" autocomplete="off" tabindex="-1" id="modelid-selectized" placeholder="Select Model" disabled="" style="width: 105.062px;"> -->
                  <select  id="network_id" name="network_id" onclick="getNetworkk();" class="selectpicker clknetwork" itemprop="name" data-live-search="true" data-live-search-placeholder="" >
                    <option  value=""> Select Network </option>
                  </select>
                  <div class="form-group" id="network-errors" role="alert"></div>
                </div>
              </div>
            </span>
            <!-- <span class="error_m" id="selmodel"> &nbsp; &nbsp; Select Model</span> -->
          </div>
          <div class="col-md-4 col-sm-12 col-12 notranslate" id="mod" style="position:relative">
            <span class="mark2">3</span>
            <span id="modx">
              <div class="selectize-control selectpicker single">
                <div class="items not-full has-options">
                  <input class="form-control" type="text" autocomplete="none" name="email" id="email" value="{{old('email')}}" placeholder="Your Email">
                  <span class="why-text" type="button" data-toggle="tooltip" data-placement="top" title="We send unlocking code and updates to you by email. Please provide a valid email id that you access most often.">why e-mail</span>
                  <div class="form-group" id="email-errors" role="alert"></div>
                </div>
              </div>
            </span>
            <!-- <span class="error_m" id="selmodel"> &nbsp; &nbsp; Select Model</span> -->
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12"></div>
          <div class="col-md-4 col-sm-4 col-xs-12" style="position:relative">
            <button type="button" id="submit_form" class="blue-btn btn-block model-bt"> Unlock {{ucfirst(trans($models))}}</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

</div>   
</div>

</section>

<div class="container text-center">
  <!-- <div class="ad-google text-center">
  </div> -->
  
  <div class="video-box1">
    <!-- <a href="https://www.youtube.com/watch?v=esAwWpdihA8&amp;feature=emb_title" target="_blank"> -->
    <a href="javascript:void(0)" data-toggle="modal" data-target="#video-onload" id="video-page-box">
      <img src="images/video.png">
    </a>
  </div>
</div>



<section class="heart-sec heart-sec2" style="z-index: 0 !important;">
  <div class="container plr50">
    <div class="row">
      <div class="col-md-4 col-sm-4 ">
        <div class="main-box" itemscope itemtype="http://schema.org/WebPageElement">
          <div class="img-sec">
            <span class="red">
              <img itemprop="image" src="images/svg/balance.svg" alt="Phone unlocking services for all brands with 100% legal and safe for phone" class="svg" style="height:40px; width:auto;" />
            </span>
          </div>
          <div class="heading-text" itemprop="name">100% Legal</div>
          <p>We work with your phone manufacturer or network to generate unlock code.</p>
        </div>
      </div>
      <div class="col-md-4 col-sm-4 ">
        <div class="main-box" itemscope itemtype="http://schema.org/WebPageElement">
          <div class="img-sec">
            <span class="yellow">
              <img itemprop="image" src="images/svg/safety-box.svg" alt="Permanent Phone unlock code with safe and secure process" class="svg" style="height:80px; width:auto;" />
            </span>
          </div>
          <div class="heading-text" itemprop="name">Safe for phone</div>
          <p>No shady software to be installed, no jail breaking, no sim cover. Plain <u>simple unlock code</u>.</p>
        </div>
      </div>
      <div class="col-md-4 col-sm-4 ">
        <div class="main-box" itemscope itemtype="http://schema.org/WebPageElement">
          <div class="img-sec">
            <span class="green">
              <img itemprop="image" src="images/svg/padlock.svg" alt="Phone unlocking services provider with strong SSL safety" class="svg" style="height:40px; width:auto;" />
            </span>
          </div>
          <div class="heading-text" itemprop="name">SSL Secured</div>
          <p>Our site uses strong SSL encryption so all transactions are secured.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="clearfix"></div>
<section class="imei-details">
  <div class="container">
    <div class="">
      <div id="home" class="tab-content">
      {!!$content_desc['description']!!}
      </div>
    </div>
  </div>
  <br />

<!-- Modal -->
<div class="modal fade" id="video-onload" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content" id="video-content">
    <div id="loader" style="positon: absolute; right: 0; left: 0; bottom: 0; margin: auto; z-index:9999;" class="dpnone img"><img src="/images/indicator.gif" /></div>
  </div>
  </div>
</div>
  @include('layouts.footer')

  @endsection

  @section('footer')

  {!! $asset_footer['content'] !!}
  <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
  <!-- <script src="{{asset('assets/vendors/select2/js/select2.js')}}" type="text/javascript"></script> -->
  <script type='text/javascript'>
    $(document).ready(function() {
     //$('#country_id').selectize();
     //$('#network_id').selectize();

      // $('#country_id').change(function() {
      //   var countryID = $(this).val();
      //   $("#loader").show();
      //   $('#network_id').find('option').not(':first').remove();

      //   $.ajax({
      //     url: 'getNetworkAjax/' + countryID,
      //     type: 'GET',
      //     dataType: 'HTML',
      //     success: function(data) {
      //       console.log(data);
      //       $("#network_id").html(data);
      //       $("#loader").hide();
      //     }
      //   });
      // });
    });

</script>
<script>

    function getcountry() {
      //alert('hello');
      // var brandID = $(this).val();

     // var errBrand = document.getElementById('brand-errors');
      //errBrand.textContent = '';

      //var e = document.getElementById("brand_id"),
      //  t = e.options[e.selectedIndex].value;
      var t = '';  
      
      //alert(t)
      $("#loader").show();
     // document.getElementById("brand_text").value = e.options[e.selectedIndex].text,
      $("#loader").show(),  $.ajax({
        url: "getCountryAjax",
        type: "get",
        async: !0,
        cache: !0,
        data: "id=" + t,
        success: function(e) {
          $(".fillcountry").html(e),
            $("#loader").hide(),
            $(".fillcountry").show(),
            $("#country_id").selectize("refresh") /*$('#modelid').selectize({maxOptions: 9000})*/
            $('.fillcountry').find( ".selectize-control" ).find( ".selectize-input" ).trigger('click');
            
        }
      })
    }

    if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
        var t = '';  
      
        //alert(t)
        $("#loader").show();
       // document.getElementById("brand_text").value = e.options[e.selectedIndex].text,
        $("#loader").show(),  $.ajax({
          url: "getCountryAjax",
          type: "get",
          async: !0,
          cache: !0,
          data: "id=" + t,
          success: function(e) {
            $(".fillcountry").html(e),
              $("#loader").hide(),
              $(".fillcountry").show(),
              $("#country_id").selectize("refresh") /*$('#modelid').selectize({maxOptions: 9000})*/
              
              
          }
        })

    }


    function getNetwork() {

    var e = document.getElementById("country_id"),
        t = e.options[e.selectedIndex].value;
        $("#loaderr").show();
    document.getElementById("country_text").value = e.options[e.selectedIndex].text, /*$("#loadingDiv").show(), */ $.ajax({
        url: "getNetworkAjax/" + t,
        type: "get",
        async: !0,
        cache: !0,
        data: "id=" + t,
        success: function(e) {
           $(".fillmodel").html(e), 
           $("#loaderr").hide(),
           $(".fillmodel").show(),
            $("#network_id").selectize("refresh") /*$('#modelid').selectize({maxOptions: 9000})*/
        }
    })
}


    function getNetworkk() {

        var e = document.getElementById("country_id"),
            t = e.options[e.selectedIndex].value;
            $("#loaderr").show();
        document.getElementById("country_text").value = e.options[e.selectedIndex].text, /*$("#loadingDiv").show(), */ $.ajax({
            url: "getNetworkAjax/" + t,
            type: "get",
            async: !0,
            cache: !0,
            data: "id=" + t,
            success: function(e) {
               $(".fillmodel").html(e), 
               $("#loaderr").hide(),
               $(".fillmodel").show(),
                $("#network_id").selectize("refresh") /*$('#modelid').selectize({maxOptions: 9000})*/
                $('.fillmodel').find( ".selectize-control" ).find( ".selectize-input" ).trigger('click');
            }
        })
    }

    $(document).ready(function() {

      $('.fillcountry .selectize-control .selectize-input').click(function () {
        $('.clknet').trigger('click');
        //alert('hello');
        //$("#list").show();
      });
      $('.fillmodel .selectize-control .selectize-input').click(function () {
        $('.clknetwork').trigger('click');
        //alert('hello');
        //$("#list").show();
      });

      $('#submit_form').click(function() {
        var brand = $('#brand').val();
        var model = $('#model').val();
        var country = $('#country_id').val();
        var network = $('#network_id').val();
        var email = $('#email').val();
        var form = document.getElementById('country_form')
        var chkEmail = /^[A-Z0-9\._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        var errNetwork = document.getElementById('network-errors');
        var errEmail = document.getElementById('email-errors');

        //errNetwork.textContent = '';
        errEmail.textContent = '';
        event.preventDefault();

        $('#network_id').change(function() {
        $('#network-errors').remove();
      })

        if (!network) {
          errNetwork.textContent = "Please Select the country/network provider the phone is currently locked to";
        } else if (!email) {
          errEmail.textContent = 'Please enter a valid email address, your unlock codes will be sent there.';
        } else if (!chkEmail.test(email)) {
          errEmail.textContent = 'Please enter a valid email address, your unlock codes will be sent there.';
        } else {
          form.submit();
        }
      });
    })
  </script>

  

  <script type="text/javascript">
    jQuery('img.svg').each(function() {
      var $img = jQuery(this);
      var imgID = $img.attr('id');
      var imgClass = $img.attr('class');
      var imgURL = $img.attr('src');

      jQuery.get(imgURL, function(data) {
        // Get the SVG tag, ignore the rest
        var $svg = jQuery(data).find('svg');

        // Add replaced image's ID to the new SVG
        if (typeof imgID !== 'undefined') {
          $svg = $svg.attr('id', imgID);
        }
        // Add replaced image's classes to the new SVG
        if (typeof imgClass !== 'undefined') {
          $svg = $svg.attr('class', imgClass + ' replaced-svg');
        }

        // Remove any invalid XML tags as per http://validator.w3.org
        $svg = $svg.removeAttr('xmlns:a');

        // Replace image with new SVG
        $img.replaceWith($svg);

      }, 'xml');

    });
  </script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
<script type="text/javascript">
    $("#video-page-box").click(function () {
      $("#video-content").html('<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button><iframe height="400px" width="100%;" src="https://www.youtube.com/embed/esAwWpdihA8" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>');
    });
  </script>



  @endsection