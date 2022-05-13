<form method="POST" action="{{ route('register') }}">
    @csrf
    <!--Login-->
    <div class="mt-4">
        <x-label for="login" :value="__('Login')"/>

        <x-input id="login" class="block mt-1 w-full" type="text" name="login"
                 :value="old('login')" required
                 autofocus/>
    </div>
    <!-- First Name -->
    <div class="mt-2">
        <x-label for="first_name" :value="__('First Name')"/>

        <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                 :value="old('first_name')" required
                 autofocus/>
    </div>
    <!-- Second Name -->
    <div class="mt-2">
        <x-label for="second_name" :value="__('Second Name')"/>

        <x-input id="second_name" class="block mt-1 w-full" type="text" name="second_name"
                 :value="old('second_name')" required
                 autofocus/>
    </div>
    <!-- Last Name -->
    <div class="mt-2">
        <x-label for="last_name" :value="__('Last Name')"/>

        <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')"
                 required
                 autofocus/>
    </div>
    <!-- Email Address -->
    <div class="mt-2">
        <x-label for="email" :value="__('Email')"/>

        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required/>
    </div>
    <!--Phone-->
    <div class="mt-2">
        <x-label for="phone" :value="__('Phone')"/>

        <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required/>
    </div>
    <!--Gender-->
    <div class="mt-2">
        <x-label for="gender" :value="__('Gender')"/>
        <div class="flex-row">
            <div class="flex items-center mb-3 last:mb-0">
                <input
                    name="gender"
                    type="radio"
                    class="w-6 h-6 border border-gray-300 rounded-full outline-none cursor-pointer"
                    value="male"
                /><label class="ml-2 text-sm" for="male">Male</label>
            </div>
            <div class="flex items-center mb-3 last:mb-0">
                <input
                    name="gender"
                    type="radio"
                    class="w-6 h-6 border border-gray-300 rounded-full outline-none cursor-pointer"
                    value="female"
                /><label class="ml-2 text-sm" for="female">Female</label>
            </div>
        </div>
    </div>
    <!--Phone-->
    <div class="mt-2">
        <x-label for="birthdate" :value="__('Birthdate')"/>
        <x-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" :value="old('phone')"
                 required/>
    </div>
    <!-- Password -->
    <div class="mt-2">
        <x-label for="password" :value="__('Password')"/>

        <x-input id="password" class="block mt-1 w-full"
                 type="password"
                 name="password"
                 required autocomplete="new-password"/>
    </div>
    <!-- Confirm Password -->
    <div class="mt-2">
        <x-label for="password_confirmation" :value="__('Confirm Password')"/>

        <x-input id="password_confirmation" class="block mt-1 w-full"
                 type="password"
                 name="password_confirmation" required/>
    </div>
    <div class="flex items-center justify-end mt-4">
        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>

        <x-button class="ml-4">
            {{ __('Register') }}
        </x-button>
    </div>
</form>
