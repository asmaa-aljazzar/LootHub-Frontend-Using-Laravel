@php
    $adminName = 'Asmaa';
    $category = ['name' => 'Game'];
    $subcategories = [['name' => 'anime']];
@endphp

@extends('layout.admin')

@section('title', 'Show - LootHub Admin')

@section('content')

    <section>

        <h1>{{ $category['name'] }}</h1>

        <h2>Subcategories</h2>

        @if (empty($subcategories))
        <p>No subcategories.</p>
        @else
        <ul>
            @foreach ($subcategories as $subcategory)
            <li>{{ $subcategory['name'] }}</li>
            @endforeach
        </ul>
        @endif
    </section>
@endsection
