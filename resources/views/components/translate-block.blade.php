<div class="px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500">
    <div class="locale-switcher">
        <a href="{{ route('changeLocale', ['locale' => 'ru']) }}"
           class="locale-ru-switcher-button bg-gray-200 border-gray-200 border-2 p-2 focus:outline-none hover:text-gray-700 hover:border-gray-300"
           title="Dark">
            <i class="fa fa-language pointer-events-none"></i> RU
        </a>
        <a href="{{ route('changeLocale', ['locale' => 'en']) }}"
           class="locale-en-switcher-button bg-gray-200 border-gray-200 border-2 p-2 focus:outline-none hover:text-gray-700 hover:border-gray-300"
           title="Auto">
            <i class="fa fa-language pointer-events-none"></i> ENG
        </a>
    </div>
</div>
<script>
    let locale = '{{ App::getLocale() }}';

    $(document).on('mouseenter', '.locale-switcher a', function () {
        $('.locale-switcher a').not(this).removeClass('text-gray-700 border-gray-700');
    });

    $(document).on('mouseleave', '.locale-switcher a', function () {
        if (!$(this).hasClass('text-gray-700 border-gray-700')) {
            $('.locale-switcher a').not(this).addClass('text-gray-700 border-gray-700');
        }
    });

    if (locale == 'ru') {
        $('.locale-ru-switcher-button').removeClass('hover:text-gray-700 hover:border-gray-300');
        $('.locale-ru-switcher-button').addClass('pointer-events-none cursor-not-allowed text-gray-700 border-gray-700');
    }
    if (locale == 'en') {
        $('.locale-en-switcher-button').removeClass('hover:text-gray-700 hover:border-gray-300');
        $('.locale-en-switcher-button').addClass('pointer-events-none text-gray-700 border-gray-700');
    }
</script>
