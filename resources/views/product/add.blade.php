
@extends('layouts.new_medicine_layout')

@section('head')

@stop
@section('content')

<div id="components">
  <div class="col-sm-12">
    <productadd-component workuri="{{url('/')}}" currency_list_json="{{$currency_list_json}}" mycurrency_id="{{$mycurrency_id}}"></productadd-component>
  </div>
</div>

@stop
