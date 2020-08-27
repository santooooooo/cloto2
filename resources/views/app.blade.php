<!DOCTYPE html>
<html lang="ja">

<head>
    @include('layouts.head')
</head>

<body>

    <div id="app">
        <vue-header></vue-header>
        
        <router-view></router-view>

        <vue-footer></vue-footer>
    </div>

</body>

</html>