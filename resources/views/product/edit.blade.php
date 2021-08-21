
@extends('layouts.new_medicine_layout')

@section('head')


@stop
@section('content')

<div id="components">
  <div class="col-sm-12">
    <productedit-component workuri="{{url('/')}}" currency_list_json="{{$currency_list_json}}" product_json="{{$product_json}}"></productedit-component>
  </div>
</div>

@stop
