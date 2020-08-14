@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="card col-md-6 col-sm-8 m-auto">
			<form action="{{route('auth.register')}}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="card-header">
					<h1>Register</h1>
				</div>

				<div class="card-body">
					<div class="form-group">
						<div class="custom-file">
							<input type="file" class="custom-file-input @error('photo') is-invalid @enderror" id="customFile" name="photo">
							@error('photo')
							<span class="invalid-feedback">{{ $message }}</span>
							@enderror
							<label class="custom-file-label text-mute" for="customFile">Choose Photo</label>
						</div>
					</div>

					<div class="form-group">
						<input type="text"
						class="form-control @error('names') is-invalid @enderror" name="names" placeholder="Names" value="{{ old('names') }}" required>
						@error('names')
							<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>
					<div class="form-group">
						<input type="text"
						class="form-control @error('last_names') is-invalid @enderror" name="last_names" value="{{ old('last_names') }}" placeholder="Last Names" required>
						@error('last_names')
							<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>
					<div class="form-group">
						<input type="email"
						class="form-control @error('email') is-invalid @enderror" name="email"  value="{{ old('email') }}" placeholder="Email" required>
						@error('email')
							<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>
					<div class="form-group">
						<input type="password"
						class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required>
						@error('password')
							<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>
					<div class="form-group">
						<input type="password"
						class="form-control @error('password') is-invalid @enderror" name="password_confirmation" placeholder="Password Confirmation" required>
					</div>
				</div>

				<div class="card-footer login-footer-container">
					<a href="/" class="btn btn-secondary">Cancel</a>
					<button type="submit" class="btn btn-primary">Register</button>
				</div>

			</div>
		</form>

	</div>
</div>
@endsection
