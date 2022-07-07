<div class="mt-2">
    <div class="flex justify-between mb-2">
        <img src="{{ captcha_src() }}" alt="captcha" class="captcha-img"
             data-refresh-config="default">
        <a href="#" id="refresh-captcha" class="refresh-captcha"><i
                class="fa fa-refresh" aria-hidden="true"></i></a>
    </div>
    <input
        class="refresh-captcha-input w-full px-5  py-4 text-gray-700 rounded"
        id="captcha" name="captcha" type="text" required=""
        placeholder="{{ trans('captcha.text') }}*"
        aria-label="Captcha">
</div>


<script>
    $('.refresh-captcha').on('click', function () {
        let captchaImage = $('.captcha-img');
        let url = "{{ route('test') }}";
        console.log(url);
        $.get(url, {})
            .success(function (response) {
                captchaImage.prop('src', response);
            });
    });
</script>
