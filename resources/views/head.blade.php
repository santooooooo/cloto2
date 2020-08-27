<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<script>
    window.Laravel = {
        csrfToken: "{{ csrf_token() }}"
    };
</script>

<!-- Favicon -->
<link rel="shortcut icon" href="{{ config('consts.storage.system').'favicon.ico' }}">

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<!-- Styles -->
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"
    integrity="sha256-UzFD2WYH2U1dQpKDjjZK72VtPeWP50NoJjd26rnAdUI=" crossorigin="anonymous" />


<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@cloto_jp">
<meta name="twitter:title" content="CLOTO">
<meta name="twitter:description" content="「チュートリアル学習も終わり、いよいよ腕試し！！」そんな駆け出しエンジニアのみなさん、朗報です！">
<meta name="twitter:image" content="{{ config('app.url').config('consts.storage.system').'twitter-card.png' }}">