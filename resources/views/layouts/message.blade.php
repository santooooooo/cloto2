{{-- メッセージ --}}

@if(session()->has('success'))
<div class="alert alert-success">
    {{session('success')}}
</div>

@elseif(session()->has('error'))
<div class="alert alert-danger">
    {{session('error')}}
</div>
@endif


@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
