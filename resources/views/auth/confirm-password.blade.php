<x-guest-layout>
    <x-slot:title>
        {{ __('Confirm Password | MERP') }}
    </x-slot>
    <div class="text-center">
        {{ __('This is a restricted area of the application. Please confirm your password before continuing.') }}
    </div>
    @include('layouts.messages')
    <!-- form -->
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input class="form-control" id="password"  type="password"
            name="password"
            required autocomplete="current-password" >
        </div>

        <div class="d-grid mb-0 text-center">
            <button class="btn btn-success" type="submit"> {{ __('Confirm') }}
            </button>
        </div>
    </form>
    <!-- end form-->

</x-guest-layout>