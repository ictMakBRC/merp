<x-guest-layout>
    <x-slot:title>
        {{ __('Reset Password | MERP') }}
    </x-slot>
    <x-auth-session-status class="mb-4" :status="session('status')" />
        <!-- form -->
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        @include('layouts.messages')
        <div class="mb-3">
            <label for="emailaddress" class="form-label">Email address</label>
            <input class="form-control" id="email" type="email" name="email"
                value="{{ old('email', $request->email) }}" required autofocus>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input class="form-control" id="password" type="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input class="form-control" id="password_confirmation" type="password" name="password_confirmation"
                required>
        </div>

        <div class="d-grid mb-0 text-center">
            <button class="btn btn-success" type="submit">{{ __('Reset Password') }}
            </button>
        </div>
    </form>
        <!-- end form-->
</x-guest-layout>
