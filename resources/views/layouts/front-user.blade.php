<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('general_settings.site_title') ?? config('app.name', 'Laravel') }} | @yield('title')</title>
    <meta name="google-site-verification" content="_Yg97CCJXq5DPPyyVhdFXaJ_x2MVg2k3ILcpQdTJHPk" />
    @include('front.partials.front-user-commoncss')
    @yield('additionalcss')
    <script type="text/javascript">
        var base_url = "{{url('')}}";
        var csrf_token = "{{csrf_token()}}";
    </script>
</head>
@php


$account_page_status = in_array(request()->segment(1),['address-book','account']);
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

        @if(empty($account_page_status) && !empty($footer_menu))
        @include('front.partials.front-user-document-footer-menu')
        @endif

        @include('front.partials.front-user-commonjs')
        @yield('additionaljs')
    </div>
</body>

</html>