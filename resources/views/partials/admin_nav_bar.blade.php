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
        <a class="navbar-brand" href="/">Admin</a>
      @else
        <a class="navbar-brand" href="#">Admin</a>            
      @endif
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="{{ Request::path() == 'admin/page' ? 'active' : '' }}"><a href="{{ url('/admin/page') }}">Pages <span class="sr-only">(current)</span></a></li>
        <li class="{{ Request::path() == 'admin/user' ? 'active' : '' }}"><a href="{{ url('/admin/user') }}">Users</a></li>
        <li class="{{ Request::path() == 'admin/order' ? 'active' : '' }}"><a href="{{ url('/admin/order') }}">Orders</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Catalog <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class="{{ Request::path() == 'admin/catalog/product' ? 'active' : '' }}"><a href="{{ url('/admin/catalog/product') }}">Products</a></li>
            <li class="{{ Request::path() == 'admin/catalog/category' ? 'active' : '' }}"><a href="{{ url('/admin/catalog/category') }}">Categories</a></li>
          </ul>
        </li>
      </ul>
 
      <ul class="nav navbar-nav navbar-right">
        <li>
            @include('partials.login_bar')
        </li>  
      </ul>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>