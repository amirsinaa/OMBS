@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Dashboard</div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <ul class="mylist list-group list-group-flush">
            @foreach ($products_list as $product)
              <li class="list-group-item">
                <a style="display: block;" href="{{ URL::to('product/' . $product->id) }}">
                    {{ $product->title }}
                </a>
              </li>
            @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
