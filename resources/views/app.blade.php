<!DOCTYPE html>
<html>
    <head>
      <title>LaTienda</title>
      <link rel="stylesheet" href="/css/app.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
      <script src="/js/jquery.min.js"></script>
      <script src="/js/bootstrap.min.js"></script>
    </head>
    <body>
        
        <div class="container">
            
            
            @include('partials.top-bar')
            
            @include('partials.nav-bar')
            
            @include('partials.flash')
                
            @yield('content')
                          

        </div>
        
    </body>
</html>