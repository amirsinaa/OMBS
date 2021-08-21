@section('head')
@extends('layouts.app')
@section('content')

  <h3>@lang('c.Arrived orders') | <a href="{{ URL::to('sent_orders') }}"> @lang('c.Sent Orders')</a></h3>
  <br><br>
  <table class="table table-hover">
    <thead class="text-center">
      <tr>
        <th>Order ID</th>
        <th>DIN</th>
        <th>Title</th>
        <th>Final price</th>
      </tr>
    </thead>
    <tbody class="text-center">
      @foreach ($orders as $key => $order)
        <tr>
          <td>{{ $key }}</td>
          <td>{{ $order[0]['DIN'] }}</td>
          <td>{{ $order[0]['title'] }}</td>
          <td>{{ $order[0]['bid'] }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop
