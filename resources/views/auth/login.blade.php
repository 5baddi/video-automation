@extends('layouts.auth')

@section('content')
<div class="row">
    <div class="col col-login mx-auto">
      <div class="text-center mb-6">
        <img src="{{ asset('assets/img/logo.png') }}" class="h-6" alt="">
      </div>
      <form class="card" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="card-body p-6">
          <div class="card-title text-center">Sign in</div>
          <div class="form-group">
            <label class="form-label">Email address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" aria-describedby="emailHelp" placeholder="Enter email" required autocomplete autofocus/>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <label class="form-label">
              Password
              @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}" class="float-right small">I forgot password</a>
              @endif
            </label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password"/>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <label class="custom-control custom-checkbox">
              <input type="checkbox" name="remember" class="custom-control-input" {{ old('remember') ? 'checked' : '' }}/>
              <span class="custom-control-label">Remember me</span>
            </label>
          </div>
          <div class="form-footer">
            <button type="submit" class="btn btn-primary btn-block">Sign in</button>
          </div>
        </div>
      </form>
    </div>
</div>
@endsection