@extends('layouts/unlock')

<title>Contact</title>
@section('head')

<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
@endsection

@section('content')
@include('layouts.header')

<section id="aboutsection" class="contact-sec">
<div class="container">
<div class="row mt-5">



<div class="col-md-10 ">
<h1 class=" lightGreen mt50  heading" itemprop="headline">Leave us a Message <span class="caret"></span></h1>
<!-- <p id="livechat" class="livechat">Right Now we are offline Please Fill this form we will get back you soon.</p> -->
</div>

<!-- <div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>Thanks for contacting me, I will get back to you soon!</strong>
</div> -->

@if(session()->has('success'))
    <div class="container alert alert-success" role="alert">
    {{ session()->get('success') }}
    </div>

@endif

<div class="descriptionBox mb50" itemprop="description">
<form action="{{ url('/contacts') }}"  id="ContactIndexForm" method="POST" accept-charset="utf-8">
@csrf 
<!-- <div style="display:none;">
<input type="hidden" name="_method" value="POST" />
</div>  -->
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12">
<div class="form-group">
<label for="inputTextl1" class="control-label ml-3">Name</label>
<input name="name" class="form-control ml-3" maxlength="255" type="text" id="ContactName" required="required" /> </div>
</div>
<div class="col-md-6 col-sm-6 col-xs-12">
<div class="form-group">
<label for="inputTextl1" class="control-label ml-3">Email</label>
<input name="email" class="form-control ml-3" maxlength="255" type="email" id="ContactEmail" required="required" /> </div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="form-group">
<label for="inputTextl1" class="control-label ml-3">Comment</label>
<textarea name="comment" class=" form-control ml-3" placeholder="Type here..." cols="30" rows="6" id="ContactQuery" ></textarea> </div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="form-group">
<div class="g-recaptcha ml-3" data-sitekey="6LcqaeQZAAAAAFZCuyMhGgqhDuHzcZqWfqXJOsiU" data-callback="callback"></div>
<span id="captcha-error" style="color: red"></span>
</div>
</div>
</div>
<div class="clearfix"></div>
<div class="form-group mt10">
<input type="submit" name="submit" class="blue-btn ml-3" value="Send Message" >
</div>
</form></div>
<script src="//code.jquery.com/jquery-1.10.2.js" type="text/javascript"></script>
<script type="text/javascript">
         
          var callback = function() {
            $("#captcha-error").empty();
        };

        $("form").submit(function(event) {
            var recaptcha = $("#g-recaptcha-response").val();
            if (recaptcha === "") {
                event.preventDefault();
                $("#captcha-error").text("Please check the recaptcha!");
            }
        });

         
$('#reload').click(function() {
	var $captcha = $("#img-captcha");
    $captcha.attr('src', $captcha.attr('src')+'?'+Math.random());
	return false;
});
</script>
<script type="text/javascript">
function showchat(){ 
document.getElementById("livechat").style.display = "block";
}
</script>
<style>
.mt20{padding-bottom:20px;}

</style>
<script src='https://www.google.com/recaptcha/api.js' type="text/javascript"></script>

<div class="clearfix"></div>
</div>
</div>

</section>


@include('layouts.footer')
@endsection

@section('footer')

@endsection