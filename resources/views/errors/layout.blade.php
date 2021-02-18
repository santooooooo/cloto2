<!DOCTYPE html>
<html lang="jp">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        {{-- Title --}}
        <title>@yield('title')</title>

        {{-- Favicon --}}
        <link rel="shortcut icon" href="/storage/system/favicon.ico">

        {{-- Fonts --}}
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        {{-- Styles --}}
        <link rel="stylesheet" href="{{ mix('css/error.css') }}">
    </head>

    <body class="antialiased font-sans">
        <div class="md:flex min-h-screen bg-gray-100 dark:bg-gray-900">
            <div class="w-full md:w-1/2 flex items-center justify-center">
                <div class="max-w-sm m-8">
                    <div class="text-white text-5xl md:text-15xl font-black" id="code">
                        @yield('code', __('Oh no'))
                    </div>

                    <div class="w-16 h-1 bg-primary my-3 md:my-6"></div>

                    <p class="text-white text-2xl md:text-3xl font-light mb-8 leading-normal">
                        @yield('message')
                    </p>

                    <div>
                        @yield('content-left')
                    </div>
                </div>
            </div>

            <div class="relative pb-3 md:flex md:pb-0 md:min-h-screen w-full md:w-1/2 items-center justify-center">
                @yield('content-right')
            </div>
        </div>
    </body>
</html>
