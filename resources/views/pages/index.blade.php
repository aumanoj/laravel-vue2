@extends('layouts/unlock')

@section('head')
<title>Phone Unlock codes for iPhone 6, Samsung, ZTE, LG | demoninja</title>
<meta name="description" content="Need Phone Unlock codes? Get unlock code for iPhone 6, ZTE, Samsung, LG & all Brands. 
Learn How to unlock an iPhone 6 by a leading phone unlocking service provider." />
<meta name="keywords" content="Phone Unlock codes, How to unlock a phone, unlock code for iPhone 6, How to unlock iPhone 6, unlocking iPhone 6, How to unlock iPhone 6 at&t, How to unlock iPhone 6 t-mobile" />

<meta property="og:title" content="demoninja">
<meta property="og:site_name" content="demoninja">
<meta property="og:url" content="https://www.demoninja.com/">
<meta property="og:description" content="Need Phone Unlock codes? Get unlock code for iPhone 6, ZTE, Samsung, LG & all Brands. Learn How to unlock an iPhone 6 by a leading phone unlocking service provider.">
<meta property="og:type" content="website">
<meta property="og:image" content="https://www.demoninja.com/images/logo.png">

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "demoninja",
  "url": "https://www.demoninja.com/",
  "logo": "https://www.demoninja.com/images/logo.png"
}
</script>

   
<link rel="canonical" href="https://www.demoninja.com/" />
<!-- Latest compiled and minified CSS -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
<!-- CSS -->
<!-- <link rel="stylesheet" href="https://demoninja.com/assets/css/defer.min.css"> -->

<!-- Script -->

{!! !empty($asset_header->content) ? $asset_header->content:''!!}  


@endsection

@section('content')

@include('layouts.header')

<section class="section1" data-stellar-background-ratio="0.5" itemprop="searcbar">
  <div class="container">
    <div class="dis-tab">
      <div class="var-mid">
        <h1 class="heading" style="text-align: center; padding-left: 0px;"> Unlock Your Phone Online</h1>
        <p style="color: #fff;">Fast & Reliable Service
          <br>To Unlock Mobile Phones Remotely
        </p>

        <form id="brand_form" name="" method="GET" class="green-form" action="{{ url('/') }}">
          @csrf
          <div class="row search-box" data-spy="affix" data-offset-top="450">
            <div class="col-md-4 col-sm-12 col-12" style="position:relative">
              <span class="mark">1</span>
              <input type="hidden" name="data[Page][brand_text]" id="brand_text" value="">
              <div class="selectize-control selectpicker single">
                <div class="items not-full has-options">
                  <!-- <input type="text" autocomplete="off" tabindex="" id="brandid-selectized" placeholder=" Select Brand "> -->

                  <select id="brand_id" name="brand_id" onchange="getmodel();" class="selectpicker" itemprop="name" data-live-search="true" data-live-search-placeholder="Type Brand Name">
                    <option value="">Select Brand</option>
                    @foreach($brands as $brand)
                    <option id="brandid-selectized" value="{{$brand->manu_id}}">{{$brand->manu_name}}</option>
                    @endforeach
                  </select>
                  <div class="form-group " id="brand-errors" role="alert"></div>
                </div>
              </div>
            </div>
            <div class="col-md-4 col-sm-12 col-12 notranslate" id="mod" style="position:relative">
              <span class="mark1">2</span>
              <div id="loader" style="display:none" class="dpnone img"><img src="/images/indicator.gif" /></div>
              <span id="modx">
                <div class="selectize-control selectpicker single">
                  <div class="items not-full disabled locked fillmodel">
                    <!-- <input type="text" autocomplete="off" tabindex="-1" id="modelid-selectized" placeholder="Select Model" disabled="" style="width: 105.062px;"> -->
                    <select id="model_id" class="selectpicker" itemprop="name" data-live-search="true" data-live-search-placeholder="Type Brand Name" name="model_id">
                      <option value="">Select Model</option>
                    </select>
                    <div class="form-group " id="model-errors" role="alert" style="padding: 10px;"></div>
                  </div>
                </div>
              </span>
              <!-- <span class="error_m" id="selmodel"> &nbsp; &nbsp; Select Model</span> -->
            </div>
            <div class="col-md-4 col-sm-12 col-12" style="position:relative">
              <span class="mark2">3</span>
              <button type="button" id="submit_form" class="btn-sub btn" itemprop="unlock button"> Unlock Now</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>



<!-- <section class="heart-sec" role="Person" itemscope itemtype="https://schema.org/Person" style="padding-top: 20px;">
  <div class="container">
    <h2>
      <img itemprop="image" src="images/svg/heart.svg" alt="demoninja satisfied customers" class="svg" />
      <span>More than
        <small>50,000</small> satisfied customers
      </span>
    </h2>
  </div>
</section>
<div class="clearfix"></div>

<div class="gard">
  <div class="video-box">
    <span></span>
    <div class="embed-responsive embed-responsive-16by9 landing-video">
      <a href="https://www.youtube.com/watch?v=esAwWpdihA8" data-fancybox="video">
        <img src="images/spinner.gif" data-src="https:/images.youtube.com/vi/esAwWpdihA8/maxresdefault.jpg" alt="youtube" />
      </a>
    </div>
  </div>
</div> -->
<section class="heart-sec" role="Person" itemscope style="padding-top: 45px; padding-bottom: 1px;">
  <div class="container">
    <h2>
      <img itemprop="image" src="images/svg/heart.svg" alt="demoninja satisfied customers" class="svg" />
      <span>More than
        <small>50,000</small> happy customers
      </span>
    </h2>
  </div>
</section>

<section class="sec-popular-brands" style="padding-top: 1px;" itemscope itemtype="https://schema.org/PopularBrands">
  <div class="container">
    <!-- <h2>Most popular brands selected for you</h2> -->
    <div class="top-brands">
      <a href="/unlock-samsung+phone" class="item" itemprop="Phone Brand" itemscope itemtype="s">
        <div class="img-container" itemscope itemtype="Image">
          <img src="images/brand/samsung.png" title="Samsung" alt="Samsung" class="img-fluid" />
        </div>
        <div class="item-name" itemprop="name">Samsung Unlock</div>
      </a>
      <a href="/unlock-apple+phone" class="item" itemprop="Phone Brand" itemscope itemtype="s">
        <div class="img-container" itemscope itemtype="Image">
          <img src="images/brand/apple.png" title="Apple" alt="Apple" class="img-fluid" />
        </div>
        <div class="item-name" itemprop="name">Apple Unlock</div>
      </a>
      <a href="/unlock-zte+phone" class="item" itemprop="Phone Brand" itemscope itemtype="s">
        <div class="img-container" itemscope itemtype="Image">
          <img src="images/brand/zte.png" title="ZTE" alt="ZTE" class="img-fluid" />
          <!-- src="images/spinner.gif" -->
        </div>
        <div class="item-name" itemprop="name">ZTE Unlock</div>
      </a>
      <a href="/unlock-lg+phone" class="item" itemprop="Phone Brand" itemscope itemtype="s">
        <div class="img-container" itemscope itemtype="Image">
          <img src="images/brand/lg.png" title="LG" alt="LG" class="img-fluid" />
        </div>
        <div class="item-name" itemprop="name">LG Unlock</div>
      </a>
      <a href="/unlock-motorola+phone" class="item" itemprop="Phone Brand" itemscope itemtype="s">
        <div class="img-container" itemscope itemtype="Image">
          <img src="images/brand/motorola.png" title="Motorola" alt="Motorola" class="img-fluid" />
        </div>
        <div class="item-name" itemprop="name">Motorola Unlock</div>
      </a>
      <a href="/unlock-htc+phone" class="item" itemprop="Phone Brand" itemscope itemtype="s">
        <div class="img-container" itemscope itemtype="Image">
          <img src="images/brand/htc.png" title="HTC" alt="HTC" class="img-fluid" />
        </div>
        <div class="item-name" itemprop="name">HTC Unlock</div>
      </a>
    </div>
  </div>
</section>




<!-- <section class="feature-sec">
  <div class="container">
    <div class="secure-sec row">
      <div class="col-sm-4 col-6 border-right right-icon-xs">
        <div class="secure-box">
          <div class="money-back secure-cmn-icons"></div>
          <span>Money Back Guarantee</span>
        </div>
        <div class="secure-box bottom-box">
          <div class="fast-dev secure-cmn-icons"></div>
          <span>Fast Delivery</span>
        </div>
        <div class="secure-box bottom-box visible-xs">
          <div class="secure-proc secure-cmn-icons"></div>
          <span>Secure Process</span>
        </div>
      </div>
      <div class="col-sm-4 col-6 border-right hidden-xs">
        <div class="secure-box">
          <div class="low-price secure-cmn-icons"></div>
          <span>Lowest Price Guarantee</span>
        </div>
        <div class="secure-box bottom-box">
          <div class="secure-proc secure-cmn-icons"></div>
          <span>Secure Process</span>
        </div>
      </div>
      <div class="col-sm-4 col-6">
        <div class="secure-box">
          <div class="aws-support secure-cmn-icons"></div>
          <span>Awesome Support</span>
        </div>
        <div class="secure-box bottom-box">
          <div class="happy-cus secure-cmn-icons"></div>
          <span>Happy Customer</span>
        </div>
        <div class="secure-box visible-xs">
          <div class="low-price secure-cmn-icons"></div>
          <span>Lowest Price Guarantee</span>
        </div>
      </div>
    </div>
  </div>
</section> -->

<section class="sec-popular-iphones" itemscope itemtype="https://schema.org/iPhones">
  <div class="container">
    <h2 itemscope itemtype="https://schema.org/Phone">Top
      <span itemprop="name">iPhones</span>
    </h2>
    <div class="owl-carousel owl-theme top-phones">
      <a href="/unlock-apple+iphone-xs" class="item" itemprop="url" itemscope itemtype="https://schema.org/iPhoneModel">
        <div class="img-container" itemscope itemtype="https://schema.org/PhoneImage">
          <img src="images/phones/iphone/iphoneXS.jpg" title="iPhone XS" alt="iPhone XS" class="img-fluid" />
        </div>
        <div class="item-name" itemprop="name">iPhone XS</div>
      </a>
      <a href="/unlock-apple+iphone-xs-max" class="item" itemprop="url" itemscope itemtype="https://schema.org/iPhoneModel">
        <div class="img-container" itemscope itemtype="https://schema.org/PhoneImage">
          <img src="images/phones/iphone/iphoneXSmax.jpg" title="iPhone XS Max" alt="iPhone XS Max" class="img-fluid" />
        </div>
        <div class="item-name" itemprop="name">iPhone XS Max</div>
      </a>
      <a href="/unlock-apple+iphone-xr" class="item" itemprop="url" itemscope itemtype="https://schema.org/iPhoneModel">
        <div class="img-container" itemscope itemtype="https://schema.org/PhoneImage">
          <img src="images/phones/iphone/iphoneXR.jpg" title="iPhone XR" alt="iPhone XR" class="img-fluid" />
        </div>
        <div class="item-name" itemprop="name">iPhone XR</div>
      </a>
      <a href="/unlock-apple+iphone-x" class="item" itemprop="url" itemscope itemtype="https://schema.org/iPhoneModel">
        <div class="img-container" itemscope itemtype="https://schema.org/PhoneImage">
          <img src="images/phones/iphone/iphoneX.jpg" title="iPhone X" alt="iPhone X" class="img-fluid" />
        </div>
        <div class="item-name" itemprop="name">iPhone X</div>
      </a>
      <a href="/unlock-apple+iphone-8-plus" class="item" itemprop="url" itemscope itemtype="https://schema.org/iPhoneModel">
        <div class="img-container" itemscope itemtype="https://schema.org/PhoneImage">
          <img src="images/phones/iphone/iphone8plus.jpg" title="iPhone 8 Plus" alt="iPhone 8 Plus" class="img-fluid" />
        </div>
        <div class="item-name" itemprop="name">iPhone 8 Plus</div>
      </a>
      <a href="/unlock-apple+iphone-7-plus" class="item" itemprop="url" itemscope itemtype="https://schema.org/iPhoneModel">
        <div class="img-container" itemscope itemtype="https://schema.org/PhoneImage">
          <img src="images/phones/iphone/iphone7plus.jpg" title="iPhone 7 Plus" alt="iPhone 7 Plus" class="img-fluid" />
        </div>
        <div class="item-name" itemprop="name">iPhone 7 Plus</div>
      </a>
    </div>
    <div class="more-phones">
      <a href="{{url('/unlock-apple+phone')}}" class="more-link mt-2">See more Apple iPhones</a>
    </div>
  </div>
</section>


<section class="sec-popular-samsung" itemscope itemtype="https://schema.org/Samsung">
  <div class="container">
    <h2 itemscope itemtype="https://schema.org/Phone">Top
      <span itemprop="name">Samsung</span> Phones
    </h2>
    <div class="owl-carousel top-phones">
      <a href="/unlock-samsung+galaxy-s10" class="item" itemprop="Phone Model" itemscope itemtype="https://schema.org/SamsungModel">
        <div class="img-container" itemscope itemtype="https://schema.org/PhoneImage">
          <img src="images/phones/samsung/GalaxyS10.png" title="Galaxy S10" alt="Galaxy S10" />
        </div>
        <div class="item-name" itemprop="name">Galaxy S10</div>
      </a>
      <a href="/unlock-samsung+galaxy-note-9" class="item" itemprop="Phone Model" itemscope itemtype="https://schema.org/SamsungModel">
        <div class="img-container" itemscope itemtype="https://schema.org/PhoneImage">
          <img src="images/phones/samsung/GalaxyNote9.png" title="Galaxy Note 9" alt="Galaxy Note 9" />
        </div>
        <div class="item-name" itemprop="name">Galaxy Note 9</div>
      </a>
      <a href="/unlock-samsung+galaxy-a80" class="item" itemprop="Phone Model" itemscope itemtype="https://schema.org/SamsungModel">
        <div class="img-container" itemscope itemtype="https://schema.org/PhoneImage">
          <img src="images/phones/samsung/GalaxyA80.png" title="Galaxy A80" alt="Galaxy A80" />
        </div>
        <div class="item-name" itemprop="name">Galaxy A80</div>
      </a>
      <a href="/unlock-samsung+galaxy-a70" class="item" itemprop="Phone Model" itemscope itemtype="https://schema.org/SamsungModel">
        <div class="img-container" itemscope itemtype="https://schema.org/PhoneImage">
          <img src="images/phones/samsung/GalaxyA70.png" title="Galaxy A70" alt="Galaxy A70" />
        </div>
        <div class="item-name" itemprop="name">Galaxy A70</div>
      </a>
      <a href="/unlock-samsung+galaxy-a50" class="item" itemprop="Phone Model" itemscope itemtype="https://schema.org/SamsungModel">
        <div class="img-container" itemscope itemtype="https://schema.org/PhoneImage">
          <img src="images/phones/samsung/GalaxyA50.png" title="Galaxy A50" alt="Galaxy A50" />
        </div>
        <div class="item-name" itemprop="name">Galaxy A50</div>
      </a>
      <a href="/unlock-samsung+galaxy-m40" class="item" itemprop="Phone Model" itemscope itemtype="https://schema.org/SamsungModel">
        <div class="img-container" itemscope itemtype="https://schema.org/PhoneImage">
          <img src="images/phones/samsung/GalaxyM40.png" title="Galaxy M40" alt="Galaxy M40" />
        </div>
        <div class="item-name" itemprop="name">Galaxy M40</div>
      </a>
    </div>
    <div class="more-phones">
      <a href="{{url('/unlock-samsung+phone')}}" class="more-link">See more Samsung Phones</a>
    </div>
  </div>
</section>

<section class="sec-popular-zte" itemscope itemtype="https://schema.org/ZTE">
  <div class="container">
    <h2 itemscope itemtype="https://schema.org/Phone">Top
      <span itemprop="name">ZTE</span> Phones
    </h2>
    <div class="owl-carousel top-phones">
      <a href="/unlock-zte+axon-10-pro" class="item" itemprop="Phone Model" itemscope itemtype="https://schema.org/ZTEModel">
        <div class="img-container" itemscope itemtype="https://schema.org/PhoneImage">
          <img src="images/phones/zte/ZTE_Axon_10_Pro.png" title="ZTE Axon 10 Pro" alt="ZTE Axon 10 Pro" />
        </div>
        <div class="item-name" itemprop="name">ZTE Axon 10 Pro</div>
      </a>
      <a href="/unlock-zte+blade-v10" class="item" itemprop="Phone Model" itemscope itemtype="https://schema.org/ZTEModel">
        <div class="img-container" itemscope itemtype="https://schema.org/PhoneImage">
          <img src="images/phones/zte/ZTE_Blade_V10.png" title="ZTE Blade V10" alt="ZTE Blade V10" />
        </div>
        <div class="item-name" itemprop="name">ZTE Blade V10</div>
      </a>
      <a href="/unlock-zte+blade-v10" class="item" itemprop="Phone Model" itemscope itemtype="https://schema.org/ZTEModel">
        <div class="img-container" itemscope itemtype="https://schema.org/PhoneImage">
          <img src="images/phones/zte/ZTE_Blade_V10_vita.png" title="ZTE Blade V10 Vita" alt="ZTE Blade V10 Vita" />
        </div>
        <div class="item-name" itemprop="name">ZTE Blade V10 Vita</div>
      </a>
      <a href="/unlock-zte+axon-9-pro" class="item" itemprop="Phone Model" itemscope itemtype="https://schema.org/ZTEModel">
        <div class="img-container" itemscope itemtype="https://schema.org/PhoneImage">
          <img src="images/phones/zte/ZTE_Axon_9_Pro.png" title="ZTE Axon 9 Pro" alt="ZTE Axon 9 Pro" />
        </div>
        <div class="item-name" itemprop="name">ZTE Axon 9 Pro</div>
      </a>
      <a href="/unlock-zte+blade-v9" class="item" itemprop="Phone Model" itemscope itemtype="https://schema.org/ZTEModel">
        <div class="img-container" itemscope itemtype="https://schema.org/PhoneImage">
          <img src="images/phones/zte/ZTE_Blade_V9.png" title="ZTE Blade V9" alt="ZTE Blade V9" />
        </div>
        <div class="item-name" itemprop="name">ZTE Blade V9</div>
      </a>
      <a href="/unlock-zte+blade-a7" class="item" itemprop="Phone Model" itemscope itemtype="https://schema.org/ZTEModel">
        <div class="img-container" itemscope itemtype="https://schema.org/PhoneImage">
          <img src="images/phones/zte/ZTE_Blade_A7_2019.png" title="ZTE Blade A7" alt="ZTE Blade A7" />
        </div>
        <div class="item-name" itemprop="name">ZTE Blade A7</div>
      </a>
    </div>
    <div class="more-phones">
      <a href="{{url('/unlock-zte+phone')}}" class="more-link mt-2">See more ZTE Phones</a>
    </div>
  </div>
</section>

<section class="sec-popular-htc" itemscope itemtype="https://schema.org/HTC">
  <div class="container">
    <h2 itemscope itemtype="https://schema.org/Phone">Top
      <span itemprop="name">HTC</span> Phones
    </h2>
    <div class="owl-carousel top-phones">
      <a href="/unlock-htc+u12+" class="item" itemprop="Phone Model" itemscope itemtype="https://schema.org/HTCModel">
        <div class="img-container" itemscope itemtype="https://schema.org/PhoneImage">
          <img src="images/phones/htc/HTC_U12_Plus.png" title="HTC U12 Plus" alt="HTC U12 Plus" />
        </div>
        <div class="item-name" itemprop="name">HTC U12 Plus</div>
      </a>
      <a href="/unlock-htc+u11-plus" class="item" itemprop="Phone Model" itemscope itemtype="https://schema.org/HTCModel">
        <div class="img-container" itemscope itemtype="https://schema.org/PhoneImage">
          <img src="images/phones/htc/HTC_U11_Plus.png" title="HTC U11 Plus" alt="HTC U11 Plus" />
        </div>
        <div class="item-name" itemprop="name">HTC U11 Plus</div>
      </a>
      <a href="/unlock-htc+u11" class="item" itemprop="Phone Model" itemscope itemtype="https://schema.org/HTCModel">
        <div class="img-container" itemscope itemtype="https://schema.org/PhoneImage">
          <img src="images/phones/htc/HTC_U11.png" title="HTC U11" alt="HTC U11" />
        </div>
        <div class="item-name" itemprop="name">HTC U11</div>
      </a>
      <a href="/unlock-htc+desire-10-pro" class="item" itemprop="Phone Model" itemscope itemtype="https://schema.org/HTCModel">
        <div class="img-container" itemscope itemtype="https://schema.org/PhoneImage">
          <img src="images/phones/htc/HTC_Desire_10_Pro.png" title="HTC Desire 10 Pro" alt="HTC Desire 10 Pro" />
        </div>
        <div class="item-name" itemprop="name">HTC Desire 10 Pro</div>
      </a>
      <a href="/unlock-htc+u-play" class="item" itemprop="Phone Model" itemscope itemtype="https://schema.org/HTCModel">
        <div class="img-container" itemscope itemtype="https://schema.org/PhoneImage">
          <img src="images/phones/htc/HTC_U_Play.png" title="HTC U Play" alt="HTC U Play" />
        </div>
        <div class="item-name" itemprop="name">HTC U Play</div>
      </a>
      <a href="/unlock-htc+u-ultra" class="item" itemprop="Phone Model" itemscope itemtype="https://schema.org/HTCModel">
        <div class="img-container" itemscope itemtype="https://schema.org/PhoneImage">
          <img src="images/phones/htc/HTC_U_Ultra.png" title="HTC U Ultra" alt="HTC U Ultra" />
        </div>
        <div class="item-name" itemprop="name">HTC U Ultra</div>
      </a>
    </div>
    <div class="more-phones">
      <a href="{{url('/unlock-htc+phone')}}" class="more-link mt-2">See more HTC Phones</a>
    </div>
  </div>
</section>

<section class="sec-popular-lg" itemscope="" itemtype="https://schema.org/LG">
  <div class="container">
    <h2 itemscope="" itemtype="https://schema.org/Phone">Top <span itemprop="name">LG</span> Phones</h2>
    <div class="owl-carousel top-phones owl-loaded owl-drag">

      <div class="owl-stage-outer">
        <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1140px;">
          <div class="owl-item active" style="width: 190px;"><a href="/unlock-lg+w105l" class="item" itemprop="Phone Model" itemscope="" itemtype="https://schema.org/LGModel">
              <div class="img-container" itemscope="" itemtype="https://schema.org/PhoneImage">
                <img src="/images/phones/lg/LG_W10.png" data-src="/images/phones/lg/LG_W10.png" title="LG W10" alt="LG W10">
              </div>
              <div class="item-name" itemprop="name">LG W10</div>
            </a></div>
          <div class="owl-item active" style="width: 190px;"><a href="/unlock-lg+q-stylus" class="item" itemprop="Phone Model" itemscope="" itemtype="https://schema.org/LGModel">
              <div class="img-container" itemscope="" itemtype="https://schema.org/PhoneImage">
                <img src="/images/phones/lg/LG_Q_Stylus.png" data-src="/images/phones/lg/LG_Q_Stylus.png" title="LG Q Stylus" alt="LG Q Stylus">
              </div>
              <div class="item-name" itemprop="name">LG Q Stylus</div>
            </a></div>
          <div class="owl-item active" style="width: 190px;"><a href="/unlock-lg+rebel-4" class="item" itemprop="Phone Model" itemscope="" itemtype="https://schema.org/LGModel">
              <div class="img-container" itemscope="" itemtype="https://schema.org/PhoneImage">
                <img src="/images/phones/lg/LG_Q7_Alpha.png" data-src="/images/phones/lg/LG_Q7_Alpha.png" title="Unlock LG Rebel 4" alt="Unlock LG Rebel 4">
              </div>
              <div class="item-name" itemprop="name">Unlock LG Rebel 4</div>
            </a></div>
          <div class="owl-item active" style="width: 190px;"><a href="/unlock-lg+stylo-4-(q-stylus-for-cricket)" class="item" itemprop="Phone Model" itemscope="" itemtype="https://schema.org/LGModel">
              <div class="img-container" itemscope="" itemtype="https://schema.org/PhoneImage">
                <img src="/images/phones/lg/LG_G7_ThinQ.png" data-src="/images/phones/lg/LG_G7_ThinQ.png" title="LG Stylo 4" alt="LG Stylo 4">
              </div>
              <div class="item-name" itemprop="name">LG Stylo 4</div>
            </a></div>
          <div class="owl-item active" style="width: 190px;"><a href="/unlock-lg+v30+" class="item" itemprop="Phone Model" itemscope="" itemtype="https://schema.org/LGModel">
              <div class="img-container" itemscope="" itemtype="https://schema.org/PhoneImage">
                <img src="/images/phones/lg/LG_V30_ThinQ.png" data-src="/images/phones/lg/LG_V30_ThinQ.png" title="LG V30+ ThinQ" alt="LG V30+ ThinQ">
              </div>
              <div class="item-name" itemprop="name">LG V30+ ThinQ</div>
            </a></div>
          <div class="owl-item active" style="width: 190px;"><a href="/unlock-lg+q6-plus" class="item" itemprop="Phone Model" itemscope="" itemtype="https://schema.org/LGModel">
              <div class="img-container" itemscope="" itemtype="https://schema.org/PhoneImage">
                <img src="/images/phones/lg/LG_Q6.png" data-src="/images/phones/lg/LG_Q6.png" title="LG Q6+" alt="LG Q6+">
              </div>
              <div class="item-name" itemprop="name">LG Q6+</div>
            </a></div>
        </div>
      </div>
      <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"></button><button type="button" role="presentation" class="owl-next"></button></div>
      <div class="owl-dots disabled"></div>
    </div>
    <div class="more-phones">
      <a href="{{url('/unlock-lg+phone')}}" class="more-link">See more LG Phones</a>
    </div>
  </div>
</section>

<section class="sec-popular-motorola" itemscope="" itemtype="https://schema.org/Motorola">
  <div class="container">
    <h2 itemscope="" itemtype="https://schema.org/Phone">Top <span itemprop="name">Motorola</span> Phones</h2>
    <div class="owl-carousel top-phones owl-loaded owl-drag">
      <div class="owl-stage-outer">
        <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1140px;">
          <div class="owl-item active" style="width: 190px;"><a href="/unlock-motorola+moto-z2-force" class="item" itemprop="Phone Model" itemscope="" itemtype="https://schema.org/MotorolaModel">
              <div class="img-container" itemscope="" itemtype="https://schema.org/PhoneImage">
                <img src="/images/phones/motorola/Moto_Z2_Force.png" data-src="/images/phones/motorola/Moto_Z2_Force.png" title="Moto Z2 Force" alt="Moto Z2 Force">
              </div>
              <div class="item-name" itemprop="name">Moto Z2 Force</div>
            </a></div>
          <div class="owl-item active" style="width: 190px;"><a href="/unlock-motorola+moto-z-force" class="item" itemprop="Phone Model" itemscope="" itemtype="https://schema.org/MotorolaModel">
              <div class="img-container" itemscope="" itemtype="https://schema.org/PhoneImage">
                <img src="/images/phones/motorola/Moto_E5_Plus.png" data-src="/images/phones/motorola/Moto_E5_Plus.png" title="Moto Z Force" alt="Moto Z Force">
              </div>
              <div class="item-name" itemprop="name">Moto Z Force</div>
            </a></div>
          <div class="owl-item active" style="width: 190px;"><a href="/unlock-motorola+moto-g6-plus" class="item" itemprop="Phone Model" itemscope="" itemtype="https://schema.org/MotorolaModel">
              <div class="img-container" itemscope="" itemtype="https://schema.org/PhoneImage">
                <img src="/images/phones/motorola/Moto_G6_Plus.png" data-src="/images/phones/motorola/Moto_G6_Plus.png" title="Moto G6 Plus" alt="Moto G6 Plus">
              </div>
              <div class="item-name" itemprop="name">Moto G6 Plus</div>
            </a></div>
          <div class="owl-item active" style="width: 190px;"><a href="/unlock-motorola+moto-g7-power" class="item" itemprop="Phone Model" itemscope="" itemtype="https://schema.org/MotorolaModel">
              <div class="img-container" itemscope="" itemtype="https://schema.org/PhoneImage">
                <img src="/images/phones/motorola/Moto_G7_Power.png" data-src="/images/phones/motorola/Moto_G7_Power.png" title="Moto G7 Power" alt="Moto G7 Power">
              </div>
              <div class="item-name" itemprop="name">Moto G7 Power</div>
            </a></div>
          <div class="owl-item active" style="width: 190px;"><a href="/unlock-motorola+moto-g7" class="item" itemprop="Phone Model" itemscope="" itemtype="https://schema.org/MotorolaModel">
              <div class="img-container" itemscope="" itemtype="https://schema.org/PhoneImage">
                <img src="/images/phones/motorola/Moto_G7.png" data-src="/images/phones/motorola/Moto_G7.png" title="Moto G7" alt="Moto G7">
              </div>
              <div class="item-name" itemprop="name">Moto G7</div>
            </a></div>
          <div class="owl-item active" style="width: 190px;"><a href="/unlock-motorola+moto-z2-play" class="item" itemprop="Phone Model" itemscope="" itemtype="https://schema.org/MotorolaModel">
              <div class="img-container" itemscope="" itemtype="https://schema.org/PhoneImage">
                <img src="/images/phones/motorola/Moto_Z2_Play.png" data-src="/images/phones/motorola/Moto_Z2_Play.png" title="Moto Z2 Play" alt="Moto Z2 Play">
              </div>
              <div class="item-name" itemprop="name">Moto Z2 Play</div>
            </a></div>
        </div>
      </div>
      <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"></button><button type="button" role="presentation" class="owl-next"></button></div>
      <div class="owl-dots disabled"></div>
    </div>
    <div class="more-phones">
      <a href="{{url('/unlock-motorola+phone')}}" class="more-link">See more Motorola Phones</a>
    </div>
  </div>
</section>
<section class="question_step">
  <div class="container">
    <h2 itemprop="IMEI unlocks" itemscope itemtype="https://schema.org/IMEIUnlocks">
      <span itemprop="imei">IMEI unlocks explained</span>
    </h2>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
      <div class="panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
          <h3 class="panel-title" itemprop="name">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#whyUnlock" aria-expanded="true" aria-controls="collapseOne">
              <img itemprop="image" src="images/svg/earth-globe.svg" alt="" class="svg " />
              <span>
                <small class="red">Higher resale price</small> and more benefits.
              </span>
              <div class="clearfix"></div>
            </a>
          </h3>
        </div>
        <div id="whyUnlock" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
          <div class="panel-body whyUnlockPhone">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-12">
                <div class="wupBox red">
                  <img itemprop="image" src="images/svg/users.svg" alt="" class="svg " />
                  <h3>Resell Value</h3>
                  <p>You can resell your unlocked mobile phone to anyone in any country unlike a locked phone that can be resold within the same country to people use the same network it came locked with.</p>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-12">
                <div class="wupBox green">
                  <img itemprop="image" src="images/svg/earth-globe.svg" alt="" class="svg " />
                  <h3>All over the world</h3>
                  <p>Unlocked phones is a real bliss for international travellers/ business travellers since they need not pay high international roaming charges. Instead, they can use a local sim card of the travelling country.</p>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-12">
                <div class="wupBox yellow">
                  <img itemprop="image" src="images/svg/unlock.svg" alt="Unlock phone with network unlock codes to use any GSM network
                      " class="svg " />
                  <h3>Unlock Phone</h3>
                  <p>Unlock your phone to be able to use any mobile network in the world. No matter which country or network you use - you can use it with your existing mobile phone.</p>
                </div>
              </div>
              <div class="col-md-6 col-sm-6 col-12">
                <div class="wupBox lightGreen">
                  <img itemprop="image" src="images/svg/lock.svg" alt="Phone unlocking services with 100% legal and secure and permanent
                      " class="svg " />
                  <h3>100% legal and secure </h3>
                  <p>Unlocking your phone is 100% legal and secure. No software to be installed, no hardware tampering!</p>
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
          <h3 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#howUnlock" aria-expanded="true" aria-controls="collapseOne">
              <img itemprop="image" src="images/svg/unlocked-icon.svg" alt="Get phone unlock code with in three easy steps
                  " class="svg " />
              <span>Unlock in
                <small class="green">three easy steps</small>.
              </span>
              <div class="clearfix"></div>
            </a>
          </h3>
        </div>
        <div id="howUnlock" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
          <div class="panel-body howUnlockiPhone">
            <div class="row">
              <div class="col-md-4 col-sm-5 col-12">
                <h3>
                  <small>1</small> Select your phone’s brand & model
                </h3>
              </div>
              <div class="col-md-8 col-sm-7 col-12">
                <p>Unlocking your phone with us is a very easy, quick and safe process. Lets assume that you would like to unlock iPhone 6, that is locked with AT&T USA. </p>
                <p>From the first drop down menu - please select the brand/ manufacturer of your phone. We are taking an example to unlock iPhone 6, so you should select Apple from the brand selection menu.</p>
                <p>Once you have selected the brand, we will show all the available phone models within this brand. You should be able to chose from iPhone 5, iPhone 6, and all other models if you selected Apple as your phone brand.</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-4 col-sm-5 col-12">
                <h3>
                  <small>2</small> Select the country and network provider
                </h3>
              </div>
              <div class="col-md-8 col-sm-7 col-12">
                <p>Please select the Country from the drop down menu and then you will be able to select the Network provider that your phone is currently locked to. In our example, you should be selecting USA as the Country and AT&T as the Network provider. DO NOT CHOSE THE COUNTRY AND NETWORK YOU WANT TO USE.</p>
                <p>We also ask that you enter your valid email id to be able to receive the unlocking code and instructions. </p>
                <p>Most phones are locked by network providers like AT&T, Verizon, Sprint etc, and some of the network providers are operational in more than one country (like Vodafone). It is very important for you to select the right country and network to which your phone is currently locked.</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-4 col-sm-5 col-12">
                <h3>
                  <small>3</small> Payment to unlock
                </h3>
              </div>
              <div class="col-md-8 col-sm-7 col-12">
                <p>You will be shown with a selection of unlocking tools with their respective costs. For some phones there might only be one tool handpicked by our team of experts while there might be more than one tool available for other phones. Tools can be separated based on your contract status with the network provider and/ or the speed of unlock code generation. </p>
                <p>Upon successful payment, you will be prompted with login details to a secure customer portal where you will need to enter your IMEI number. We don't take IMEI number before payment is successful for security reasons.</p>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="panel-default">
        <div class="panel-heading" role="tab" id="headingMin">
          <h3 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#howUnlock6" aria-expanded="true" aria-controls="collapseOne">
              <img itemprop="image" src="images/apple1.png" alt="Unlock iphone 6 and all other iplohe models with demoninja " class="svg" style="float: left; width: 18px;" />
              <span>
                <small class="red">How to unlock iphone 6</small>, and other apple products
                .
              </span>
              <div class="clearfix"></div>
            </a>
          </h3>
        </div>
        <div id="howUnlock6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingMin">
          <div class="panel-body howUnlockiPhone">
            <p>We provide official IMEI based unlocking services for iphone 6, iphone5, ipads and other apple devices. The process is safe and reliable and involves unlocking through official iTunes server.</p>
            <div class="row">
              <div class="col-md-4 col-sm-5 col-12">
                <h3>
                  <small>1</small> Order unlocking for your iphone 6 or other apple devices:

                </h3>
              </div>
              <div class="col-md-8 col-sm-7 col-12">
                <p> Select Apple from the Brand drop down menu and select your desired model from the model drop down. </p>
                <p> On the second page, chose the country and network that your phone was originally bought from.</p>
                <p> Make the payment using your credit card or Paypal and provide the IMEI from secure client portal.</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-4 col-sm-5 col-12">
                <h3>
                  <small>2</small> Connect to iTunes server
                </h3>
              </div>
              <div class="col-md-8 col-sm-7 col-12">
                <p> Make sure your iphone 6/ apple phone has the latest version of iOS. To learn how to update your iOS version, please click here.</p>
                <p> Restart your phone with a Sim card from an another network (non-compatible network) </p>
                <p> Install the latest version of iTunes on your computer. You can also use computers other than Mac operating systems.</p>
                <p> Connect your iphone 6/ apple phone with your computer using an original or compatible data cable. </p>
                <p> Launch iTunes on your computer and wait until iTunes detect your iphone 6.</p>
                <p>You need to disconnect your iphone 6 from the iTunes software and reconnect again after 15-20 seconds.</p>
                <p>Good news, your iphone 6 is already unlocked :) </p>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
          <h3 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#safeForePhone" aria-expanded="true" aria-controls="collapseOne">
              <img itemprop="image" src="images/svg/safety-box.svg" alt="Phone unlocking services with 100% legal and safe for phone
                  " class="svg " />
              <span>
                <small class="green">100% legal</small> and safe for phone
              </span>
              <div class="clearfix"></div>
            </a>
          </h3>
        </div>
        <div id="safeForePhone" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
          <div class="panel-body howUnlockiPhone">
            <p>You don't need to install any shady software or do any hardware tampering. Our unlocking process is very simple and 100% legal. We work with your network provider or phone manufacturer to unlock your phone.</p>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
          <h3 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#cheapestPriceIndustry" aria-expanded="true" aria-controls="collapseOne">
              <img itemprop="image" src="images/svg/clothes-tag.svg" alt="Phone unlocking service on cheapest prices
                  " class="svg " />
              <span>
                <small class="red">Cheapest prices</small> in the industry
              </span>
              <div class="clearfix"></div>
            </a>
          </h3>
        </div>
        <div id="cheapestPriceIndustry" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
          <div class="panel-body howUnlockiPhone">
            <p>While quality comes at a price, our price comes with the cheapest price guaranteed. If you happen to find a lower price at another site of repute, we will try and match the price for you. </p>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
          <h3 class="panel-title" itemprop="name">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#howLongtake" aria-expanded="true" aria-controls="collapseOne">
              <img itemprop="image" src="images/svg/alarm-clock2.svg" alt="Phone unlocking services on fastest delivery with automated email alerts.
                  " class="svg " />
              <span>Fastest delivery with
                <small class="green">automated email alerts</small>.
              </span>
              <div class="clearfix"></div>
            </a>
          </h3>
        </div>
        <div id="howLongtake" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
          <div class="panel-body whatAllPhoneUnlock pr100">
            <p itemprop="description">We process your phone's unlocking as soon as you make the payment and provide us your IMEI. We show an estimated delivery time before you make an order with us and this excludes Saturday's and Sundays and other Public holidays. So, for instance, if you are making an order on Friday with expected delivery time as 2 days - it is most likely to be delivered on Tuesday (Friday + 2 days = Monday and Tuesday). Most networks do not work/ support unlocking requests over the weekends. </p>
            <p>Some times delivery time can take longer than expected. We process your order(s) immediately upon your payment and provide you with unlocking status as soon as the network providers update us. All this process is fully automated so there's never a delay from our side. We can not cancel your order until before 30 days of order processing date because we pay to our suppliers up front for every unlock request and if its delayed from network then we can not do anything about it. </p>
            <p>Please be patient while we work with your network provider to permanently unlock your phone. If we are unsuccessful to unlock your phone after this - we will fully refund your money automatically. </p>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
          <h3 class="panel-title" itemprop="name">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#whatIfMyPhone" aria-expanded="true" aria-controls="collapseOne">
              <img itemprop="image" src="images/svg/lock-phone.svg" alt="Phone unlocking services with 100% money back guarantee
                  " class="svg " />
              <span>100%
                <small class="red">Money Back Guarantee</small>.
              </span>
              <div class="clearfix"></div>
            </a>
          </h3>
        </div>
        <div id="whatIfMyPhone" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
          <div class="panel-body whatAllPhoneUnlock pr100">
            <p itemprop="description">We unlock a large number of phones every day from a variety of phone manufacturers and telecom network providers. However, for multiple reasons, not every phone can be unlocked. We do have a high success rate but there are some failures too. We provide 100% money back guarantee after you provide a video proof of the code not working. In the cases where we are not able to generate an unlocking code - we return your full money automatically. </p>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
          <h3 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#globalCoverageSupport" aria-expanded="true" aria-controls="collapseOne">
              <img itemprop="image" src="images/svg/pattern.svg" alt="Phone unlocking services for all major brands and GSM networks worldwide
                  " class="svg " />
              <span>Global coverage supporting
                <small class="green">all major brands and networks</small>
              </span>
              <div class="clearfix"></div>
            </a>
          </h3>
        </div>
        <div id="globalCoverageSupport" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
          <div class="panel-body howUnlockiPhone">
            <p>We literally unlock thousands of models from hundreds of network providers from all around the world. Please feel free to speak to our Support if you don't see your desired phone or network in our list. </p>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="clearfix"></div>


<section class="sec-faq">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="main-head-1 text-center mb30" itemprop="headline">Frequent questions</h2>
        <div class="pp-accordion" itemprop="FAQ" itemscope itemtype="https://schema.org/FrequentQuestions">
          <div class="panel-group wrap" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="row">
              <div class="col-md-6">
                <div class="panel">
                  <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title" itemprop="question">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne1" aria-expanded="true" aria-controls="collapseOne">
                        What is the reason behind my phone's lock?
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body" itemprop="answer">
                      The SIM lock on your mobile handset is being imposed by the GSM network providers in order to prevent you from using the phone outside their complex. When you purchase a GSM mobile phone at a subsidized price along with subscriptions to a particular network, the operators usually set a target to get back this investment before you terminate the service. In order to get back investment, the network providers implement this feature called SIM lock on your mobile.
                    </div>
                  </div>
                </div>
                <div class="panel">
                  <div class="panel-heading" role="tab" id="headingOne2">
                    <h4 class="panel-title">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne2" aria-expanded="true" aria-controls="collapseOne">
                        What does SIM lock mean?
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne2">
                    <div class="panel-body">
                      This is a typical feature of software found in GSM phones which is made by the manufacturers. This feature is being used by the service providers or network providers to impose restrictions on the use of the phone in specific countries and particular network providers.
                    </div>
                  </div>
                </div>
                <div class="panel">
                  <div class="panel-heading" role="tab" id="headingOne3">
                    <h4 class="panel-title">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne3" aria-expanded="true" aria-controls="collapseOne">
                        What does unlock code mean?
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne3">
                    <div class="panel-body">
                      An unlock code is a numeric function which is entered into a locked mobile handset. The unlock code deactivates the SIM lock and makes the mobile capable of using other GSM carriers.
                    </div>
                  </div>
                </div>
                <div class="panel">
                  <div class="panel-heading" role="tab" id="headingOne4">
                    <h4 class="panel-title">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne4" aria-expanded="true" aria-controls="collapseOne">
                        How do I locate my IMEI number?
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne4">
                    <div class="panel-body">
                      The most common way of finding the IMEI number of your handset is by entering *#06# or by locating it below the battery of your phone. If you still can't find it, please follow the steps mentioned below based on your handset type.
                      <br />
                      For Android - Click "Settings" and click on "About Phone"
                      <br />
                      For iOS - Open "Settings", click "General" and then click "About"
                      <br />
                      For Blackberry - Click on "Options" and then select "Status"
                      <br />
                      For Sony Ericcson - Open "Options" and then select "Status"
                      <br />
                    </div>
                  </div>
                </div>
                <div class="panel">
                  <div class="panel-heading" role="tab" id="headingOne5">
                    <h4 class="panel-title">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne5" aria-expanded="true" aria-controls="collapseOne">
                        What are the end results of unlocking?
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne5">
                    <div class="panel-body">
                      The unlock code will remove the SIM lock from your original handset, thus making it usable on other GSM networks.
                    </div>
                  </div>
                </div>
                <div class="panel">
                  <div class="panel-heading" role="tab" id="headingOne6">
                    <h4 class="panel-title">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne6" aria-expanded="true" aria-controls="collapseOne">
                        What are the things that unlocking can't do?
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne6">
                    <div class="panel-body">
                      Unlocking cannot remove the ban caused due to your lost or stolen phone. It does not give free services to the customer, nor does it delete user passwords from your SIM or mobile handset. It never provides you with frequency bands on CDMA/IDEN networks for your usage. Finally, it does not void the warranty of your cellphone.
                    </div>
                  </div>
                </div>
                <div class="panel">
                  <div class="panel-heading" role="tab" id="headingOne7">
                    <h4 class="panel-title">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne7" aria-expanded="true" aria-controls="collapseOne">
                        Is it possible to use the original network after I have implemented the unlocking process?
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne6">
                    <div class="panel-body">
                      Yes you can always use your original network even after the unlock process is done.
                    </div>
                  </div>
                </div>
                <div class="panel">
                  <div class="panel-heading" role="tab" id="headingOne8">
                    <h4 class="panel-title">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne8" aria-expanded="true" aria-controls="collapseOne">
                        Is the unlocking done permanently?
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne8" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne6">
                    <div class="panel-body">
                      Definitely yes; once we unlock your phone, it will always remain unlocked forever.
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="panel">
                  <div class="panel-heading" role="tab" id="headingOne9">
                    <h4 class="panel-title">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne9" aria-expanded="true" aria-controls="collapseOne">
                        Can a software update on my phone lock it again?
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne9" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne6">
                    <div class="panel-body">
                      No, the chances are very less. OS updates generally don't lock your phone. However, in rare cases of the phone getting locked again, you can always re-use the lock code you purchased from us to unlock it again.
                    </div>
                  </div>
                </div>
                <div class="panel">
                  <div class="panel-heading" role="tab" id="headingOne10">
                    <h4 class="panel-title">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne10" aria-expanded="true" aria-controls="collapseOne">
                        Is there any expiry date for my unlocking code?
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne10" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne6">
                    <div class="panel-body">
                      No, the unlock codes we provide are permanent and have no expiry date.
                    </div>
                  </div>
                </div>
                <div class="panel">
                  <div class="panel-heading" role="tab" id="headingOne11">
                    <h4 class="panel-title">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne11" aria-expanded="true" aria-controls="collapseOne">
                        Will repairs lock my phone?
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne11" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne6">
                    <div class="panel-body">
                      It actually depends on the degree of repairing that is carried out on your phone. If the main board is replaced with a new one, it will then have a new IMEI number that is different from the earlier one. Thus, a new unlock code will be required for the new IMEI number. But if the main board is just repaired and not replaced, the phone will normally be in unlocked state as before. However, in the event of unlocking by any means, you can always re-use the original unlocking code purchased from us.
                    </div>
                  </div>
                </div>
                <div class="panel">
                  <div class="panel-heading" role="tab" id="headingOne12">
                    <h4 class="panel-title">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne12" aria-expanded="true" aria-controls="collapseOne">
                        Why some unlock codes are expensive as compared to others?
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne12" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne6">
                    <div class="panel-body">
                      The cost of the unlock codes depends on the source which they are obtained from. In most cases, when the code is obtained from the manufacturer, it becomes more expensive. In other cases where the unlock codes are released by the network providers based on the age of the handset or other requirements of the customer, the price becomes low. However, the network providers do not always release the codes due to eligibility requirements, sales arrangements, etc. In these cases, the unlock codes can be obtained through manufacturers only.
                    </div>
                  </div>
                </div>
                <div class="panel">
                  <div class="panel-heading" role="tab" id="headingOne13">
                    <h4 class="panel-title">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne13" aria-expanded="true" aria-controls="collapseOne">
                        What is the meaning of PUK code?
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne13" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne6">
                    <div class="panel-body">
                      PUK or PIN Unlock Key is needed to unlock your SIM card in the event that it has been locked after entering incorrect PIN for three consecutive times. If you enter wrong PUK for consecutive 10 times, then your SIM card will become invalid and you will be required to purchase a new one.
                    </div>
                  </div>
                </div>
                <div class="panel">
                  <div class="panel-heading" role="tab" id="headingOne14">
                    <h4 class="panel-title">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne14" aria-expanded="true" aria-controls="collapseOne">
                        What do you mean by hard lock of your phone?
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne14" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne6">
                    <div class="panel-body">
                      Hard lock means your mobile phone gets permanently locked when you enter wrong SIM unlock code for greater number of times than what your phone actually permits. The number of attempts that can be made before it is hard locked depends on the mobile phone manufacturer and varies from one device to another. Usually, the number of attempts for Samsung, Nokia, Motorola, and HTC is 5 while for Blackberry and LG it is 10.
                    </div>
                  </div>
                </div>
                <div class="panel">
                  <div class="panel-heading" role="tab" id="headingOne15">
                    <h4 class="panel-title">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne15" aria-expanded="true" aria-controls="collapseOne">
                        What is the difference between manufacturers' and networks' unlock methods?
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne15" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne6">
                    <div class="panel-body">
                      The network unlock codes are the codes which are directly obtained from the network provider , while the manufacturer unlock codes are acquired from the company which manufactured the handset like Samsung, Nokia, etc. The network codes are cheaper as compared to manufacturer's code which is little expensive. However, the delivery rate and efficiency of the manufacturer code is higher as it successfully delivers 95% of all the orders. The accuracy rate of the network codes is only 75% which is quite low when compared to that of manufacturers'.
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="text-center">
            <a href="javascript:void(0)" class="show-more">Show more questions</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="youGetAmazing">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-sm-6 col-12">
        <h2 class="heading">Support superheroes to help before and after your purchase</h2>
        <p>Everything is very easy and automated when you make an unlocking order with us. However, we do understand that you might have questions before or after your purchase and our support team is very happy to help at every single step of your journey with us. </p>
        <p>Simply go to our
          <b>
            <a href="/contacts">Contact us</a>
          </b> page and leave a message and our team will get back to you within 24 hours on a usual working day. We might take longer than 24 hours to reply on weekends.
        </p>
      </div>
      <div class="col-md-5 col-sm-6 col-12 col-md-offset-1">
        <div class="client-feedback">
          <img src="images/stars.png" alt="Phone unlocking services client reviews" />
          <p>"Support was very helpful while I was not able to locate my IMEI. I got the unlock code within 2 hours of my order"</p>
        </div>
        <div class="client-feedback">
          <img src="images/stars.png" alt="Phone unlocking services customer reviews" />
          <p>"I have been saving a ton of money on international roaming. Thanks to demoninja for permanently unlocking my iphone 6"</p>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="homeBlogs">
  <div class="container">
    <h2 class="heading">Latest from Blog</h2>
    <div class="row">
      <div class="col-md-3 col-sm-3 col-12">
        <div class="blogBox">
          <h3>
            <a target="_blank" href="/blog/how-to-unlock-android-phones-complete-guide">How To Unlock Android Phones- Complete Guide.</a>
          </h3>
        </div>
      </div>
      <div class="col-md-3 col-sm-3 col-12">
        <div class="blogBox">
          <h3>
            <a target="_blank" href="/blog/how-to-unlock-your-iphone-to-use-on-another-carrier">How to Unlock your iPhone to use on Another Carrier?</a>
          </h3>
        </div>
      </div>
      <div class="col-md-3 col-sm-3 col-12">
        <div class="blogBox">
          <h3>
            <a target="_blank" href="/blog/how-can-i-check-if-my-android-device-prompts-for-unlock-code">How Can I Check If My Android Device Prompts For Unlock Code?</a>
          </h3>
        </div>
      </div>
      <div class="col-md-3 col-sm-3 col-12">
        <div class="blogBox">
          <h3>
            <a target="_blank" href="/blog/what-is-samsung-reactivation-lock-and-how-does-it-differ-from-network-lock">What Is Samsung Reactivation Lock And How Does It Differ From Network Lock?</a>
          </h3>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 text-right">
        <a href="{{url('/blog')}}" class="view-more-blog">View more blogs</a>
      </div>
    </div>
  </div>
</section>
<section class="chooseYourPhone">
  <div class="container">
    <h2 class="heading">Choose your phone</h2>
    <p>Enter your phone model to unlock. We have made it easy for you to search your phone by directly entering the model number. </p>
    <form id="select-btn" class="green-form" method="get" action="{{ url('/') }}">
      @csrf
      <!-- <input type="hidden" name="_method" value="POST"> -->
      <div class="input-group ui-widget">
        <input id="tags" type="text" class="form-control" placeholder="Example - iphone 6, motorola droid" />
        <input type="hidden" name="data[Page][brand_text]" id="brand_textt" value="">
        <input type="hidden" name="data[Page][model_text]" id="model_textt" value="">
        <span class="input-group-btn">
          <button class="btn btn-success" id="submit_search" type="button"> Get Started </button>
        </span>
      </div>
    </form>
  </div>
</section>



@include('layouts.footer')
@endsection

@section('footer')


{!! !empty($asset_footer->content) ? $asset_footer->content:''!!}  


<!-- <div class="row ">
    <div class="col-md-4">
      <li class="mt-2"><a href="{{url('/pages/display/faqs')}}">FAQ's</a></li>
      <li class="mt-2"><a href="{{url('/pages/display/return-policy')}}">Return-Policy</a></li>
      <li class="mt-2"><a href="{{url('/pages/display/privacy-policy')}}">Privacy-Policy</a></li>
      <li class="mt-2"><a href="{{url('/pages/display/terms-conditions')}}">Terms-Conditions</a></li>
    </div>
  </div> -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- <script src="{{asset('assets/vendors/select2/js/select2.js')}}" type="text/javascript"></script> -->
<script type='text/javascript'>
  $(document).ready(function() {
    $('#brand_id, #model_id').selectize();
    //$('#brand_id').selectize();
    //$('#model_id').selectize();
    //$('#brand_id').select2();
    //$('#model_id').select2();

  });
  $("#model_id").attr("disabled", 'disabled');

  function getmodel() {
    //alert('hello'),
    // var brandID = $(this).val();

    var errBrand = document.getElementById('brand-errors');
    errBrand.textContent = '';

    var e = document.getElementById("brand_id"),
      t = e.options[e.selectedIndex].value;
    //alert(t)
    $("#loader").show();
    document.getElementById("brand_text").value = e.options[e.selectedIndex].text, /*$("#loadingDiv").show(), */ $.ajax({
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
  /*$(document).on("change", "#brand_id", function(){
    //$('#brand_id').change(function() {
      var brandID = $(this).val();
      $("#loader").show();
      $('#model_id').find('option').not(':first').remove();

      $.ajax({
        url: 'getModelAjax/' + brandID,
        type: 'GET',
        dataType: 'HTML',
        success: function(data) {
          console.log(data);

          $("#loader").hide();
          $("#model_id").html(data);
          
        }
      });
    }); */
  $(document).ready(function() {


    $('#submit_form').click(function(event) {

      var brandID = $('#brand_id option:selected').text();

      var modelID = $('#model_id option:selected').text();


      var errBrand = document.getElementById('brand-errors');
      var errModel = document.getElementById('model-errors');


      
      errBrand.textContent = '';
      //errModel.textContent = '';
      event.preventDefault();

      $('#model_id').change(function() {
        $('#model-errors').remove();
      })

      // alert(brandID.length)

      if (brandID.length == 0) {
        errBrand.textContent = "Select Brand";

      } else if (modelID.length == 0) {
        // alert(modelID.length)
        errModel.textContent = 'Select Model';
      } else {

        var strBrand = brandID.replace('-', "~");
        var strModel = modelID.replace('-', "~");
        var strBrand = strBrand.replace(/ /g, "-");
        var strModel = strModel.replace(/ /g, "-");
        var strBrand = strBrand.toLowerCase();
        var strModel = strModel.toLowerCase();

        var url = '/unlock-' + strBrand + '+' + strModel;
        window.location.href = url;
      }
    });




  });
</script>
<script src="js/owl.carousel.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    var owl = $('.top-phones');
    owl.owlCarousel({
      
      loop: false,
      margin: 40,
      autoplay: false,
      autoplayTimeout: 5000,
      autoplayHoverPause: true,
      responsiveClass: true,
      responsive: {
        0: {
          items: 3,
          nav: true,
          margin: 0
        },
        600: {
          items: 2,
          nav: false
        },
        1000: {
          items: 6,
          nav: true,
          loop: false
        }
      }
    });
    $('.play').on('click', function() {
      owl.trigger('play.owl.autoplay', [5000])
    })
    $('.stop').on('click', function() {
      owl.trigger('stop.owl.autoplay')
    })
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

<script type="text/javascript">
  $(document).ready(function() {
    var searchRequest = null;
    $("#tags").autocomplete({
      maxLength: 5,
      source: function(e, a) {
        null !== searchRequest && searchRequest.abort(), searchRequest = $.ajax({
          url: "search",
          method: "get",
          dataType: "json",
          data: {
            term: e.term
          },

          success: function(e) {
            searchRequest = null, a($.map(e, function(e) {
              return {
                label: e.label,
                value: {
                  id: e.id,
                  value: e.value
                }
              }
            }))
          }
        }).fail(function() {
          searchRequest = null
        })
      },
      focus: function() {
        return !1
      },
      select: function(e, a) {
        $("#tags").val(a.item.label);
        var t = a.item.value.id.split("-");

        return $("#brand_textt").val(t[0]), $("#model_textt").val(t[1]), !1
      }
    });


    $('#submit_search').click(function(event) {

      var brandID = $('#brand_textt').val();
      var modelID = $('#model_textt').val();

      var strBrand = brandID.replace('-', "~");
      var strModel = modelID.replace('-', "~");
      var strBrand = strBrand.replace(/ /g, "-");
      var strModel = strModel.replace(/ /g, "-");
      var strBrand = strBrand.toLowerCase();
      var strModel = strModel.toLowerCase();


      var url = '/unlock-' + strBrand + '+' + strModel;
      window.location.href = url;

    });

  });
</script>



@endsection