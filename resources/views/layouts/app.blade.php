<!DOCTYPE html>
<html lang="ja">

<head>
    @include('layouts.head')
</head>

<body>

    @include('layouts.header')

    <div id="app">
        <router-view />
        {{-- @yield('top') --}}
        {{-- @yield('content') --}}
    </div>

    @include('layouts.footer')

</body>

</html>