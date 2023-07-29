<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin</title>

    <!-- Scripts -->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{asset('plugins/jvectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet">
    <!-- App css -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/icons.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/metisMenu.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" />
    <!-- <link href="{{ asset('assets/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css"> -->
    <!-- <link href="{{asset('plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" /> -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" /> -->
 


</head>

<body>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script> -->
    <script src="{{asset('js/metisMenu.min.js')}}"></script>
    <script src="{{asset('js/waves.min.js')}}"></script>
    <script src="{{asset('js/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('js/app.js') }}" defer></script>
   <script src="{{asset('plugins/tinymce/tinymce.min.js')}}" type='text/javascript'></script>
   <!-- <script src="{{asset('plugins/select2/select2.min.js')}}"></script> -->
   
    <!-- <script src="{{asset('pages/jquery.form-editor.init.js')}}" defer></script>  -->
    <!-- <script src="{{ asset('js/app1.js') }}" defer></script> -->
    
    

    @yield('footer')
</body>

</html>