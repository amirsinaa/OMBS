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
                  <th>DIN</th>
                  <th>Title</th>
                  <th>Expiry date</th>
                </tr>
              </thead>
              <tbody class="text-center">
                @foreach ($products_list as $product)
                  <tr>
                    <td>{{ $product->DIN }}</td>
                    <td>{{ link_to('product/' . $product->id, $product->title) }}</td>
                    <td>{{ $product->timelimit }}</td>
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
@endsection
