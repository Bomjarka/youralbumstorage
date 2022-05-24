<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="trans('form-reset-password.email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="trans('form-reset-password.password')" />
                <ul class="pwd-help ml-2 block font-medium text-sm text-gray-700 opacity-50 hidden">
                    <li>{{ trans('form-register.password-help-length') }};</li>
                    <li>{{ trans('form-register.password-help-case') }};</li>
                    <li>{{ trans('form-register.password-help-numbers') }};</li>
                </ul>
                <x-input id="password" class="password-input block mt-1 w-full" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="trans('form-reset-password.confirm-pwd')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ trans('form-reset-password.reset-pwd') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
<script>
    $('.password-input').on('click', function () {
        $('.pwd-help').slideDown(300);
    });

    $('.phone-input').on('click', function () {
        $('.phone-help').slideDown(300);
    });

    jQuery(function($){
        $(document).mouseup( function(e){
            let pwd = $( ".pwd-help" );
            let phone = $( ".phone-help" );
            if ( !phone.is(e.target)) {
                phone.slideUp(300);
            }
            if ( !pwd.is(e.target)) {
                pwd.slideUp(300);
            }
        });
    });
</script>
