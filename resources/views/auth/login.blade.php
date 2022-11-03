<x-guest-layout>
    <x-slot:title>
        {{ __('Login | MERP') }}
    </x-slot>
    <div class="text-center">
        <h2 class="mt-0">LOGIN</h2>
    </div>
    <!-- form -->
    <form method="POST" action="{{ route('login') }}">
        @csrf
        @include('layouts.messages')
        <div class="mb-3">
            <label for="emailaddress" class="form-label">Email address</label>
            <input class="form-control" type="email" id="emailaddress" value="{{ old('email') }}" required=""
                placeholder="Enter your email" name="email" autofocus>
        </div>
        <div class="mb-3">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-muted float-end">
                    <small>{{ __('Forgot your password?') }}</small></a>
                </a>
            @endif
            <label for="password" class="form-label">Password</label>
            <input class="form-control" type="password" id="password" placeholder="Enter your password"
                name="password" required autocomplete="current-password">
        </div>
        <div class="mb-3">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                <label class="form-check-label" for="remember_me">Remember me</label>
            </div>
        </div>
        <div class="d-grid mb-0 text-center">
            <button class="btn btn-success" type="submit"><i class="mdi mdi-login"></i> Login
            </button>
        </div>
    </form>

</x-guest-layout>
