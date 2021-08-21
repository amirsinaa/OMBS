@extends('layouts.register_layout')

@section('content')
	<div class="text-center justify-content-center">
		<div class="card" style="border:0 !important;">
			<div class="card-body" syle="border:0!important;padding: 5em;">
        <h3 class="text-center custom-card-header">Register</h3>
        <form method="POST" class="row" action="{{ route('register') }}">
          @csrf
          <div class="form-group col-xs-12 col-md-6">
            <div class="">
              <input id="name" type="text" class="form-control flat-input @error('name') is-invalid @enderror" placeholder="Full name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
              @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>
          <div class="form-group col-xs-12 col-md-6">
            <div class="">
              <input id="province" type="text" class="form-control flat-input @error('province') is-invalid @enderror" placeholder="Province" name="province" value="{{ old('province') }}" required autocomplete="province" autofocus>
              @error('province')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <div class="form-group col-xs-12 col-md-6">
            <div class="">
              <input id="country" type="text" class="form-control flat-input @error('country') is-invalid @enderror" placeholder="Country" name="country" value="{{ old('country') }}" required autocomplete="country" autofocus>
              @error('country')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <div class="form-group col-xs-12 col-md-6">
            <div class="">
              <input id="city" type="text" class="form-control flat-input @error('city') is-invalid @enderror" placeholder="City" name="city" value="{{ old('city') }}" required autocomplete="city" autofocus>
              @error('city')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <div class="form-group col-xs-12 col-md-6">
            <div class="">
              <input id="pharma_address" type="text" class="form-control flat-input @error('pharma_address') is-invalid @enderror" placeholder="Pharmacy address" name="pharma_address" value="{{ old('pharma_address') }}" required autocomplete="pharma_address" autofocus>
              @error('pharma_address')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <div class="form-group col-xs-12 col-md-6">
            <div class="">
              <input id="email" type="email" class="form-control flat-input @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email">

              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <div class="form-group col-xs-12 col-md-6">
            <div class="">
              <input id="postal_code" type="number" class="form-control flat-input @error('postal_code') is-invalid @enderror" placeholder="Posttal code" name="postal_code" value="{{ old('postal_code') }}" required autocomplete="postal_code">

              @error('postal_code')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <div class="form-group col-xs-12 col-md-6">
            <div class="">
              <input id="phone_number" type="string" class="form-control flat-input @error('phone_number') is-invalid @enderror" placeholder="Phone number" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number">

              @error('phone_number')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <div class="form-group col-xs-12 col-md-6">
            <div class="">
              <input id="ACC_NUM" type="number" class="form-control flat-input @error('ACC_NUM') is-invalid @enderror" placeholder="ACC Number" name="ACC_NUM" value="{{ old('ACC_NUM') }}" required autocomplete="ACC_NUM">

              @error('ACC_NUM')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
          </div>

          <div class="form-group col-xs-12 col-md-6">
            <div class="">
                <input id="password" type="password" class="form-control flat-input @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="new-password">

                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
          </div>

          <div class="form-group col-xs-12 col-md-6">
            <div class="">
              <input id="password-confirm" type="password" class="form-control flat-input" name="password_confirmation" placeholder="Password confirmation" required autocomplete="new-password">
            </div>
          </div>

          <div class="form-group col-xs-12 col-md-6">
            <button type="submit" class="px-5 btn btn-primary main-color-background border-radius-25" style="width: 100%;">
              {{ __('Register') }}
            </button>
          </div>
        </form>
			</div>
		</div>
	</div>
@endsection
