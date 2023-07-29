@extends('layouts/unlock')

@section('headcontent')
  <title>Unlock Ninja</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/sweetalert/css/sweetalert.css') }}" />
  
@endsection

@section('content')
@include('layouts.header')
  <div class="container">
    <section id="stepsection">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <script src='https://www.google.com/recaptcha/api.js' type="4baac7977f397149c6a03891-text/javascript"></script>
          <section class="loginPP">
          
            <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-6 col-sm-8 col-12 login-container">
                <span class="bgcolor">
                  <h1 class="heading Alignc" style="margin-top: 0px;">Login Now</h1>
                  @if(session()->has('error'))
                    <div class="alert alert-danger">
                    {{ session()->get('error') }}
                    </div>
                  @endif
                  <form  id="ClientLoginForm" method="POST" action="{{ url('/clients/login') }}">
                    @csrf
                    <div style="display:none;">
                      <input type="hidden" name="_method" value="POST" />
                    </div>
                    <div class="donation_cause1">
                      <div class="spn fl">
                        <fieldset class="scheduler-border">
                          <div class="control-group">
                          <input type="text" name='email' id="username" class="form-control p_input" placeholder="UserID / Email" value="{{ old('username') }}" autofocus>
                          @if($errors->has('email'))
                          <p class="text-danger"> {{ $errors->first('email') }} </p>
                          @endif
                          </div>
                        </fieldset>
                        <span id="username-error" style="color: red"></span>
                        <fieldset class="scheduler-border">
                          <div class="control-group">
                          <input type="password" name="password"  id="password" class="form-control p_input" placeholder="password" >
                          @if($errors->has('password'))
                          <p class="text-danger"> {{ $errors->first('password') }} </p>
                          @endif
                          </div>
                        </fieldset>
                        <span id="password-error" style="color: red"></span>
                        <!-- <div class="recaptchaPP">
                          <div class="g-recaptcha"  data-sitekey="6LcqaeQZAAAAAFZCuyMhGgqhDuHzcZqWfqXJOsiU"></div>
                        </div> -->
                        <div class="recaptchaPP">
                          <div class="g-recaptcha" data-sitekey="6LcqaeQZAAAAAFZCuyMhGgqhDuHzcZqWfqXJOsiU" data-callback="callback"></div>
                          <span id="captcha-error" style="color: red"></span>
                        </div>
                        <div class="submit">
                          <input name="submit" class="btn-unlock2" type="submit" value="Log in" />
                        </div>
                        <div class="cl"></div>
                        <a href="{{ url('/clients/forgotpassword') }}">Forgot Password ?</a>
                      </div>
                      <div class="cl"></div>
                    </div>
                  </form>
                </span>
              </div>
              <div class="col-md-3"></div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </section>
  </div>
  @include('layouts.footer')
@endsection

@section('footer')
    <script type="text/javascript" src="{{ asset('assets/vendors/sweetalert/js/sweetalert.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/sweetalert/js/sweetalert-dev.js') }}"></script>
    <script src='https://www.google.com/recaptcha/api.js' type="text/javascript"></script>
    <script type="text/javascript">
         
          var callback = function() {
            $("#captcha-error").empty();
        };

        $("form").submit(function(event) {
            var recaptcha = $("#g-recaptcha-response").val();
            var email = $("#username").val();
            var password = $("#password").val();


            if (email === "") {
              event.preventDefault();
              $("#username-error").text("Please enter username.");
            }

            else if (password === "") {
              event.preventDefault();
              $("#password-error").text("Please enter password.");
            }
            else if (recaptcha === "") {
              event.preventDefault();
                $("#captcha-error").text("Please check the recaptcha!");
            }

            // $("#username").click(function() {
            //   $(' #username-error').remove();
            // });
            // $("#password").click(function() {
            //   $(' #password-error').remove();
            // });

            if(email != ""){
              $("#username-error").remove();
            }

            if(password != ""){
              $("#password-error").remove();
            }
            
            
        });

         
$('#reload').click(function() {
	var $captcha = $("#img-captcha");
    $captcha.attr('src', $captcha.attr('src')+'?'+Math.random());
	return false;
});
</script>
    
    <!-- @if (session('error'))
        <script type="text/javascript">
            swal({
                title: "Error!",
                text: "<?= session('error'); ?>",
                type: "error",
            });
        </script>
    @endif -->
@endsection
