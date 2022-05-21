<div class="flex items-center pt-2">
    <button type="click"
            class="download_photos bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
        <i class="fa fa-download mr-3" aria-hidden="true"></i>
        <span>{{ trans('view-profilepage-albums-and-photos.download-photos') }}</span>
    </button>
</div>

<script>
    $('.download_photos').on('click', function () {
        let url = "{{ route('downloadAllPhotos') }}";
        $.post(url, {
            _token: '{{ csrf_token() }}',
            userId: {{ Auth::user()->id }}
        })
            .success(function (response) {
                $('.success').slideDown(300);
                $(".success").delay(3000).slideUp(300);
            });
    });
</script>
