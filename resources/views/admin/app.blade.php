<!DOCTYPE html>
<html lang="ja">

<head>
    @include('admin.head')
</head>

<body>
    @if (Route::current()->getName() == 'admin.login')
        {{-- PleaseWait.js & Spinkit --}}
        <link rel="stylesheet" href="{{ mix('css/please-wait.css') }}">
        <link rel="stylesheet" href="{{ mix('css/spinkit.min.css') }}">
        <style>
            .pg-loading-logo {
                max-width: 95%;
            }
            .sk-wave {
                margin: 0 auto;
            }
            .sk-wave-rect {
                background-color: #ffffff;
            }
        </style>
        <script src="{{ mix('js/please-wait.min.js') }}"></script>
        <script>
            window.loading_screen = window.pleaseWait({
                logo: '/storage/system/header_logo.svg',
                backgroundColor: '#f6bf00',
                loadingHtml: '<div class="sk-wave"><div class="sk-wave-rect"></div><div class="sk-wave-rect"></div><div class="sk-wave-rect"></div><div class="sk-wave-rect"></div><div class="sk-wave-rect"></div></div>'
            });
            window.onload = function () {
                loading_screen.finish();
            };
        </script>

        @yield('login')
    @else
        {{-- App --}}
        <div id="app"></div>
    @endif
</body>

</html>