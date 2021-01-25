<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Favicon -->
<link rel="shortcut icon" href="/storage/system/favicon.ico">

@if (Route::current()->getName() != 'verification.notice' && Route::current()->getName() != 'verification.verify')
  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}" defer></script>
@endif

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<!-- Styles -->
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css"
    integrity="sha256-UzFD2WYH2U1dQpKDjjZK72VtPeWP50NoJjd26rnAdUI=" crossorigin="anonymous" />


<!-- OGP -->
<meta property="og:url" content="{{ config('app.url') }}" />
<meta property="og:title" content="{{ config('app.name') }}" />
<meta property="og:description" content="プログラミングを楽しみながら継続できる環境がここに生まれました！" />
<meta property="og:image" content="{{ config('app.url') . '/storage/system/card.png' }}" />
<!-- Twitter card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@cloto_jp">


@if (App::environment('production'))
<!-- 解析ツール -->

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