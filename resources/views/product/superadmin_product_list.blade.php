@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-md-10 pull-right"><h2>Moderation</h2></div>
    <ul class="mylist list-group list-group-flush">
      @foreach ($products as $product)
        <li class="inline list-group-item">
          <h4>
            {{ link_to('product/' . $product->id, $product->title) }}
          </h4>
          <p>
            Seller :<b>{{ $product->user_name }} </b>
            ({{ $product->user_email }})
          </p>
          <p>
            {{ trans('c.Price') }}: <b>{{ $product->opening_price }}</b>{{ $product->code }} ({{ $product->currency }})
          </p>
          <a class="btn btn-danger btn-sm" style="line-height : 20px;" href="{{ URL::to('product/superadmindelete/' . $product->id) }}"  onclick="if (!confirm('Are you sure to delete this auction ? ')) {return false;};">Delete</a>
        </li>
      @endforeach
    </ul>
  </div>
  <div>
    <?php echo $products->links(); ?>
  </div>
@stop