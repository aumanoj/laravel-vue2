<?php // echo '<pre>'; print_r($modals->toArray()); exit; 
?>
@extends('layouts/unlock')

<title>Pages</title>
@section('head')
<link rel="stylesheet" href="{{asset('css/global.min.css')}}">
<style>body {background:#F7F7F7;}
		.section-grey {background:#F7F7F7; line-height: normal; padding:0px 0 20px 0}
		.section-grey .col-md-2 {padding:0 10px;}
	.section-grey .col-sm-2 {padding:0 10px;}
	.section-grey .col-md-12 {padding:0 10px;}
	.section-grey  .modal-body {padding:30px 20px}
	.section-grey .modal-content {border-radius:0;}
	.section-grey .modal {text-align:center;}
	.section-grey .modal::before {
    content: "";
    display: inline-block;
    height: 100%;
    margin-right: -4px;
    vertical-align: middle;
}


#stepsection.not-available h2::after {background:transparent}
.homeBlogs {padding:0;}

.section-grey .modal-dialog {
    display: inline-block;
    text-align: left;
    vertical-align: middle;
}
	
	    .border-b{ padding: 0 0 0px 0px; position: relative;}
		.app-filter {position: absolute; right:10px; top:0px; }
		.app-filter li {display: inline-block; }
		.app-filter li  a {display:block;  padding: 5px; border: solid 1px #fff;  border-radius: 2px; background: #fff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);  }
		.app-filter li  a:hover {background:#f1f1f1; border: solid 1px #fff;}
		.app-filter li:last-child  a {margin-left: 4px;}
		header {font-size:18px; }
		header small {display:block; font-weight: normal; font-size: 12px; margin-top: -5px;}
		.icon-box {width:100%; border-radius: 2px; background: #fff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); padding:5px 10px; margin-bottom: 30px; }
		.icon-box figure {padding:15px 10px 10px 10px; text-align: center;}
		.icon-box .app-des {padding:0 0px 5px;  text-align: left; white-space: nowrap; overflow: hidden;
  		text-overflow: ellipsis; position: relative;}
		.icon-box .app-des span {line-height:13px;}
		.icon-box .app-des .rating-star {margin:10px 0 0 0; padding:0}
		.icon-box .app-des .rating-star li {display:inline-block; font-size: 13px; margin-right: 2px; cursor: pointer}
		.icon-box .app-des .rating-star li.active {color: #F98305}
		.icon-box .app-des .rating-star li:last-child {color: #4983ef;    position: relative;    text-align: right;    width: 67px;}
		.des_text {font-size:12px; line-height:16px;}
		.icon-box img{border:none; border-radius: 5px;}
		.icon-box .app-des .rating-star li:last-child a {color: #4983ef; 	}
		
		.border-b header{padding: 0px 0px 15px 0px; font-weight: 600; letter-spacing: 1px;}
		.icon-box h6{margin: 0px 0px 5px 0px; font-size: 14px; font-weight:normal}
		.icon-box span{font-size: 11px; margin-top: 0px; display: block;}
		.paragraph-end {
    /*background: rgba(0, 0, 0, 0) linear-gradient(to right, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1)) repeat scroll 0 0;*/
    top: 0;
    height: 49px;
    max-height: 100%;
    position: absolute;
    right: 0;
    width: 60px;
}
.custom-cont {padding-left:0; padding-right:0;}
.app_for {position:inherit;}
.app_for img {width:16px;}

.android-btn{
border: 1px solid #25729a;
    border-radius: 5px;
    color: #ffffff;
    display: inline-block;
    font-size: 16px;
    padding: 10px 0 10px 90px !important;
    position: relative;
    text-align: left;
    text-decoration: none;
 
}
.android-btn b {
 display: block;
    font-size: 18px;
    font-weight: normal;}

.android-btn:hover{
 border:1px solid #1c5675;
 
}


.android-btn figure { border-right: 1px solid #25729a;
    display: inline-block;
    left: 20px;
    margin-bottom: 5px;
    margin-top: 3px;
    padding-right: 20px;
    position: absolute;
    top: 19px;}



#stepsection.not-available {padding:20px 0;}
#stepsection.not-available h2 {

    font-size: 18px;
    font-weight: normal;
    line-height: 23px;

    width: 100%;
}	

.do-center {width:100%; margin: 0; padding: 0; text-align: center;}
.do-center li {display:inline-block;}
.do-center li.dp {
    box-sizing: border-box;
    display: inline-block;
    margin: 0 2px;
    width: 47.5%;
}
.app-filter {text-align:left;}
.icon-box h6 {text-align:center;}
.homeBlogs {padding:0}
.heading {margin:0}


@media  (max-width:767px)  {

	.icon-box  {margin-bottom:20px;}
	.section-grey .col-xs-4 {padding:0 5px;}
	.section-grey .col-xs-12 {padding:0 5px;}
	.app-filter {right:5px;}
	.icon-box .app-des .rating-star li:last-child {
    color: #4983ef;
    display: block;
    float: left;
    position: relative;
    text-align: left;
    width: 100%;
}

.custom-cont {padding-left:10px; padding-right:10px;}

.des_text {
    font-size: 12px;
    height: 60px;
    line-height: 16px;
    overflow: hidden;
}


.do-center li.dp {
    box-sizing: border-box;
    display: inline-block;
    margin: 0 6px;
    width: 23%;
}

#stepsection.not-available h2 {
    width: 100%;
}


}


@media  (max-width:480px)  {

.do-center li.dp {
    box-sizing: border-box;
    display: inline-block;
    margin: 0 5px;
    width: 46%;
}




}

.app-filter li a.active {
    background: #f1f1f1;
    border: solid 1px #fff;
}

#stepsection.not-available svg {width:40px;}
#stepsection.not-available h2 {padding:0}</style>
@endsection

@section('content')

<div class="container">
<?php if (isset($_GET['code']) && $_GET['code'] == 'not-available') { ?>   
<section id="stepsection" class="not-available" style="background: none;">
    <div class="container">
        <div class="col-sm-1 col-xs-2"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve" width="20px" height="20px" class="svg replaced-svg">
                <g>
                    <g>
                        <path d="M256.001,0C114.841,0,0,114.841,0,256.001s114.841,256.001,256.001,256.001S512.001,397.16,512.001,256.001    S397.16,0,256.001,0z M256.001,493.701c-131.069,0-237.702-106.631-237.702-237.7S124.932,18.299,256.001,18.299    s237.702,106.632,237.702,237.702S387.068,493.701,256.001,493.701z" fill="#D80027"></path>
                    </g>
                </g>
                <g>
                    <g>
                        <path d="M364.035,333.645c-31.958-21.497-69.315-32.859-108.033-32.859s-76.074,11.362-108.033,32.859    c-4.194,2.82-5.307,8.505-2.486,12.698c2.822,4.193,8.504,5.305,12.698,2.485c28.928-19.458,62.754-29.743,97.821-29.743    s68.892,10.285,97.821,29.743c1.566,1.054,3.341,1.559,5.098,1.559c2.944,0,5.834-1.419,7.6-4.044    C369.341,342.15,368.229,336.465,364.035,333.645z" fill="#D80027"></path>
                    </g>
                </g>
                <g>
                    <g>
                        <path d="M289.651,348.107c-22.015-8.405-45.288-8.404-67.3,0c-4.721,1.803-7.088,7.09-5.285,11.811    c1.804,4.722,7.094,7.085,11.811,5.285c17.742-6.776,36.502-6.777,54.248,0c1.074,0.41,2.176,0.604,3.262,0.604    c3.684,0,7.156-2.241,8.549-5.889C296.738,355.198,294.373,349.909,289.651,348.107z" fill="#D80027"></path>
                    </g>
                </g>
                <g>
                    <g>
                        <path d="M146.725,171.267c-18.666,0-33.852,15.186-33.852,33.852c0,18.666,15.186,33.852,33.852,33.852    c18.666,0,33.852-15.187,33.852-33.852C180.577,186.453,165.391,171.267,146.725,171.267z" fill="#D80027"></path>
                    </g>
                </g>
                <g>
                    <g>
                        <path d="M365.275,171.267c-18.666,0-33.852,15.186-33.852,33.852s15.186,33.852,33.852,33.852s33.852-15.186,33.852-33.852    C399.128,186.453,383.942,171.267,365.275,171.267z" fill="#D80027"></path>
                    </g>
                </g>
                <g>
                    <g>
                        <g>
                            <circle cx="158.007" cy="197.777" r="9.15" fill="#D80027"></circle>
                            <circle cx="376.376" cy="197.777" r="9.15" fill="#D80027"></circle>
                        </g>
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
            </svg></div>
        <div class="col-sm-11 col-xs-10">
            <h2 style="margin:0; text-align:left">Sorry, we do not have a code available for your selection. However, we do have some great app recommendations.</h2>
        </div> 
    </div>
</section> 
<?php } ?>
<div class="mt-5"></div>

<div class="row mt-5">
    <div class="col-md-6">
        <div class="border-b">
            <div class="col-md-12 col-xs-12">
                <ul class="app-filter">
                    <li><a data-toggle="modal" style="display:none;" id="modelclick" data-target="#myModal" href="#"><img src="images/apple_1.png"></a></li>
                    <li><a href="https://demoninja.com/top_apps?platform=ios"><img src="images/apple_1.png"></a></li>
                    <li><a href="https://demoninja.com/top_apps?platform=android"><img src="images/android.png"></a></li>
                </ul>
                <header>Top trending apps </header>
            </div>
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="clearfix">
                                <div class="col-md-6 col-sm-6"><a href="#" id="andid" class="btn btn-block btn-primary android-btn">
                                        <figure><img src="images/android-white.png"></figure> <b>Continue</b> with Android
                                    </a></div>
                                <div class="col-md-6 col-sm-6"> <a href="#" id="iosid" class="btn btn-block btn-primary android-btn">
                                        <figure><img src="images/apple-white.png"></figure><b>Continue</b> with IOS
                                    </a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix">
                <ul class="do-center"></ul>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <section class="homeBlogs">
            <div class="">
                <header><strong>Latest from Blog&gt;</strong></header>
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <div class="blogBox">
                            <h3><a target="_blank" href="/blog/how-to-unlock-android-phones-complete-guide">How To Unlock Android Phones- Complete Guide.</a></h3>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="blogBox">
                            <h3><a target="_blank" href="/blog/how-to-unlock-your-iphone-to-use-on-another-carrier">How to Unlock your iPhone to use on Another Carrier?</a></h3>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="blogBox">
                            <h3><a target="_blank" href="/blog/how-can-i-check-if-my-android-device-prompts-for-unlock-code">How Can I Check If My Android Device Prompts For Unlock Code?</a></h3>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="blogBox">
                            <h3><a target="_blank" href="/blog/what-is-samsung-reactivation-lock-and-how-does-it-differ-from-network-lock">What Is Samsung Reactivation Lock And How Does It Differ From Network Lock?</a></h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-right"> <a href="/blog" class="view-more-blog">View more blogs</a></div>
                </div>
            </div>
        </section>
    </div>
</div>
</div>

@include('layouts.footer')
@endsection

@section('footer')

@endsection