<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="/lib/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="/lib/font-awesome-4.5.0/css/font-awesome.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="/lib/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
                folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="/lib/dist/css/skins/_all-skins.min.css">
        @yield('in-head')
    </head>
    <body>
        @yield('content')
        <script src="/lib/jQuery/jQuery-2.1.4.min.js"></script>
        <script src="/lib/bootstrap/js/bootstrap.min.js"></script>
        <script src="/lib/bootbox/bootbox.min.js"</script>
        <!-- AdminLTE App -->
        <script src="/lib/dist/js/app.min.js"></script>
        <!-- Other Addition libs -->
        @yield('includejs')
        <script>
        @yield('script')
        </script>
    </body>
</html>