<!DOCTYPE html>
<html lang="ja">

<head>
    @include('head')
</head>

<body>
    <!-- PleaseWait.js -->
    <link rel="stylesheet" href="{{ mix('css/please-wait.css') }}">
    <style>
        .pg-loading-logo {
            max-width: 95%;
        }
    </style>
    <script src="{{ mix('js/please-wait.min.js') }}"></script>
    <script>
        window.loading_screen = window.pleaseWait({
            logo: "{{ config('consts.storage.system').'header-logo.svg' }}",
            backgroundColor: "#f6bf00",
            loadingHtml: "メッセージ"
        });
        window.onload = function () {
            loading_screen.finish();
        };
    </script>


    <!-- App -->
    <div id="app"></div>
    <!-- built files will be auto injected -->
</body>

</html>