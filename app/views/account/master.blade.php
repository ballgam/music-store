<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>
       @yield('title')
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{ HTML::style('assets/css/bootstrap.min.css') }}
    {{ HTML::style('assets/css/bootstrap-theme.min.css') }}
    {{ HTML::style('assets/css/bootstrap-theme-reset.css') }}
    {{ HTML::style('assets/css/font-awesome.min.css') }}
    {{ HTML::style('assets/css/styles.css') }}

</head>
<body>

    @yield('content')

    <script type="text/javascript">
        var path = windows.location.pathname;
        alert(path);
    </script>
</body>
</html>