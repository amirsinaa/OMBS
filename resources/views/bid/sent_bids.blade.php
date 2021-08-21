@extends('layouts.app')
@section('head')
  <style>
    tr.border_bottom td {
    border-bottom : 1pt solid black;
    }
  </style>
@stop

@section('content')
  <div class="container">
    <h3><a href="{{ URL::to('mainbids') }}">Arrived Bids</a> | Sent Bids</h3>
    <form action="order" method="post" accept-charset="UTF-8">
      <table class="table">
          <thead class="text-center">
            <tr>
              <th><b>{{ trans('c.Sender') }}</b></th>
              <th><b>{{ trans('c.Name') }}</b></th>
              <th><b>{{ trans('c.Bid') }}</b></th>
              <th><b>Date</b></th>
            </tr>
          </thead>
          <tbody class="text-center">
              @foreach ($bid_products as $bid_item)
                <tr>
                  <td>
                    {{ $bid_item->cost_name }}
                    <br>
                    <a href="mailto:{{ $bid_item->cost_email }}">{{ $bid_item->cost_email }}</a>
                  </td>
                  <td>{{ $bid_item->title }}</td>
                  <td>{{ $bid_item->price }} {{ $bid_item->currency }}</td>
                  <td>  {{ $bid_item->bids_created_at }} </td>
                </tr>
                <tr class="border_bottom">
                  <td colspan="4">
                    <h3>{{ trans('c.Messages') }}</h3>
                    <a name="bidsid_{{ $bid_item->bidsid }}"></a>
                    {{ $bid_item->message }}
                    <br>
                    @if ($bid_item->bid_id_count >0)
                      <div id="message_place">
                        <showmessages-component workuri="{{ url('/') }}" bidid="{{ $bid_item->bidsid }}"  messages_count = "{{ $bid_item->bid_id_count }}" ></showmessages-component>
                      </div>
                    @endif
                    <br>
                    <a href="{{ URL::to('message/add/' . $bid_item->bidsid . '/' . $bid_item->customer_id . '/' . $bid_item->product_id) }}">  Write a message!</a>
                  </td>
                </tr>
              @endforeach
          </tbody>
      </table>
    </form>
  </div>
@stop
