@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="card col-md-6 col-sm-8 m-auto">
			<form action="{{route('user.login')}}" method="POST">
				@csrf
				<div class="card-header">
					<h1>Login</h1>
				</div>

				{{-- {{dd($errors)}} --}}

				<div class="card-body">
					<div class="form-group">
						<input type="email"
						class="form-control @error('credentials') is-invalid @enderror" name="email" value="{{ old('email') }}"placeholder="Email" required>
						@error('credentials')
							<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>
					<div class="form-group">
						<input type="password"
						class="form-control @error('credentials') is-invalid @enderror" name="password" placeholder="Password" required>
						@error('credentials')
							<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>
				</div>

				<div class="card-footer login-footer-container">
					<a href="/" class="btn btn-secondary">Cancel</a>
					<button type="submit" class="btn btn-primary">Login</button>
				</div>

			</div>
		</form>
	</div>
</div>
@endsection
