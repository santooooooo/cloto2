@extends('errors::layout')

@section('title', 'メンテナンス中')
@section('code', '503')
@section('message', 'メンテナンス中です。')
@section('content')
{{-- Twitterタイムライン --}}
<div id="twitter-timeline">
    <a class="twitter-timeline" data-height="90vh" data-theme="dark" data-chrome="noheader nofooter noborders noscrollbar transparent" href="https://twitter.com/cloto_jp?ref_src=twsrc%5Etfw"></a>
</div>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
@endsection