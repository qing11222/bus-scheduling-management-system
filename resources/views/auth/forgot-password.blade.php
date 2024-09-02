<x-guest-layout>
    <div class="login-container">
        <div class="image-section">
            <img src="{{ asset('images/login.png') }}" alt="Reset Password Image">
        </div>
        <div class="login-form-section">
            <h1>Forgot Password?</h1>
            <p>No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="input-group">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button>
                        {{ __('Email Password Reset Link') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
    <footer class="footer">
        <p>Powered by UTeM</p>
    </footer>
</x-guest-layout>
