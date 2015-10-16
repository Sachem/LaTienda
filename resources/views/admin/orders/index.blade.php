@extends('app')

@section('content')
  
  <h1>Orders</h1>
  
  <table class="table table-striped table-bordered table-condensed clickable-rows">
    <thead>
      <tr>
        <th>#</th>
        <th>User</th>
        <th>Order total</th>
        <th>Order created</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($orders as $order)
      <tr onclick="document.location = '{{ url('/admin/order/'.$order->id) }}';">
        <td>{{ $order->id }}</td>
        <td>{{ $order->user->username }}</td>
        <td>{{ $order->payment->total }}</td>
        <td>{{ $order->created_at }}</td>
        <td>{{ $order->payment->status }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  
  @include('partials.pagination', ['paginator' => $orders])
  
@stop
