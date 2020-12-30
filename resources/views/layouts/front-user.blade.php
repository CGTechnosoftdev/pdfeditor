<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('general_settings.site_title') ?? config('app.name', 'Laravel') }} | @yield('title')</title>

    @include('front.partials.front-user-commoncss')
    @yield('additionalcss')
</head>
@php
$account_page_status = (request()->segment(1)=='account') ? true : false;
@endphp

<body class="dashboard3 sidebar-mini">
    <div class="dashboard3-wrapper">
        @include('front.partials.front-user-header')

        @if(empty($account_page_status))
        @include('front.partials.front-user-sidebar')
        <div class="content-wrapper">
            @yield('content')
        </div>
        @else
        <div class="wrapper">
            @include('front.partials.front-user-account-sidebar')
            <div id="content">
                @yield('content')
            </div>
        </div>
        @endif
        @include('front.partials.front-user-footer')

        @if(empty($account_page_status))
        @include('front.partials.front-user-document-footer-menu')
        @endif

        @include('front.partials.front-user-commonjs')
        @yield('additionaljs')
    </div>
</body>

</html>