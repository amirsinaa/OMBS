@extends('layouts.app')
@section('head')

@endsection

@section('content')

<div class="row">
  <ul class="mylist list-group list-group-flush">
      @foreach ($products as $product)
        <li class="inline list-group-item">
          <h4>
            {{ link_to('product/' . $product->id, $product->title) }}
          </h4>
          <p></p>
          <p>
            {{ trans('c.Price') }}: <b>{{ $product->opening_price }}</b>{{ $product->code }} ({{ $product->currency }})
          </p>
          <a class="btn btn-success" href="{{ URL::to('product/edit/' . $product->id) }}" >
            @lang('c.Edit')
          </a>
          <a class="btn btn-danger " href="{{ URL::to('product/delete/' . $product->id) }}"  onclick="if (!confirm('Are you sure to delete this auction ? ')) {return false;};">
            @lang('c.Delete')
          </a>
        </li>
      @endforeach

    </ul>
</div>

<div>
  <?php echo $products->links(); ?>
</div>

@stop
