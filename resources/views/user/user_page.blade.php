@extends('layouts.app')

@section('title', $user->handlename.config('consts.title.CLOTO'))

@section('content')
@include('user.profile')

<div class="container mt-3 mb-3">
    This is test.
</div>
@endsection