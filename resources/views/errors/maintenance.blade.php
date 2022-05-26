<!doctype html>
<title>Site Maintenance</title>
<style>
    html, body {
        padding: 0;
        margin: 0;
        width: 100%;
        height: 100%;
    }

    * {
        box-sizing: border-box;
    }

    body {
        text-align: center;
        padding: 0;
        background: linear-gradient(to left bottom, rgb(147, 197, 253), rgb(187, 247, 208), rgb(253, 224, 71));
        color: #fff;
        font-family: Open Sans, serif;
    }

    h1 {
        font-size: 50px;
        font-weight: 100;
        text-align: center;
    }

    body {
        font-family: Open Sans, serif;
        font-weight: 100;
        font-size: 20px;
        color: black;
        text-align: center;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
    }

    article {
        display: block;
        width: 700px;
        padding: 50px;
        margin: 0 auto;
    }

    a {
        color: orange;
        font-weight: bold;
    }

    a:hover {
        color: coral;
    }

    svg {
        width: 75px;
        margin-top: 1em;
    }
</style>

<article>
    <h1>{{ trans('maintenance-page.header') }}</h1>
    <div>
        <p>{{ trans('maintenance-page.message', [], 'ru') }}</p>
        <p>{{ trans('maintenance-page.message', [], 'en') }}</p>
        <p>&mdash; <a href="mailto:{{ config('mail.from.address', 'YourAlbumStorage') }}">{{ config('app.name') }} </p>
    </div>
</article>
