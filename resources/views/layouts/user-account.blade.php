<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('general_settings.site_title') ?? config('app.name', 'Laravel') }} | @yield('title')</title>

    @include('front.partials.user-account-commoncss')
    @yield('additionalcss')

</head>

<body>
    @include('front.partials.user-account-header')


    @yield('content')

    @include('front.partials.user-account-footer')
    @include('front.partials.user-account-commonjs')
    @yield('additionaljs')

</body>

</html>