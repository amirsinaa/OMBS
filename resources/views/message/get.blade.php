@extends('layouts.ajax')
@section('content')
  @foreach($messages as $message)
    <div class="alert alert-info">
      {{$message->Sender->name}}:{{$message->message}}
    </div>
  @endforeach
@stop
