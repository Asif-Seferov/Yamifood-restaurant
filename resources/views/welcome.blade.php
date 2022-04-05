<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

       

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <h1>@lang('welcome.welcome_title')</h1>
        <a href="{{url('/lang/en')}}">{{__('welcome.title_en')}}</a>
        <a href="{{url('/lang/az')}}">{{__('welcome.title_az')}}</a>
        <a href="{{url('/lang/ru')}}">@lang('welcome.title_ru')</a>
    </body>
</html>
