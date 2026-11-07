@php
    $error = $error ?? null;
    $adminName = 'Asmaa';
    $categories = [
        ['name' => 'Games']
        ];
@endphp

@extends('layout.admin')

@section ('title', 'Categories - LootHub Admin')

@section ('content')

<section>
    <h1>Categories</h1>

    @if ($error !== null)
        <p style="color: red;">{{ $error }}</p>
    @endif

    @if (empty($categories))
        <p>No categories yet.</p>
    @else
        <ul>
            @foreach ($categories as $category)
                <li>
                    {{ $category['name'] }}
                    ({{ (int) ($category['subcategories_count'] ?? 0) }}subcategories)
                </li>
            @endforeach
        </ul>
    @endif

</section>

@endsection
