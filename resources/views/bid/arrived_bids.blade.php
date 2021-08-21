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
	<h3>Arrived Bids |<a href="{{ URL::to('sentbids') }}">Sent Bids </a></h3>
	<table class="table table-hover">
		<thead class="text-center">
				<tr>
						<th>
								<b>{{ trans('c.Sender') }}</b>
						</th>
						<th>
								<b>{{ trans('c.Name') }}</b>
						</th>
						<th>
								<b>{{ trans('c.Bid') }}</b>
						</th>
						<th>
								<b>Date</b>
						</th>
						<th>
								<b>Delete</b>
						</th>
							<th>
								<b>Put it in the basket of the Bidder</b>
								<h5 style="color:blue" >Choose from Bidders! </h5>
						</th>
				</tr>
		</thead>
		<tbody class="text-center">
			@foreach ($bid_products as $bid_item)
				<tr>
					<td>
							@isset($bid_item->cost_name)
							{{ $bid_item->cost_name }}
							@endisset
							<a href="mailto:{{ $bid_item->cost_email }}">{{ $bid_item->cost_email }}</a>
					</td>
					<td>{{ $bid_item->title }}</td>
					<td>{{ $bid_item->price }} {{ $bid_item->currency }}</td>
					<td>  {{ $bid_item->bids_created_at }} </td>
					<td>
						<a href="{{ URL::to('bid/delete/' . $bid_item->bidsid . '/arrived') }}" onclick="if (!confirm('Are you sure to delete this item ? ')) {return false;};"> <i class="fa fa-2x fa-trash" style="color:red !important"></i> </a>
					</td>
						<td>
							<addtobidderbasket-component
							workuri="{{ url('/') }}"
							product_id="{{ $bid_item->product_id }}"
							admin_id="{{ $bid_item->admin_id }}"
							member_id="{{ $bid_item->member_id }}"
							bid ="{{ $bid_item->price }}"
							email ="{{ $bid_item->cost_email }}"></addtobidderbasket-component>
					</td>
				</tr>
				<tr class="border_bottom">
					<td colspan ="6">
						<h5>{{ trans('c.Messages') }}</h5>
						<a name="bidsid_{{ $bid_item->bidsid }}"></a>{{ $bid_item->message }}<br>
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
</div>
@stop
