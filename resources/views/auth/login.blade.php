<x-guest-layout>
    <div class="login-container">
        <div class="image-section">
            <img src="{{ asset('images/login.png') }}" alt="Login Image">
        </div>
        <div class="login-form-section">
            <h1>Welcome</h1>
            <p>Login into your account</p>
            <x-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-group">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>
                <div class="input-group mt-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                </div>
                <div class="remember-me flex items-center mt-4">
                    <x-checkbox id="remember_me" name="remember" />
                    <label for="remember_me" class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</label>
                </div>
                <div class="actions flex justify-between mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Recover password') }}
                        </a>
                    @endif

                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                        {{ __('Register') }}
                    </a>

                </div>
                <button type="submit" class="w-full bg-blue-500 text-white mt-4 py-2 rounded-md hover:bg-blue-600">
                    {{ __('Login') }}
                </button>
            </form>
        </div>
    </div>
    <footer class="footer">
        <p>Powered by UTeM</p>
    </footer>


</x-guest-layout>
