<div role="alert">
    <div class="bg-orange-500 text-white font-bold rounded-t px-4 py-2 mt-3">
        <i class="fa fa-exclamation-triangle mr-3"></i>Warning
    </div>
    <div class="border border-t-0 border-orange-400 rounded-b bg-orange-100 px-4 py-3 text-orange-700">
        <p>{{ $message }}</p>
        <form method="post" action="{{ route(('verification.send')) }}">
            @csrf
            @method('post')
            <button type="submit">Click here</button>
        </form>
    </div>
</div>
