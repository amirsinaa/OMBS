
@section('head')
@extends('layouts.app')
@stop
@section('content')

<div class="container" style="width : ">
  <h3><a href="{{ URL::to('mainbids') }}">Arrived Bids</a> | Sent Bids</h3>
  <form action="order" method="post" accept-charset="UTF-8">
    <table class="table">
        <tbody>
          <tr>
            <td><b>{{ trans('c.Name') }}</b></td>
            <td><b>Price</b></td>
            <td><b>@lang('c.Count of the bids')</b></td>
          </tr>
        @foreach ($main_bid_products as $bid_item)
          <tr>
            <td>
              <a href="{{ URL::to('sentbids/' . $bid_item->product_id) }}"> <h5>{{ $bid_item->title }} >> </h5>   </a>
            </td>
            <td>{{ $bid_item->maxbidprice }} </td>
            <td>{{ $bid_item->bids_count }} </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </form>
</div>
@stop
