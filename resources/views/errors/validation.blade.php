@if ($errors->any())

  <ul class="alert alert-danger">

      Please fix the following errors:<br /><br />
      
      @foreach ($errors->all() as $error)

        <li>{{ $error }}</li>

      @endforeach

  </ul>

@endif