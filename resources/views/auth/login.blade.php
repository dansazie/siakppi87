@extends('auth.layauth')

@section('content')
    <section class="section">
      <div class="d-flex flex-wrap align-items-stretch">
        <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
          <div class="p-4 m-3">
            <img src="{{ (!empty(setting('logo')) ? asset('storage/'.setting('logo')) : '') }}" alt="logo" width="80" class="shadow-light rounded mb-5 mt-2">
            <h4 class="text-dark font-weight-normal">Login ke <span class="font-weight-bold">{{ (!empty(setting('nama_aplikasi')) ? setting('nama_aplikasi') : 'SIASIK') }}</span></h4>
            <p class="text-muted">Belum memiliki akun? silahkan hubungi Admin!</p>
            <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
              @csrf
              <div class="form-group">
                <label for="email">{{ __('Email Address') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              </div>

              <div class="form-group">
                <div class="d-block">
                  <label for="password" class="control-label">{{ __('Password') }}</label>
                </div>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
              </div>

              <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                </div>
              </div>

              <div class="form-group text-right">
                <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                  {{ __('Login') }}
                </button>
                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
              </div>
              
            </form>

            <div class="text-center mt-5 text-small">
              Copyright &copy; <div class="bullet"></div> {{ (!empty(setting('teks_footer')) ? setting('teks_footer') : 'SIASIK') }}
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="{{asset('theme/img/unsplash/login-bg.jpg')}}">
          <div class="absolute-bottom-left index-2">
            <div class="text-light p-5 pb-2">
              <div class="mb-5 pb-3">
                <h1 class="mb-2 display-4 font-weight-bold"></h1>
                <h5 class="font-weight-normal text-muted-transparent"></h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
 @endsection
