@extends('errors::layout')

@section('title', 'メンテナンス中')
@section('code', '503')
@section('message', 'メンテナンス中です。')
@section('content-left')
<a href="https://spark.adobe.com/page/JwVbQbzQtbSkB" target="_blank" rel="noopener noreferrer" class="button mr-3 mb-8">
    CLOTOについて
</a>

<a href="https://spark.adobe.com/page/Z34f2zfDFQnUU" target="_blank" rel="noopener noreferrer" class="button ml-3 mb-8">
    使い方とQ&A
</a>

<table class="bg-white font-bold mb-8">
    <thead>
        <tr>
            <th>スケジュール</th>
            <th>月 ~ 金</th>
            <th>土 日</th>
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

<p class="text-white text-xl font-bold">
    デモ版は <a href="https://demo.cloto.jp" target="_blank" rel="noopener noreferrer" class="text-red">こちら</a>
</p>
@endsection
@section('content-right')
{{-- Twitterタイムライン --}}
<div id="twitter-timeline">
    <a class="twitter-timeline" data-height="90vh" data-theme="dark" data-chrome="noheader nofooter noborders noscrollbar transparent" href="https://twitter.com/cloto_jp?ref_src=twsrc%5Etfw"></a>
</div>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
@endsection