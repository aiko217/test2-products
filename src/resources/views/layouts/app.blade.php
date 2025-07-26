<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mogitate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css')}}">
    @yield('css')
</head>

<body>
    <div class="app">
    <h3 class="header__heading">mogitate</h3>
    @yield('content')
    </div>
</body>

</html>