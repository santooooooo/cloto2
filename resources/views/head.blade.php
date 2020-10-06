<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Favicon -->
<link rel="shortcut icon" href="{{ config('consts.storage.system').'favicon.ico' }}">

<!-- Scripts -->
<script src="{{ mix('js/app.js') }}" defer></script>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<!-- Styles -->
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"
    integrity="sha256-UzFD2WYH2U1dQpKDjjZK72VtPeWP50NoJjd26rnAdUI=" crossorigin="anonymous" />


<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@cloto_jp">
<meta name="twitter:title" content="CLOTO">
<meta name="twitter:description" content="「チュートリアル学習も終わり、いよいよ腕試し！！」そんな駆け出しエンジニアのみなさん、朗報です！">
<meta name="twitter:image" content="{{ config('app.url').config('consts.storage.system').'twitter-card.png' }}">


<!-- 解析ツール -->
@if (App::environment('production'))
<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-179731225-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-179731225-1');
</script>
<!-- End Google Analytics -->

<!-- User Heat -->
<script type="text/javascript">
(function(add, cla){window['UserHeatTag']=cla;window[cla]=window[cla]||function(){(window[cla].q=window[cla].q||[]).push(arguments)},window[cla].l=1*new Date();var ul=document.createElement('script');var tag = document.getElementsByTagName('script')[0];ul.async=1;ul.src=add;tag.parentNode.insertBefore(ul,tag);})('//uh.nakanohito.jp/uhj2/uh.js', '_uhtracker');_uhtracker({id:'uhPFqTeO9e'});
</script>
<!-- End User Heat -->
@endif