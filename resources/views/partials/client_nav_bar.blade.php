<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        
      @if (Auth::check() && Auth::user()->admin == 1)
        <a class="navbar-brand" href="/admin">Client</a>
      @else
        <a class="navbar-brand" href="#">Client</a>            
      @endif
      
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="{{ url('/basket') }}">Basket</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories <span class="caret"></span></a>
          <ul class="dropdown-menu">
    
            @foreach ($categories as $category)
            <li><a href='{{ url('category/'.$category->id.'/'.str_slug($category->name)) }}'>{{ $category->name }}</a></li>
            @endforeach
            
          </ul>
        </li>
        @if (Auth::check())
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">User Panel <span class="caret"></span></a>
            <ul class="dropdown-menu">

              <li><a href='{{ url('account/details') }}'>Your Details</a></li>
              <li><a href='{{ url('account/orders') }}'>Your Orders</a></li>

            </ul>
          </li>
        @endif
      </ul>
        
      <ul class="nav navbar-nav navbar-right">
        <li>
            @include('partials.login_bar')
        </li>  
      </ul>
        
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>