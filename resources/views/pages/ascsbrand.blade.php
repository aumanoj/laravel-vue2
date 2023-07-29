<?php // echo '<pre>'; print_r($modals->toArray()); exit; 
?>
@extends('layouts/unlock')

@section('title')
{!! $content_mt['meta_title'] !!}
@endsection
@section('head')
<style>
  div#brand-errors,
  #model-errors {
    padding: 6px 0;
    color: #fa755a;
    font-weight: 600;
  }

  
</style>
<!-- <link rel="stylesheet" href="{{asset('css/global.min.css')}}"> -->
@endsection

@section('content')
@include('layouts.header')

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
          <a >{{ucfirst(trans($brandName))}}</a>
        </li>
      </ol>
    </nav>
  </div>
</div>

<section class="container section1-model">
  <div class="row contryNetwork">
    <div class="col-md-3 col-sm-4 col-3 text-center">
      <span class="brand-img">
        <img src="">
      </span>
    </div>
    <div class="col-md-9 col-sm-8 col-9 brand-des">
      <a name="id3" ></a>
      {!! $content_ht['heading_title'] !!}
      <p class="mb60">
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
          <div class="col-md-6 col-sm-6 col-xs-12 " style="position:relative">
            <!-- <input type="hidden" name="data[Page][brand_text]" id="brand_text" value=""> -->
            <div class="selectize-control selectpicker single">
              <div class="items not-full disabled locked fillmodel">
                <!-- <input type="text" autocomplete="off" tabindex="" id="brandid-selectized" placeholder=" Select Brand "> -->
                <select  id="model_id"  class="selectpicker" itemprop="name" data-live-search="true" data-live-search-placeholder="Type Model Name" name="model_id" >
                  <option value=''>Select Model</option>
                  @foreach($models as $model)
                  <option value="{{$model->model_id}}">{{$model->model_num}}</option>
                  @endforeach
                </select>
                <div class="form-group" id="model-errors" role="alert"></div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12 mt-3" style="position:relative">
            <button type="button" id="submit_form" class="blue-btn  btn-block " > Unlock Now</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<section class="heart-sec" role="Person" itemscope itemtype="https://schema.org/Person" style="padding-top: 15px;">
  <div class="container">
    <h2>
      <img itemprop="image" src="https://www.unlockninja.com/images/svg/heart.svg" alt="" class="svg" />
      <span itemprop="name">More than
        <small>50,000</small> satisfied customers
      </span>
    </h2>
  </div>
</section>

<section>
  <div class="container text-center">
    <div class="video-box1-model">
      <a href="https://www.youtube.com/watch?v=esAwWpdihA8&feature=emb_title" class="" target="_blank">
        <img src="images/video.png" class="img-fluid">
      </a>
    </div>
  </div>
</section>

<section class="imei-details">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        {!!$content_desc['description']!!}
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
    </div>
  </div>
  <br />
  @include('layouts.footer')
  @endsection

  @section('footer')
  <script src="{{asset('assets/vendors/select2/js/select2.js')}}" type="text/javascript"></script>
  <script type='text/javascript'>
    $(document).ready(function() {
      $(' #model_id').selectize();
      
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {

      $('#submit_form').click(function(event) {
        var strBrand = '<?php echo strtolower($brandName); ?>';
        
        var modelID = $('#model_id option:selected').text();
        var errModel = document.getElementById('model-errors');

        //errModel.textContent = '';
      //   event.preventDefault();
      //   $('#model_id').change(function() {
      //   $('#model-errors').remove();
      // })
        if (modelID.length == 0) {
          //errModel.textContent = 'Select Model';
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
  @endsection