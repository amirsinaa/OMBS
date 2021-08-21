@extends('layouts.login_layout')

@section('content')
	<div class="text-center justify-content-center">
		<div class="card" style="border:0 !important;">
			<div class="card-body" syle="border:0!important;padding: 5em;">
				<h3 class="text-center custom-card-header">Login</h3>
				<form style="padding:0 5em" method="POST" action="{{ route('login') }}">
					@csrf
					<div class="form-group row">
						<div class="text-center col-md-12 row justify-content-center">
							<input id="email" type="email" class="form-control flat-input @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
							@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<div class="form-group row">
						<div class="text-center col-md-12 row justify-content-center">
							<input id="password" type="password" placeholder="Password" class="form-control flat-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
							@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<div class="mb-4 form-group row">
						<div class="text-center col-md-12 row justify-content-center">
							<button type="submit" class="px-5 btn btn-primary main-color-background border-radius-25">
									{{ __('Login') }}
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
