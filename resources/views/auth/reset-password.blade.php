<x-guest-layout>
    <div class="login-container">
        <div class="image-section">
            <img src="{{ asset('images/login.png') }}" alt="Reset Password Image">
        </div>
        <div class="login-form-section">
            <h1>Reset Password</h1>
            <p>Enter your email and new password to reset your password.</p>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="input-group">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                </div>

                <div class="input-group mt-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                </div>

                <div class="input-group mt-4">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900" onclick="resetForm()">
                        {{ __('Click here to reset') }}
                    </button>
                    <x-button class="ms-4">
                        {{ __('Reset Password') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
    <footer class="footer">
        <p>Powered by UTeM</p>
    </footer>

    <script>
        function resetForm() {
            document.getElementById('email').value = '';
            document.getElementById('password').value = '';
            document.getElementById('password_confirmation').value = '';
        }
    </script>
</x-guest-layout>
