<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="/lib/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="/lib/font-awesome/css/font-awesome.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="/css/app.css">
        @yield('in-head')
    </head>
    <body>
        @yield('content')
        <script src="/lib/jquery/dist/jquery.min.js"></script>
        <script src="/lib/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="/lib/bootbox/bootbox.js"</script>
        <!-- AdminLTE App -->
        <script src="/lib/app.js"></script>
        <!-- Other Addition libs -->
        @yield('includejs')
        <script>
        @yield('script')
        </script>
    </body>
</html>
