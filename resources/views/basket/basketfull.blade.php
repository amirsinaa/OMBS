
@extends('layouts.app')
@section('head')

@stop
@section("content")

<div class="container">
  <basket-component workuri="{{url('/')}}" ></basket-component>
</div>

@stop
