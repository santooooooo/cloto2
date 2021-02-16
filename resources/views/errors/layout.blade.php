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

                    <a href="https://spark.adobe.com/page/JwVbQbzQtbSkB" target="_blank" rel="noopener noreferrer" class="button mr-3 mb-8">
                        CLOTOについて
                    </a>

                    <a href="https://spark.adobe.com/page/Z34f2zfDFQnUU" target="_blank" rel="noopener noreferrer" class="button ml-3 mb-8">
                        使い方とQ&A
                    </a>

                    <table class="bg-white font-bold mt-12">
                        <thead>
                            <tr>
                                <th>スケジュール</th>
                                <th>平日</th>
                                <th>土日</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <th>00:00 ~ 06:00</th>
                                <td class="bg-gray-light">クローズ</td>
                                <td class="bg-gray-light" rowspan="3">クローズ</td>
                            </tr>
                            <tr>
                                <th>06:00 ~ 09:00</th>
                                <td class="bg-primary">オープン</td>
                            </tr>
                            <tr>
                                <th>09:00 ~ 12:00</th>
                                <td class="bg-gray-light" rowspan="2">クローズ</td>
                            </tr>
                            <tr>
                                <th>12:00 ~ 19:00</th>
                                <td class="bg-primary" rowspan="2">オープン</td>
                            </tr>
                            <tr>
                                <th>19:00 ~ 24:00</th>
                                <td class="bg-primary">オープン</td>
                            </tr>
                        </tbody>
                    </table>

                    <p class="text-white text-xl font-bold mt-12">
                        デモ版は <a href="https://demo.cloto.jp" target="_blank" rel="noopener noreferrer" class="text-red">こちら</a>
                    </p>
                </div>
            </div>

            <div class="relative pb-3 md:flex md:pb-0 md:min-h-screen w-full md:w-1/2 items-center justify-center">
                @yield('content')
            </div>
        </div>
    </body>
</html>
