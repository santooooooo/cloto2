<!DOCTYPE html>
<html lang="ja">

<head>
    @include('layouts.head')
</head>

<body>

    @include('layouts.header')

    <div id="app">
        @yield('top')
        @yield('content')
    </div>

    @include('layouts.footer')

</body>

</html>