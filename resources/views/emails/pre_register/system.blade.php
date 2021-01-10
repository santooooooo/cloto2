お名前：{{ $content['from_name'] }}
メールアドレス：{{ $content['from'] }}

@if ($content['newsletter'])    
メールアンケート：許可
@else
メールアンケート：拒否
@endif

上記のユーザーによる仮登録申請がありました。