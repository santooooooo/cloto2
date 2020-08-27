<!DOCTYPE html>
<html lang="ja">

<head>
    @include('layouts.head')
</head>

<body>

    <div id="app">
        <vue-header></vue-header>
        <router-view />
    </div>

    @include('layouts.footer')

</body>

</html>