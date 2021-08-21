@extends('layouts.app')
@section('head')

@endsection
@section('content')


  <div class="row">
    @foreach ($products as $product)
      @php
        if(!empty($product->image1)){
          $foopath = URL::asset('/uploads/products/thumbs/small/' . $product->image1);
        } else{
          $foopath = URL::asset('/uploads/category/default.jpg');
        }
      @endphp
      <div class="my-4 col-md-3 col-sm-4">
        <div class="card " style="height : 480px;">
          <a href="{{ URL::to('product/' . $product->id) }}">
            <div class="card-header"  style="background:  url('<?php echo $foopath; ?>'); background-size: cover;height : 200px;"></div>
          </a>
          <div class="card-body">
            <h4>
              <a href="{{ URL::to('product/' . $product->id) }}">{{ $product->title }}</a>
            </h4>
            <div style="margin-top : 10px;">
              <div>{{ trans('c.Vendor') }} : <b>{{ $product->user_name }}</b></div>
              <p>{{ trans('c.Price') }}: <b>{{ $product->opening_price }}</b> {{ $product->code }} ({{ $product->currency }})</p>
              <div></div>
              <div>
                {{ trans('c.Category') }} : {{ trans('c . ' . $product->category_name) }}
              </div>
            </div>
            <br>
            <a href="{{ URL::to('product/' . $product->id) }}">
              <button class="btn btn-primary " type="button">@lang('c.Bid now')<i class="fa fa-arrow-circle-right fa-1x"></i></button>
            </a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  <div class="row">
    <div class="row" style="margin-top : 40px;"></div>
    <?php echo $products->links(); ?>
  </div>

@stop