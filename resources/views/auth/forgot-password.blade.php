<x-guest-layout>
    <x-slot:title>
        {{ __('Forgot Password | MERP') }}
        </x-slot>
        <div class="text-center">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <!-- form -->
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            @include('layouts.messages')
            <div class="mb-3">
                <label for="emailaddress" class="form-label">Email address</label>
                <input class="form-control" id="email" type="email" name="email" value="{{ old('email') }}"
                    required autofocus>
            </div>

            <div class="d-grid mb-0 text-center">
                <button class="btn btn-success" type="submit"><i class="mdi mdi-logi"></i> Email Password Reset Link
                </button>
            </div>
        </form>
        <!-- end form-->
</x-guest-layout>
