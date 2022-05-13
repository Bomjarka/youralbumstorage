<div role="alert">
    <div class="bg-orange-500 text-white font-bold rounded-t px-4 py-2 mt-3">
        <i class="fa fa-exclamation-triangle mr-3"></i>Warning
    </div>
    <div class="flex flex-col border border-t-0 border-orange-400 rounded-b bg-orange-100 px-4 py-3 text-orange-700 font-bold">
        <p>
            {{ $value }}
        </p>
        @if ($slot->isNotEmpty())
            <form method="post" action="{{ route(('verification.send')) }}">
                @csrf
                @method('post')
                <button class="font-sans hover:text-orange-400" type="submit">{{ $slot }}</button>
            </form>
        @endif
    </div>
</div>
