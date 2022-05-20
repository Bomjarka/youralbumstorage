@component('mail::message')
{{-- Greeting --}}
<h2>{{ $greeting }}</h2>
@if ($level === 'error')
# @lang('Whoops!')
@endif
{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}:
@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}.<br>

@endforeach

{{-- Salutation --}}
<br> {{ $salutation }}, <br>
{{ config('app.name') }}

