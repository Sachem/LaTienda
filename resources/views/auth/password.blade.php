@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Password reset</div>
				<div class="panel-body">

          <form method="POST" action="/password/email" class="form-horizontal">
              {!! csrf_field() !!}

              @if (count($errors) > 0)
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              @endif

              <div class="form-group">
                  <label class="col-md-4 control-label">Email</label>
                  <div class="col-md-6">
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                  </div>
              </div>

              <div class="form-group">
                  <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Send Password Reset Link
                    </button>
                  </div>
              </div>
          </form>
        </div>
			</div>
		</div>
	</div>
</div>            
@endsection