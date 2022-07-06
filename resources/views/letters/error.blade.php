<body>
<div class="flex items-center justify-center min-h-screen p-5 bg-blue-100 min-w-screen">
    <div class="max-w-xl p-8 text-center text-gray-800 bg-white shadow-xl lg:max-w-3xl rounded-3xl lg:p-12">
        <h3 class="text-2xl">Error</h3>
        <div class="mt-4">
            <h4>Message: {{ $error->getMessage() }}</h4>
            @isset($url)
                <h4>Route: {{ $url }}</h4>
            @endisset
            <h4>Where: {{ $error->getFile() . ':' . $error->getLine() }}</h4>
            <p> {{ $error->getTraceAsString() }}</p>
        </div>
    </div>
</div>
</body>
