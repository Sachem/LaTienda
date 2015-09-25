<!DOCTYPE html>
<html>
    <head>
      <title>LaTienda</title>
      <link rel="stylesheet" href="/css/app.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
      <script src="/js/jquery.min.js"></script>
      <script src="/js/bootstrap.min.js"></script>
      <script src="/js/dropzone.js"></script>
      <!--
      
      http://tutsnare.com/post-data-using-ajax-in-laravel-5/
      
      <meta name="_token" content="{!! csrf_token() !!}"/>
      
      -->
    </head>
    <body>
        
        <div class="container">
            
            
            @include('partials.top-bar')
            
            @include('partials.nav-bar')
            
            @include('partials.flash')
                
            @yield('content')
                          

        </div>
        <!--<script type="text/javascript">
          $.ajaxSetup({
             headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
          });
        </script>-->
    </body>
</html>