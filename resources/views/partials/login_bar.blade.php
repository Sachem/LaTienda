<div class="top-bar" style="padding:14px">
    <div style="float:right">
      @if (Auth::check())
      Logged in as <a href='{{ url('account/details') }}'>{{ Auth::user()->username }}</a> |
        <a href='{{ url('/auth/logout') }}'>Logout</a>
      @else
        <a href='{{ url('/auth/register') }}'>Register</a> |
        <a href='{{ url('/auth/login') }}'>Login</a>
      @endif
    </div>
</div>