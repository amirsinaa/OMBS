@extends('layouts.app')

@section('content')

<div class='col-lg-4 col-lg-offset-4'>
  @if ( count( $errors ) > 0 )
    @foreach ($errors->all() as $error)
      <div class='bg-danger alert'>{{ $error }}</div>
    @endforeach
  @endif
  <h2>{{ trans('c.Currency setting') }}</h2>
  {{ Form::model($user, array('route' => array('user/edit', $user->id))) }}
  {{ Form::hidden('onlycurrency', 1) }}
  <div class='form-group'>
    {{ Form::label('', trans('c.Currency') . " : " ) }}
    {{ Form::select('currency_id', $currency_list, Request::old('currency_id'), [ 'class' => 'form-control']) }}
  </div>
  <div class='form-group'>
    {{ Form::submit(trans('c.Save'), ['class' => 'btn btn-primary', 'id' => 'create_user_btn']) }}
  </div>
  {{ Form::close() }}
  <br>
  <h2><i class='fa fa-user'></i>  {{ trans('c.User data Setting') }}</h2>
  {{ Form::model($user, array('route' => array('user/edit', $user->id))) }}
  {{ Form::hidden('onlycurrency', 0) }}

  <div class='form-group'>
    {{ Form::label('name', trans('c.nameOfUser') . " : ") }}
    {{ Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) }}
  </div>

  <div class='form-group'>
    {{ Form::label('city', 'city') }}
    {{ Form::text('city', null, ['placeholder' => 'city', 'class' => 'form-control']) }}
  </div>

  <div class='form-group'>
    {{ Form::label('country', 'country') }}
    {{ Form::text('country', null, ['placeholder' => 'country', 'class' => 'form-control']) }}
  </div>

  <div class='form-group'>
    {{ Form::label('postal_code', 'postal_code') }}
    {{ Form::text('postal_code', null, ['placeholder' => 'postal_code', 'class' => 'form-control']) }}
  </div>

  <div class='form-group'>
    {{ Form::label('province', 'province') }}
    {{ Form::text('province', null, ['placeholder' => 'province', 'class' => 'form-control']) }}
  </div>

  <div class='form-group'>
    {{ Form::label('pharma_address', 'pharma_address') }}
    {{ Form::text('pharma_address', null, ['placeholder' => 'pharma_address', 'class' => 'form-control']) }}
  </div>

  <div class='form-group'>
    {{ Form::label('phone_number', 'phone_number') }}
    {{ Form::text('phone_number', null, ['placeholder' => 'phone_number', 'class' => 'form-control']) }}
  </div>

  <div class='form-group'>
    {{ Form::label('ACC_NUM', 'ACC_NUM : ') }}
    {{ Form::text('ACC_NUM', null, ['placeholder' => 'ACC_NUM', 'class' => 'form-control']) }}
  </div>

  <div class='form-group'>
    {{ Form::label('email', 'Email : ') }}
    {{ Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control', 'id' => 'email']) }}
  </div>

  <div class='form-group'>
    {{ Form::label('password', trans('c.Password') . " : " ) }}
    {{ Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) }}
  </div>

  <div class='form-group'>
    {{ Form::label('password_confirmation', trans('c.Confirm Password') . " : " ) }}
    {{ Form::password('password_confirmation', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) }}
  </div>

  <div class='form-group'>
    {{ Form::submit(trans('c.Save'), ['class' => 'btn btn-primary', 'id' => 'create_user_btn']) }}
  </div>

  {{ Form::close() }}
</div>

@stop
