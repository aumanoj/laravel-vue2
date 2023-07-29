@extends('layouts/unlock')

@section('headcontent')
  <title>Unlock Ninja</title>
@endsection

@section('head')
{!! !empty($asset_header->content) ? $asset_header->content:''!!}  
@endsection

@section('content')
@include('layouts.header')
	<section class="thankYou">

<div class="container">
<div class="row">
<div class="col-md-2 col-sm-3 col-xs-12 col-md-offset-2">
<div class="left-thank">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="20px" height="20px" class="svg replaced-svg">
<g>
  <g>
    <path d="M468.907,214.604c-11.423,0-20.682,9.26-20.682,20.682v20.831c-0.031,54.338-21.221,105.412-59.666,143.812    c-38.417,38.372-89.467,59.5-143.761,59.5c-0.04,0-0.08,0-0.12,0C132.506,459.365,41.3,368.056,41.364,255.883    c0.031-54.337,21.221-105.411,59.667-143.813c38.417-38.372,89.468-59.5,143.761-59.5c0.04,0,0.08,0,0.12,0    c28.672,0.016,56.49,5.942,82.68,17.611c10.436,4.65,22.659-0.041,27.309-10.474c4.648-10.433-0.04-22.659-10.474-27.309    c-31.516-14.043-64.989-21.173-99.492-21.192c-0.052,0-0.092,0-0.144,0c-65.329,0-126.767,25.428-172.993,71.6    C25.536,129.014,0.038,190.473,0,255.861c-0.037,65.386,25.389,126.874,71.599,173.136c46.21,46.262,107.668,71.76,173.055,71.798    c0.051,0,0.092,0,0.144,0c65.329,0,126.767-25.427,172.993-71.6c46.262-46.209,71.76-107.668,71.798-173.066v-20.842    C489.589,223.864,480.33,214.604,468.907,214.604z" fill="#cccccc"></path>
  </g>
</g>
<g>
  <g>
    <path d="M505.942,39.803c-8.077-8.076-21.172-8.076-29.249,0L244.794,271.701l-52.609-52.609c-8.076-8.077-21.172-8.077-29.248,0    c-8.077,8.077-8.077,21.172,0,29.249l67.234,67.234c4.038,4.039,9.332,6.058,14.625,6.058c5.293,0,10.586-2.019,14.625-6.058    L505.942,69.052C514.019,60.975,514.019,47.88,505.942,39.803z" fill="#cccccc"></path>
  </g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
<g>
</g>
</svg>
</div>
</div>
<div class="col-md-6 col-sm-9 col-xs-12">
<div class="right-thank">
<h2>Thank you for your order </h2>
<p><strong>Important -</strong> Please provide your IMEI number by signing in as per details below:</p>
<p>
URL : <a href="https://www.demoninja.com/clients/login">https://www.demoninja.com/clients/login</a><br>
Username : <?php echo $OrderUser->email; ?> <br>
Password : <?php echo $OrderUser->password; ?> </p>
<p>Don't worry if you can not do it right now - we have also sent the above information to you via email at <strong><?php echo $OrderUser->email; ?></strong>. For any further assitance, feel free to email us at info@demoninja.com </p>
</div>
</div>
</div>

</div>
</section>
@include('layouts.footer')

{!! !empty($asset_footer->content) ? $asset_footer->content:''!!}  
@endsection
