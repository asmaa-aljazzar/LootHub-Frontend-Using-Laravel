@extends('layout.app')

@section('title', 'Favorites — LootHub')

@section('content')
@php
    $items = $items ?? [[
        'product_id' => 1,
        'name' => 'Batman Logo Hoodie',
        'image' => asset('images/products/batmanLogoHoodie.png'),
        'price' => 25,
        'discount_price' => null,
        'stock_quantity' => 10,
    ]];
@endphp

<section class="user-page user-favorites" data-store-preview>
    <div class="user-container">
        <p class="user-eyebrow">Saved for later</p>
        <h1 class="user-page-title">Your favorites</h1>
        <p class="user-page-subtitle">Products you have saved from the collection. Sample product for frontend preview.</p>
        <p class="user-form-message" data-favorites-status role="status" aria-live="polite"></p>
        <div class="user-products-grid" data-favorites-list>
            @foreach ($items as $item)
                @php
$productId = (int) ($item['product_id'] ?? 0);
                $productName = (string) ($item['name'] ?? '');
                $image = trim((string) ($item['image'] ?? ''));
                $price = (float) ($item['price'] ?? 0);
                $inStock = (int) ($item['stock_quantity'] ?? 0) > 0;
                $discountPrice = isset($item['discount_price']) && $item['discount_price'] !== null
                    ? (float) $item['discount_price']
                    : null;
                @endphp
                <article class="user-product-card" data-favorite-product="{{ $productId }}">
                    <div class="user-product-media">
                        <button
                            class="user-favorite-button"
                            type="button"
                            disabled title="Preview only"
                            data-product-id="{{ $productId }}"
                            aria-pressed="true"
                            aria-label="Remove from favorites">♥</button>
                        <a
                            class="user-product-image-link"
                            href="{{ url('/products/' . $productId) }}"
                            aria-label="View {{ $productName }}">
                            <img
                                class="user-product-image"
                                data-user-product-image
                                src="{{ $image }}"
                                alt="{{ $productName }}"
                                loading="lazy"
                                {{ $image === '' ? 'hidden' : '' }}>
                            <span class="user-image-fallback" data-user-image-fallback {{ $image !== '' ? 'hidden' : '' }} aria-hidden="true">✦</span>
                        </a>
                    </div>
                    <div class="user-product-content">
                        <h2 class="user-product-title" dir="auto">
                            <a href="{{ url('/products/' . $productId) }}">
                                {{ $productName }}
                            </a>
                        </h2>
                        <div class="user-product-price" aria-label="Product price">
                            @if ($discountPrice !== null)
                                <span class="user-price-current">{{ number_format($discountPrice, 2) }} JD</span>
                                <span class="user-price-old">{{ number_format($price, 2) }} JD</span>
                            @else
                                <span class="user-price-current">{{ number_format($price, 2) }} JD</span>
                            @endif
                        </div>
                        <div class="user-product-actions">
                            <a class="user-button-secondary" href="{{ url('/products/' . $productId) }}">Details</a>
                            <button class="user-button" type="button" disabled title="Preview only" data-product-id="{{ $productId }}" {{ $inStock ? '' : 'disabled' }}>{{ $inStock ? 'Add to cart' : 'Out of stock' }}</button>
                        </div>
                    </div>
                </article>
            @endforeach
            @if ($items === [])
                <div class="user-empty-state" data-favorites-empty>
                    <span class="user-empty-icon" aria-hidden="true">♡</span>
                    <h2>No favorites saved yet</h2>
                    <p>Save a product from the collection and it will appear here.</p>
                    <a class="user-button-secondary" href="{{ url('/products') }}">Browse products</a>
                </div>
            @endif
        </div>
    </div>
</section>

@endsection
