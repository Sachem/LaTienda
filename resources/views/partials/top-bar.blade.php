<div class="top-bar" style="border-bottom:#444 1px dashed;padding:10px;display:block;height:40px;background-color: #ddd;margin-bottom:10px;">
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