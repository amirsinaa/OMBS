@extends('layouts.app')
@section('title')
@stop
@section('head')
@stop

@section('content')

<div class="container">
  <div class="row">
    <div class="col-xs-6">
      @if (Auth::check())
        <form action="{{ URL::to('message/add') }}"  method="post" accept-charset="UTF-8">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="bid_id" value="{{ $bid_id }}" />
          <input type="hidden" name="recipient_id" value="{{ $recipient_id }}" />
          <input type="hidden" name="product_id" value="{{ $product_id }}" />
          <br>
          <div class='form-group'>
            {{ Form::label('message', "Message : ") }}
            {{ Form::textarea('message', null, [ 'class' => 'form-control', 'style' => 'width : 300px;' ] ) }}
          </div>
          <input class="btn btn-info"  type="submit" name="submit" value="OK" />
        </form>
      @endif

      <br><br>
    </div>
  </div>
</div>

@stop
