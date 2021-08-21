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
                          <th>Auto bid</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody class="text-center">
                        @foreach ($products as $product)
                          <tr>
                            <td>{{ $product->DIN }}</td>
                            <td>{{ link_to('product/' . $product->id, $product->title) }}</td>
                            <td>{{ $product->timelimit }}</td>
                            <td>
                              @if ($product->auto_bid == 1)
                                Activate
                                @else

                                Deactive
                              @endif

                            </td>
                            <td>
                              <a class="btn btn-success" href="{{ URL::to('product/edit/' . $product->id) }}" >
                                  @lang('c.Edit')
                              </a>
                              <a class="btn btn-danger " href="{{ URL::to('product/delete/' . $product->id) }}"  onclick="if (!confirm('Are you sure to delete this auction ? ')) {
                                          return false;
                                      }
                                      ;">
                                      @lang('c.Delete')
                              </a>
                            </td>
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
