<!DOCTYPE html>
<html>
    <head>
      <title>LaTienda</title>
      
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
      <link rel="stylesheet" href="/css/all.css">

      <script src="/js/all.js"></script>

      <meta name="_token" content="{!! csrf_token() !!}"/> 
    </head>
    <body>
        
        <div class="container">
            
            @if (Request::is('admin*'))
              @include('partials.admin_nav_bar')
            @else
              @include('partials.client_nav_bar')
            @endif
            
            @include('partials.flash')
                
            @yield('content')
                          

        </div>
        
        <script type="text/javascript">
          $.ajaxSetup({
             headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
          });
        </script>
        
        @yield('footer')
        
    </body>
</html>