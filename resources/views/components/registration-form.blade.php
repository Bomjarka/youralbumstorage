<form method="POST" action="{{ route('register') }}">
    @csrf
    <!--Login-->
    <div class="mt-4">
        <x-label for="login" :value="trans('form-register.login')"/>

        <x-input id="login" class="block mt-1 w-full" type="text" name="login"
                 :value="old('login')" required placeholder="Login"
                 autofocus/>
    </div>
    <!-- First Name -->
    <div class="mt-2">
        <x-label for="first_name" :value="trans('form-register.firstname')"/>

        <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                 :value="old('first_name')" required
                 autofocus/>
    </div>
    <!-- Second Name -->
    <div class="mt-2">
        <x-label for="second_name" :value="trans('form-register.secondname')"/>

        <x-input id="second_name" class="block mt-1 w-full" type="text" name="second_name"
                 :value="old('second_name')" required
                 autofocus/>
    </div>
    <!-- Last Name -->
    <div class="mt-2">
        <x-label for="last_name" :value="trans('form-register.lastname')"/>

        <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')"
                 required
                 autofocus/>
    </div>
    <!-- Email Address -->
    <div class="mt-2">
        <x-label for="email" :value="trans('form-register.email')"/>

        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required placeholder="example@domain"/>
    </div>
    <!--Phone-->
    <div class="mt-2">
        <x-label for="phone" :value="trans('form-register.phone')"/>
        <ul class="phone-help ml-2 block font-medium text-sm text-gray-700 opacity-50 hidden">
            <li>{{ trans('form-register.phone-help') }}</li>
        </ul>
        <x-input id="phone" class="phone-input block mt-1 w-full" type="text" name="phone" :value="old('phone')" required placeholder="81234567891"/>
    </div>
    <!--Gender-->
    <div class="mt-2">
        <x-label for="gender" :value="trans('form-register.sex')"/>
        <div class="flex-row">
            <div class="flex items-center mb-3 last:mb-0">
                <input
                    name="gender"
                    type="radio"
                    class="w-6 h-6 border border-gray-300 rounded-full outline-none cursor-pointer"
                    value="male"
                /><label class="ml-2 text-sm" for="male">{{ trans('base-phrases.sex-male') }}</label>
            </div>
            <div class="flex items-center mb-3 last:mb-0">
                <input
                    name="gender"
                    type="radio"
                    class="w-6 h-6 border border-gray-300 rounded-full outline-none cursor-pointer"
                    value="female"
                /><label class="ml-2 text-sm" for="female">{{ trans('base-phrases.sex-female') }}</label>
            </div>
        </div>
    </div>
    <!--Phone-->
    <div class="mt-2">
        <x-label for="birthdate" :value="trans('form-register.birthdate')"/>
        <x-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" :value="old('phone')"
                 required/>
    </div>
    <!-- Password -->
    <div class="mt-2">
        <x-label for="password" :value="trans('form-register.password')"/>
        <ul class="pwd-help ml-2 block font-medium text-sm text-gray-700 opacity-50 hidden">
            <li>{{ trans('form-register.password-help-length') }};</li>
            <li>{{ trans('form-register.password-help-case') }};</li>
            <li>{{ trans('form-register.password-help-numbers') }};</li>
        </ul>
        <x-input id="password" class="password-input block mt-1 w-full"
                 type="password"
                 name="password"
                 required autocomplete="new-password"/>
    </div>
    <!-- Confirm Password -->
    <div class="mt-2">
        <x-label for="password_confirmation" :value="trans('form-register.confirm-pwd')"/>

        <x-input id="password_confirmation" class="block mt-1 w-full"
                 type="password"
                 name="password_confirmation" required/>
    </div>
    <div class="flex items-center justify-end mt-4">
        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
            {{ trans('form-register.already-registered') }}
        </a>

        <x-button class="ml-4">
            {{ strtoupper(trans('form-register.register')) }}
        </x-button>
    </div>
</form>

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
