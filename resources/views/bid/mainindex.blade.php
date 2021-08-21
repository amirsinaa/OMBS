@section('head')
@extends('layouts.app')

@stop

@section('content')

<div class="container">
  <h3>Arrived Bids | <a href="{{ URL::to('sentbids') }}">Sent Bids</a></h3>
  <table class="table">
    <tbody>
      <tr>
        <td><b> @lang('c.Name')</b></td>
        <td><b>Price</b></td>
        <td><b> @lang('c.Count of the bids')</b></td>
        <td><b>  @lang('c.Closing this Auction')</b></td>
      </tr>
      @foreach ($main_bid_products as $bid_item)
        <tr>
          <td>
            <a href="{{ URL::to('bids/' . $bid_item->product_id) }}"> <h5>{{ $bid_item->title }}</h5></a>
          </td>
          <td>{{ $bid_item->maxbidprice }} </td>
          <td>{{ $bid_item->bids_count }} </td>
          <td>
            @if ($bid_item->opened ==1)
              {{Form::open(array('action' => 'ProductController@productClose')) }}
              {{ Form::hidden('product_id', $bid_item->product_id) }}
              {{ Form::submit( trans('c.Closing Auction') , ['class' => 'btn btn-success', 'style' => ""]) }}
              {{ Form::close() }}
              @else
                {{ Form::open(array('action' => 'ProductController@productOpen')) }}
                {{ Form::hidden('product_id', $bid_item->product_id) }}
                {{ Form::submit('Reopening Auction' , ['class' => 'btn btn-danger', 'style' => ""]) }}
                {{ Form::close() }}
            @endif
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@stop
