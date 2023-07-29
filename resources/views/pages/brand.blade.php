<?php // echo '<pre>'; print_r($modals->toArray()); exit;
//echo strtolower($brandName); exit;
$models = array(); 
?>
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
  "name": "Unlock {{$brandName}}",
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
  div#brand-errors,
  #model-errors {
    padding: 6px 0;
    color: #fa755a;
    font-weight: 600;
  }
</style>
<link rel="stylesheet" type="text/css" href="{{asset('/css/brand.css')}}" />
<!-- <link rel="stylesheet" href="{{asset('css/global.min.css')}}"> -->
{!! !empty($asset_header->content) ? $asset_header->content:''!!}  

@endsection

@section('content')

@include('layouts.header')


<section class="countyr-banner-sec brand-banner">


<div class="container">
  <div class="col-xs-12">
    <nav aria-label="breadcrumb" class="main-breadcrumb-wrapper">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{url('/')}}">Unlock Cellphone</a>
        </li>
        <li class="breadcrumb-item">
          <?php
          $brnd = str_replace("-", "~", $brandName);
          $brnd = str_replace(" ", "-", $brnd);
          ?>
          <a>{{$brandName}}</a>
        </li>
      </ol>
    </nav>
  </div>
</div>

<div class="container ">
<div class="form-box-white">
    
<section class="container section1-model">
  <div class="row contryNetwork">
    <div class="col-md-3 col-sm-4 col-3 text-center">
      <span class="brand-img">
        <img src="/images/banners/thumb/{{$bnr_image}}">
      </span>
    </div>
    <div class="col-md-9 col-sm-8 col-9 brand-des">
      <a name="id3"></a>
      {!! $content_ht['heading_title'] !!}
      <p class="" style="margin-bottom: 0px;">
        <strong>Important</strong> - Select the Current Network your Unlock {{ucfirst(trans($brandName))}} is Locked to. Do NOT select the network you want to use.
      </p>
    </div>
  </div>
</section>

<div class="form-network model-form">
  <div class="container">
    <div id="model-form" class="row contryNetwork">
      <form id="brand_form" name="" method="GET" class="green-form" action="{{ url('/') }}">
        @csrf
        <div class="row search-box" data-spy="affix" data-offset-top="450">
          <div class="col-md-6 col-sm-12 col-12 " style="position:relative">
            <!-- <input type="hidden" name="data[Page][brand_text]" id="brand_text" value=""> -->
            <div class="selectize-control selectpicker single">
              <div class="remove-down-arrow items not-full disabled locked fillmodel" style="position: relative;">
                <!-- <input type="text" autocomplete="off" tabindex="" id="brandid-selectized" placeholder=" Select Brand "> -->
                <div id="loader" style="display:none; position: absolute; text-align: center; z-index: 9999; right: 0; left: 0; margin: 0 auto; top: 10px;" class="dpnone img"><img src="/images/indicator.gif" /></div>
                <select id="model_id" onclick="getmodel();" class="selectpicker" itemprop="name" data-live-search="true" data-live-search-placeholder="Type Model Name" name="model_id">
                  <option value="">Select Model</option>
                </select>
                <div class="form-group" id="model-errors" role="alert"></div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-12 col-12" style="position:relative">
            <button type="button" id="submit_form" class="blue-btn  btn-block "> Unlock Now</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

</div>
</div>
</section>

<section class="heart-sec" role="Person" itemscope itemtype="https://schema.org/Person" style="padding-top: 15px;">
  <div class="container">
    <h2>
      <img itemprop="image" src="https://www.demoninja.com/images/svg/heart.svg" alt="" class="svg" />
      <span itemprop="name">More than
        <small>50,000</small> satisfied customers
      </span>
    </h2>
  </div>
</section>

<section>
  <div class="container text-center">
    <div class="video-box1-model">
      <!-- <a href="https://www.youtube.com/watch?v=esAwWpdihA8&feature=emb_title" class="" target="_blank">
        <img src="images/video.png" class="img-fluid">
      </a> -->
      <a href="javascript:void(0)" data-toggle="modal" data-target="#video-onload" id="video-page-box">
        <img src="images/video.png" class="img-fluid">
      </a>
    </div>
  </div>
</section>

<section class="imei-details">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div id="home" class="tab-content">
          {!!$content_desc['description']!!}
        </div>
      </div>

      <div class="col-md-3 col-sm-4 col-xs-12">
        <div class="side-panel-brands" itemprop="Popular Brand" itemscope="" itemtype="https://schema.org/PopularBrands">
          <h2>Top Brands</h2>
          <div class="top-brands side-panel">
            <a href="/unlock-htc+phone" class="item" itemprop="Phone Brand" itemscope="" itemtype="https://schema.org/Brands">
              <div class="img-container" itemscope="" itemtype="https://schema.org/BrandImage">
                <img src="/images/brand/htc.png" data-src="/images/brand/htc.png" title="HTC" alt="HTC">
              </div>
              <div class="item-name" itemprop="name">HTC Unlock</div>
            </a>
            <a href="/unlock-apple+phone" class="item" itemprop="Phone Brand" itemscope="" itemtype="https://schema.org/Brands">
              <div class="img-container" itemscope="" itemtype="https://schema.org/BrandImage">
                <img src="/images/brand/apple.png" data-src="/images/brand/apple.png" title="Apple" alt="Apple">
              </div>
              <div class="item-name" itemprop="name">Apple Unlock</div>
            </a>
            <a href="/unlock-lg+phone" class="item" itemprop="Phone Brand" itemscope="" itemtype="https://schema.org/Brands">
              <div class="img-container" itemscope="" itemtype="https://schema.org/BrandImage">
                <img src="/images/brand/lg.png" data-src="/images/brand/lg.png" title="LG" alt="LG">
              </div>
              <div class="item-name" itemprop="name">LG Unlock</div>
            </a>
            <a href="/unlock-motorola+phone" class="item" itemprop="Phone Brand" itemscope="" itemtype="https://schema.org/Brands">
              <div class="img-container" itemscope="" itemtype="https://schema.org/BrandImage">
                <img src="/images/brand/motorola.png" data-src="/images/brand/motorola.png" title="Motorola" alt="Motorola">
              </div>
              <div class="item-name" itemprop="name">Motorola Unlock</div>
            </a>
            <a href="/unlock-samsung+phone" class="item" itemprop="Phone Brand" itemscope="" itemtype="https://schema.org/Brands">
              <div class="img-container" itemscope="" itemtype="https://schema.org/BrandImage">
                <img src="/images/brand/samsung.png" data-src="/images/brand/samsung.png" title="Samsung" alt="Samsung">
              </div>
              <div class="item-name" itemprop="name">Samsung Unlock</div>
            </a>
            <a href="/unlock-zte+phone" class="item" itemprop="Phone Brand" itemscope="" itemtype="https://schema.org/Brands">
              <div class="img-container" itemscope="" itemtype="https://schema.org/BrandImage">
                <img src="/images/brand/zte.png" data-src="/images/brand/zte.png" title="ZTE" alt="ZTE">
              </div>
              <div class="item-name" itemprop="name">ZTE Unlock</div>
            </a>
            <a href="/unlock-huawei+phone" class="item" itemprop="Phone Brand" itemscope="" itemtype="https://schema.org/Brands">
              <div class="img-container" itemscope="" itemtype="https://schema.org/BrandImage">
                <img src="/images/brand/huawei.png" data-src="/images/brand/huawei.png" title="Huawei" alt="Huawei">
              </div>
              <div class="item-name" itemprop="name">Huawei Unlock</div>
            </a>
            <a href="/unlock-sony+phone" class="item" itemprop="Phone Brand" itemscope="" itemtype="https://schema.org/Brands">
              <div class="img-container" itemscope="" itemtype="https://schema.org/BrandImage">
                <img src="/images/brand/sony.png" data-src="/images/brand/sony.png" title="Sony" alt="Sony">
              </div>
              <div class="item-name" itemprop="name">Sony Unlock</div>
            </a>
            <a href="/unlock-alcatel+phone" class="item" itemprop="Phone Brand" itemscope="" itemtype="https://schema.org/Brands">
              <div class="img-container" itemscope="" itemtype="https://schema.org/BrandImage">
                <img src="/images/brand/alcatel.png" data-src="/images/brand/alcatel.png" title="Alcatel" alt="Alcatel">
              </div>
              <div class="item-name" itemprop="name">Alcatel Unlock</div>
            </a>
            <a href="/unlock-nokia+phone" class="item" itemprop="Phone Brand" itemscope="" itemtype="https://schema.org/Brands">
              <div class="img-container" itemscope="" itemtype="https://schema.org/BrandImage">
                <img src="/images/brand/nokia.png" data-src="/images/brand/nokia.png" title="Nokia" alt="Nokia">
              </div>
              <div class="item-name" itemprop="name">Nokia Unlock</div>
            </a>
          </div>
        </div>
      </div>

      <div class="col-md-8 as-sec">
        <h3 class="mt-2 mb-2">Important Links</h3>
        {!!$backtracklinks['backtracklinks']!!}
      </div>
    </div>
  </div>
  <br />

  <!-- Modal -->
<div class="modal fade" id="video-onload" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content" id="video-content">
      
    </div>
  </div>
</div>

  @include('layouts.footer')
  @endsection

  @section('footer')
  <!-- <script src="{{asset('assets/vendors/select2/js/select2.js')}}" type="text/javascript"></script> -->

  {!! !empty($asset_footer->content) ? $asset_footer->content:''!!}  

  <script type='text/javascript'>

    function getmodel() {
    //alert('hello');
    // var brandID = $(this).val();

   // var errBrand = document.getElementById('brand-errors');
    //errBrand.textContent = '';

    //var e = document.getElementById("brand_id"),
    //  t = e.options[e.selectedIndex].value;
    var t = '<?php echo $brandID; ?>';  
    var txt = '<?php echo strtolower($brandName); ?>';
    //alert(t)
    $("#loader").show();
   // document.getElementById("brand_text").value = e.options[e.selectedIndex].text,
    txt = txt, $("#loader").show(),  $.ajax({
      url: "getModelAjax/" + t,
      type: "get",
      async: !0,
      cache: !0,
      data: "id=" + t,
      success: function(e) {
        $(".fillmodel").html(e),
          $("#loader").hide(),
          $(".fillmodel").show(),
          $("#model_id").selectize("refresh") /*$('#modelid').selectize({maxOptions: 9000})*/
          $('.selectize-input').trigger('click');
          
      }
    })
  }

  $(document).on('click touchstart', '.selectize-input' ,function(){
    $('#model_id').trigger('click');
  });

  /*$(document.body).on('click', '.selectize-control' ,function(){
    $('#model_id').trigger('click');
  });*/
  /*$(document.body).on('click', '#model_id' ,function(){
    $('.selectize-input').trigger('click');
  }); */
    $(document).ready(function() {
    /*  if ( $.browser.webkit ) {
        alert( "This is WebKit!" );
    } */


    if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
      var t = '<?php echo $brandID; ?>';  
      var txt = '<?php echo strtolower($brandName); ?>';
      //alert(t)
      $("#loader").show();
     // document.getElementById("brand_text").value = e.options[e.selectedIndex].text,
      txt = txt, $("#loader").show(),  $.ajax({
        url: "getModelAjax/" + t,
        type: "get",
        async: !0,
        cache: !0,
        data: "id=" + t,
        success: function(e) {
          $(".fillmodel").html(e),
            $("#loader").hide(),
            $(".fillmodel").show(),
            $("#model_id").selectize("refresh") /*$('#modelid').selectize({maxOptions: 9000})*/
            
            
        }
      })
    }

     /* $('#model_id').change(function() { 
          $('#model_id').trigger('click');
        }); */
      //$('#model_id').selectize();
      //$('body').on('click', '.selectize-input', function() {
      //$('.selectize-input').click(function () {
      //  $('#model_id').trigger('click');
        //alert('hello');
        //$("#list").show();
      //});
      //$('body').on('click', '#model_id', function() {
      // $('.selectize-input').click(function () {
       // $('#model_id').trigger('click');
        //alert('hello');
        //$("#list").show();
      //});
//model_id
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {

      $('#submit_form').click(function(event) {
        var strBrand = '<?php echo strtolower($brandName); ?>';

        var modelID = $('#model_id option:selected').text();
        var model=$('#model_id option:selected').val();
        var errModel = document.getElementById('model-errors');

        // errModel.textContent = '';
          event.preventDefault();
          $('#model_id').change(function() {
          $('#model-errors').remove();
        })
        if (model.length == 0) {
          errModel.textContent = 'Select Model';
        } else {
          var strModel = modelID.replace('-', "~");
          var strModel = strModel.replace(/ /g, "-");
          var strModel = strModel.toLowerCase();
          var url = '/unlock-' + strBrand + '+' + strModel;
          window.location.href = url;
        }
      });
    });
  </script> 
  <script type="text/javascript">
    $("#video-page-box").click(function () {
      $("#video-content").html('<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button><iframe height="400px" width="100%;" src="https://www.youtube.com/embed/esAwWpdihA8" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>');
    });
  </script>
  @endsection