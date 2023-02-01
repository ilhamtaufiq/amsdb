@extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message')
<img src="https://http.cat/401" alt="https://http.cat/401" class="shrinkToFit" width="500" height="500">
@endsection
