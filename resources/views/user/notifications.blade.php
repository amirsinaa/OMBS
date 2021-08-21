@extends('layouts.app')

@section('head')
@stop

@section('content')
  @if (Auth::check() && Auth::user()->admin == 2)
    @forelse($notifications as $notification)
      <div class="alert alert-success" role="alert">
        [{{ $notification->created_at }}] New Pharmecy {{ $notification->data['name'] }} ({{ $notification->data['email'] }}) ({{ $notification->data['phone_number'] }}) ({{ $notification->data['postal_code'] }}) ({{ $notification->data['country'] }}) ({{ $notification->data['city'] }}) ({{ $notification->data['province'] }}) ({{ $notification->data['pharma_address'] }}) ({{ $notification->data['ACC_NUM'] }}) ({{ $notification->data['province'] }}) has just registered. <notificationmarkasread-component workuri="{{ url('/user') }}" notification_id="{{ $notification->id }}"
          ></notificationmarkasread-component>
      </div>
    @empty
      There are no new super-admin notifications.
    @endforelse
    @elseif (Auth::check() && Auth::user()->admin == 1)
      @forelse($notifications as $notification)
      <div class="alert alert-success" role="alert">
        [{{ $notification->created_at }}] New Pharmecy {{ $notification->data['name'] }} ({{ $notification->data['email'] }}) ({{ $notification->data['phone_number'] }}) ({{ $notification->data['postal_code'] }}) ({{ $notification->data['country'] }}) ({{ $notification->data['city'] }}) ({{ $notification->data['province'] }}) ({{ $notification->data['pharma_address'] }}) ({{ $notification->data['ACC_NUM'] }}) ({{ $notification->data['province'] }}) has just registered.<notificationmarkasread-component workuri="{{ url('/user') }}" notification_id="{{ $notification->id }}"
          ></notificationmarkasread-component>
      </div>
      <div class="alert alert-success" role="alert">
        <a href="{{ URL::to('basket/basketfull') }}">
          [{{ $notification->created_at }}] You have a new uncomfirmed order plase check your basket
        </a>
        <notificationmarkasread-component workuri="{{ url('/user') }}" notification_id="{{ $notification->id }}"
          ></notificationmarkasread-component>
      </div>
    @empty
      There are no new notifications.
    @endforelse
    @else

    You can't see this page.
  @endif

@stop
