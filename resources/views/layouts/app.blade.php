<!DOCTYPE html>
<html lang="ja">

<head>
    @include('layouts.head')
</head>

<body>

    @include('layouts.header')

    @yield('top')

    @yield('content')

    @include('layouts.footer')

</body>

</html>