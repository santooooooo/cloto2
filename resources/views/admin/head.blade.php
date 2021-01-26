<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

{{-- 管理画面は検索回避 --}}
<meta name="robots" content="noindex">

{{-- Favicon --}}
<link rel="shortcut icon" href="/storage/system/favicon.ico">

{{-- Scripts --}}
@if (Route::current()->getName() != 'admin.login')
    <script src="{{ mix('js/admin/app.js') }}" defer></script>
@endif

{{-- Fonts --}}
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

{{-- Styles --}}
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"
    integrity="sha256-UzFD2WYH2U1dQpKDjjZK72VtPeWP50NoJjd26rnAdUI=" crossorigin="anonymous" />
