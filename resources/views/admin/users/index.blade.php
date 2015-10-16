@extends('app')

@section('content')
  
  <h1>Users</h1>
  
  <table class="table table-striped table-bordered table-condensed clickable-rows">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Registered</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr onclick="document.location = '{{ url('/admin/user/'.$user->id) }}';">
        <td>{{ $user->id }}</td>
        <td>{{ $user->username }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->created_at }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  
  @include('partials.pagination', ['paginator' => $users])
  
@stop
