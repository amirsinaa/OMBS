
@extends('layouts.app')
@section("content")

<div class="container">
  <h2>Auction users list</h2><br><br>
  <table class="table">
    <tbody>
      <tr>
        <td><b>name</b></td>
        <td><b>email</b></td>
        <td><b>created</b></td>
      </tr>
      @foreach($users as $item)
        <tr>
          <td>{{$item->name}}</td>
          <td>{{$item->email}}</td>
          <td>{{$item->created_at}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@stop
