@extends('layouts.app')
@section('title')
@endsection
@section('head')
  <style>
    .carousel-inner>.item>img,
    .carousel-inner>.item>a>img {
      width : 100%;
      margin: auto;
    }
  </style>
  <script>
    $(document).ready(function() {
      var time_limit_stored_data = $("#timelimit").html();
      var time_limit_stored_data_pattern = new Date();
      var time_limit_stored_data = new Date(time_limit_stored_data.replace(/-/g, '/'));
      if (time_limit_stored_data > time_limit_stored_data_pattern) {
        $("#timelimit").css('color', 'green');
      } else {
        $("#timelimit").css('color', 'red');
      }
    });
  </script>
@endsection

@section('content')
  @php
    $get_current_date = Carbon::now()->toDateString();
  @endphp

  <div class="container">
    <div class="justify-content-center">
      <div class="text-center row justify-content-center inline-style-replacement-1">
        <h1>
          {{ $product->title }}
          @if ($product->opened == 0)
            <span class="red-color">- Closed Auction</span>
          @endif

          @if ($product->timelimit < $get_current_date)
            <span class="red-color">- Auction Time Expired</span>
          @endif

          <span class="product-span-box-3">- Seller : {{ $product->user_name }}</span>
        </h1>
      </div>
      <div class="row custom-product-row">
        <div class="col-xs-12 col-md-6">
          <span class="product-span-box-2">
            Description :
          </span>
          <span class="product-span-box">
            {{ $product->description }}
          </span>
        </div>
        <div class="col-xs-12 col-md-6">
          <span class="product-span-box-2">
            DIN:
          </span>
          <span class="product-span-box">
            {{ $product->DIN }}
          </span>
        </div>
        <div class="col-xs-12 col-md-6">
          <span class="product-span-box-2">
            Quantity :
          </span>
          <span class="product-span-box">
            {{ $product->med_quantity }}
          </span>
        </div>
        <div class="col-xs-12 col-md-6">
          <span class="product-span-box-2">
            Pack Size :
          </span>
          <span class="product-span-box">
            {{ $product->pack_size }}
          </span>
        </div>
        <div class="col-xs-12 col-md-6">
          <span class="product-span-box-2">
            UPC:
          </span>
          <span class="product-span-box">
            {{ $product->UPC }}
          </span>
        </div>
        <div class="col-xs-12 col-md-6">
          <span class="product-span-box-2">
            LOT_number:
          </span>
          <span class="product-span-box">
            {{ $product->LOT_number }}
          </span>
        </div>
        <div class="col-xs-12 col-md-6">
          <span class="product-span-box-2">
            Brand Generic:
          </span>
          <span class="product-span-box">
            {{ $product->brand_generic }}
          </span>
        </div>
        <div class="col-xs-12 col-md-6">
          <span class="product-span-box-2">
            Generic :
          </span>
          <span class="product-span-box">
            {{ $product->generic }}
          </span>
        </div>
        <div class="col-xs-12 col-md-6">
          <span  class="product-span-box-2">
            Price
          </span>
          <spanclass="product-span-box">
            {{ $product->opening_price }} {{ $product->currency_code }} ({{ $product->currency_currency }})
          </spanclass=>
        </div>
        <div class="col-xs-12 col-md-6">
          <span class="product-span-box-4">
           Medicine expire date :
          </span>
          <span id="timelimit"class="product-span-box">
            {{ $product->timelimit }}
          </span>
        </div>
      </div>
    </div>
    <div class="row custom-product-row-2">
    </div>
    <div class="col-xs-12">
      <div class="@if ($product->admin_id == Auth::user()->id) pt-5 mt-5 @endif well well-sm">
          @if (Auth::check())
            @if ($product->opened == 0)
              <form class="text-align" accept-charset="UTF-8" action="{{ URL::to('bid/add') }}" method="post">
                <h5 class="red-colortext-align:center;font-size : 14px">** You can't bid the auction is closed**</h5>
                <fieldset disabled="disabled">
                  <h4>
                    {{ trans('c.Enter') }} {{ $minprice }} {{ $product->currency_code }}
                    ({{ $product->currency_currency }}) or more:
                  </h4>
                  <div class="form-group">
                    {{ Form::label('bid_value', trans('c.Bid value') . ' : ') }}
                    {{ Form::text('price', null, ['class' => 'form-control', 'style' => 'width : 100%;height : 30px;']) }}

                    <br>
                    {{ Form::label('message', trans('c.Message') . ' : ') }}
                    {{ Form::textarea('message', null, ['class' => 'form-control', 'style' => 'width : 100%;height : 70px;']) }}
                  </div>
                  <input class="btn btn-info w-100" name="submit" type="submit" value="{{ trans('c.Place bid') }}" />
                  </input>
                </fieldset>
              </form>
            @elseif ($product->timelimit < $get_current_date)
              <form class="text-center" accept-charset="UTF-8" action="{{ URL::to('bid/add') }}" method="post">
                <h5 class="red-colortext-align:center;font-size : 14px">** you can't bid auction is expired **</h5>
                <fieldset disabled="disabled">
                  <h4 style="font-size : 15px;">
                    {{ trans('c.Enter') }} {{ $minprice }} {{ $product->currency_code }}
                    ({{ $product->currency_currency }}) or more:
                  </h4>
                  <div class="form-group">
                    {{ Form::label('bid_value', trans('c.Bid value') . ' : ') }}
                    {{ Form::text('price', null, ['class' => 'form-control', 'style' => 'width : 100%;height : 30px;']) }}
                    <br>
                    {{ Form::label('message', trans('c.Message') . ' : ') }}
                    {{ Form::textarea('message', null, ['class' => 'form-control', 'style' => 'width : 100%;height : 70px;']) }}
                  </div>
                  <input class="btn btn-info" name="submit" type="submit" value="{{ trans('c.Place bid') }}" />
                  </input>
                </fieldset>
              </form>
            @elseif ($product->admin_id == Auth::user()->id)
              <div class="pt-4 text-center row justify-content-center">
                <div class="px-5 col-xs-12">
                  <a class="px-5 btn btn-success" href="{{ URL::to('product/edit/' . $product->id) }}" >
                    @lang('c.Edit')
                  </a>
                </div>
                <br>
                <div class="px-5 col-xs-12">
                  <a class="px-5 btn btn-danger" href="{{ URL::to('product/delete/' . $product->id) }}"  onclick="if (!confirm('Are you sure to delete this auction ? ')) {return false;};"> @lang('c.Delete')
                  </a>
                </div>
              </div>
            @else
              <form class="text-center" accept-charset="UTF-8" action="{{ URL::to('bid/add') }}" method="post">
                  <input name="_token" type="hidden" value="{{ csrf_token() }}">
                  <input name="product" type="hidden" value="{{ $product->id }}" />
                  <input name="admin_id" type="hidden" value="{{ $product->admin_id }}" />
                  <h4>
                    {{ trans('c.Enter') }} {{ $minprice }} {{ $product->currency_code }}
                    ({{ $product->currency_currency }}) or more:
                  </h4>
                  <input name="minprice" type="hidden" value="{{ $minprice }}" />
                  <div class="form-group">
                    {{ Form::label('bid_value', trans('c.Bid value') . ' : ') }}
                    {{ Form::text('price', null, ['class' => 'form-control', 'style' => 'width : 100%;height : 30px;']) }}

                    {{ Form::label('message', trans('c.Message') . ' : ') }}
                    {{ Form::textarea('message', null, ['class' => 'form-control', 'style' => 'width : 100%;height : 70px;']) }}
                  </div>
                  <input class="btn btn-info" name="submit" type="submit" value="{{ trans('c.Place bid') }}" />
                  </input>
              </form>
            @endif
          @elseif (!Auth::check())
            <a href="{{ URL::route('login') }}">
              <button class="btn btn-primary">
                <i class="fa fa-legal fa-1x ">
                </i>
                Bid now
                <br>
                <i class="fa fa-sign-in fa-1x ">
                </i>
                {{ trans('c.Please Login') }}
                </br>
              </button>
            </a>
          @endif
          <br> <br>
      </div>
    </div>
  </div>
@endsection
