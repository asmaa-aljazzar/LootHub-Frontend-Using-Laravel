@extends('layout.app')

@section('title', 'Not found — LootHub')

@section('content')
@php
$userAppUrl = url('/');
$userBaseUrl = url('/');
$userLanguage = 'en';


/**
 * Expects: $message (string). Used by ProductController and Admin\CategoryController.
 */
$message = $message ?? 'Page not found.';

@endphp
<section class="user-page"><div class="user-container"><h1>Not found</h1><p>{{ $message }}</p></div></section>
@endsection
