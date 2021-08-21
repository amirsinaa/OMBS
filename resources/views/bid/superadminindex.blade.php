
@section('head')
@extends('layouts.app')

@stop

@section('content')
  <div class="container">
    <h1> All bids</h1>
    <form action="order" method="post" accept-charset="UTF-8">
      <table class="table">
        <tbody>
          <tr>
            <td><b>{{  trans('c.Name')}}</b></td>
            <td><b>{{  trans('c.Picture') }}</b></td>
            <td><b>Count of the bids</b></td>
          </tr>
          @foreach($main_bid_products as $bid_item)
            <tr>
              <td>
                <a href="{{URL::to('super_bid/'.$bid_item->product_id)}}">{{$bid_item->title}}
                </a>
              </td>
              <td>
                <a href="{{URL::to('bids/'.$bid_item->product_id)}}">
                  <img src="{{URL::asset('/uploads/products/thumbs/small/'.$bid_item->image1)}}" alt="picture" >
                </a>
              </td>
              <td>{{$bid_item->bids_count}} </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </form>
  </div>
@stop