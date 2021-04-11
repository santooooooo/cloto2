@extends('errors::layout')

@section('title', 'メンテナンス中')
@section('code', '503')
@section('message', 'メンテナンス中です。')
@section('content-left')
<p class="text-white mb-8">
    午前0時~1時はサービスを停止します。
</p>

<a href="https://spark.adobe.com/page/JwVbQbzQtbSkB" target="_blank" rel="noopener noreferrer" class="button mr-3">
    CLOTOについて
</a>

<a href="https://spark.adobe.com/page/Z34f2zfDFQnUU" target="_blank" rel="noopener noreferrer" class="button ml-3">
    使い方とQ&A
</a>
@endsection
@section('content-right')
{{-- Twitterタイムライン --}}
<div id="twitter-timeline">
    <a class="twitter-timeline" data-height="90vh" data-theme="dark" data-chrome="noheader nofooter noborders noscrollbar transparent" href="https://twitter.com/cloto_jp?ref_src=twsrc%5Etfw"></a>
</div>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
@endsection