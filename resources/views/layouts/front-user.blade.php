<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('general_settings.site_title') ?? config('app.name', 'Laravel') }} | @yield('title')</title>

    @include('front.partials.user-commoncss')
    @yield('additionalcss')
</head>

<body class="dashboard3 sidebar-mini" style="height: auto; min-height: 100%;">
    <div class="dashboard3-wrapper">
        @include('front.partials.user-header')
        @yield('content')
        @include('front.partials.user-footer')
        <<<<<<< HEAD @include('front.partials.user-commonjs') @yield('additionaljs') </div>=======</div> @include('front.partials.user-commonjs') @yield('additionaljs')>>>>>>> 1387f7929e1a4d8fb3ec88337cdf7b4c52a6c7b8
</body>

</html>