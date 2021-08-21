@section('head')
@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="border-0 card">
          <div class="p-0 card-body table-responsive">
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
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif

          </div>
        </div>
      </div>
    </div>
  </div>
@stop
