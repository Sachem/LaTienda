<!DOCTYPE html>
<html>
    <head>
      <title>Lara1st</title>
      <link rel="stylesheet" href="/css/app.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
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