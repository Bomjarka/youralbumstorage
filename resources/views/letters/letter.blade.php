<body>
<div class="flex items-center justify-center min-h-screen p-5 bg-blue-100 min-w-screen">
    <div class="max-w-xl p-8 text-center text-gray-800 bg-white shadow-xl lg:max-w-3xl rounded-3xl lg:p-12">
        @if ($user)
            <h3 class="text-2xl">{{ trans('feedback-email.title') . ' ' . $user->fullName() }}</h3>
        @else
            <h3 class="text-2xl">{{ trans('feedback-email.title') . ' ' .  $fromName }}</h3>
        @endif
        <div class="flex justify-center">
        </div>

        <div class="mt-4">
            <p class="mt-4 text-sm">
                {{ $userMessage }}
            </p>
        </div>
        <div>
            <p>Email: {{ $user->email ?? $emailFrom }}</p>
        </div>
        @if ($user)
            <a href="{{ route('adminUser', ['user' => $user]) }}">{{ trans('feedback-email.link-to-user')  }}</a>
        @endif
    </div>
</div>
</body>
