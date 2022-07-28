<x-guest-layout>

    <div class="container-fluid">
        <div class="row">
          <div class="col-7 p-0 d-none d-md-block">
            <div class="login-bg"></div>
          </div>
          <div class="col-md-5 col-12">
            <div class="login-content d-flex h-100">
                <div class="justify-content-center align-self-center" style="margin: 0 auto">
                    <div class="text-center mb-4">
                        <img src="img/hed-login-logo.png">
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('login') }}">
                    @csrf
                        <div class="row">
                            <div class="col-12">
                                <x-label for="cnic" class="form-label" :value="__('CNIC')" />
                                <x-input id="cnic" class="form-control" type="text" name="cnic" :value="old('cnic')" required autofocus placeholder="00000-0000000-0" />
                            </div>
                            <div class="col-12">
                                <x-label for="password" class="form-label" :value="__('Password')" />
                                <x-input id="password" class="form-control"
                                                type="password"
                                                name="password"
                                                placeholder="xxxxxxxxx"
                                                required autocomplete="current-password" />
                            </div>
                        </div>

                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div>

                        <div class="col-md-12 text-center">

                            <button type="submit" class="submit mt-3">Login</button>
                          </div>
                    </form>
                </div>
            </div>
          </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
           $('#cnic').mask('00000-0000000-0');
        });
    </script>
</x-guest-layout>
