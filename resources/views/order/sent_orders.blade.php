@section('head')
@extends('layouts.app')
@section('content')

<table class="table table-hover">
  <thead class="text-center">
    <tr>
      <th>Order ID</th>
      <th>DIN</th>
      <th>Title</th>
      <th>Final price</th>
      <th>Order Time</th>
    </tr>
  </thead>
  <tbody class="text-center">
    @foreach ($orders as $key => $order)
      <tr>
        <td>{{$key}}</td>
        <td>{{$order[0]['DIN']}}</td>
        <td>{{$order[0]['title']}}</td>
        <td>{{$order[0]['bid']}}</td>
        <td>{{$order[0]['orders_created_at']}}</td>
      </tr>
    @endforeach
  </tbody>
</table>
@stop
