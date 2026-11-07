@extends('layout.app')

@section('title', 'Product details — LootHub')

@section('content')
@php
$userAppUrl = url('/');
$userBaseUrl = url('/');
$userLanguage = 'en';
$product = $product ?? ['id' => 1, 'name' => 'Batman Logo Hoodie', 'description' => 'Sample product for frontend preview.', 'image' => asset('images/products/batmanLogoHoodie.png'), 'price' => 25, 'stock_quantity' => 10];

/**
 * Product Details Page
 *
 * Expects:
 * $product (array from Product::getById())
 */

$product = isset($product) && is_array($product) ? $product : [];

$pageTitle = isset($product['name'])
    ? (string) $product['name']
    : 'Product details';

$productId = (int) ($product['id'] ?? 0);
$productName = (string) ($product['name'] ?? '');
$productDescription = (string) ($product['description'] ?? '');
$productImage = trim((string) ($product['image'] ?? ''));
$productModel = trim((string) ($product['model_path'] ?? ''));

$price = (float) ($product['price'] ?? 0);

$discountPrice = isset($product['discount_price'])
    && $product['discount_price'] !== null
    ? (float) $product['discount_price']
    : null;

$stockQuantity = (int) ($product['stock_quantity'] ?? 0);
$inStock = $stockQuantity > 0;

$categoryName = (string) ($product['category_name'] ?? '');
$subcategoryName = (string) ($product['subcategorys_name'] ?? '');

$appUrl = url('/');



@endphp


<section class="user-page">
    <div class="user-container">

        <!-- Breadcrumb -->
        <p class="user-eyebrow">
            <a href="{{ url('/products') }}">
                Discover
            </a>

            <span aria-hidden="true"> / </span>

            <span dir="auto">
                {{ $categoryName }}
            </span>
        </p>

        <div class="user-detail-layout">

            <!-- Product image or interactive 3D viewer -->
            <div class="user-detail-media {{ $productModel !== '' ? 'lootlab-3d-media' : '' }}">
                @if ($productModel !== '')
                    <div class="lootlab-3d-viewer" data-lootlab-3d-viewer
                        data-model-src="{{ $productModel }}"
                        aria-label="Interactive 3D preview of {{ $productName }}">
                        @if ($productImage !== '')
                        <img class="lootlab-3d-preview" data-lootlab-3d-preview
                             src="{{ $productImage }}"
                             alt="{{ $productName }}"
                             style="position:absolute;inset:0;width:100%;height:100%;object-fit:contain;z-index:0;pointer-events:none;">
                        @endif
                        <p class="lootlab-3d-status" data-lootlab-3d-status role="status">Loading interactive 3D model…</p>
                        <div class="lootlab-3d-controls">
                            <button type="button" data-lootlab-3d-reset>Reset view</button>
                        </div>
                    </div>
                    <p class="lootlab-3d-hint">Drag to rotate · Scroll to zoom</p>
                @else

                <img
                    data-user-product-image
                    src="{{ $productImage }}"
                    alt="{{ $productName }}"
                    {{ $productImage === '' ? 'hidden' : '' }}>

                <span
                    class="user-image-fallback"
                    data-user-image-fallback
                    {{ $productImage !== '' ? 'hidden' : '' }}
                    aria-hidden="true">
                    ✦
                </span>
                @endif
            </div>

            <!-- Product Information -->
            <div class="user-detail-copy">

                <p class="user-eyebrow" dir="auto">
                    {{ $subcategoryName }}
                </p>

                <h1 dir="auto">
                    {{ $productName }}
                </h1>

                <!-- Stock -->
                <p class="user-stock-copy {{ $inStock ? '' : 'user-is-out' }}">

                    @if ($inStock)

                        In stock · {{ $stockQuantity }} available

                    @else

                        Currently out of stock

                    @endif

                </p>

                <!-- Price -->
                <div class="user-product-price user-detail-price">

                    @if ($discountPrice !== null)

                        <span class="user-price-current">
                            {{ number_format($discountPrice, 2) }} JOD
                        </span>

                        <span class="user-price-old">
                            {{ number_format($price, 2) }} JOD
                        </span>

                        <span class="user-price-tag">
                            Special price
                        </span>

                    @else

                        <span class="user-price-current">
                            {{ number_format($price, 2) }} JOD
                        </span>

                    @endif

                </div>

                <!-- Description -->
                <div class="user-detail-description" dir="auto">
                    {!! nl2br(e($productDescription)) !!}
                </div>

                <!-- Actions -->
                <div class="user-product-actions user-detail-actions">

                    <button
                        class="user-favorite-button"
                        type="button"
                        data-user-favorite-button
                        data-product-id="{{ $productId }}"
                        aria-pressed="false"
                        aria-label="Add to favorites">
                        ♡
                    </button>

                    <button
                        class="user-button"
                        type="button"
                        data-user-add-to-cart
                        data-product-id="{{ $productId }}"
                        {{ $inStock ? '' : 'disabled' }}
                        {{ $inStock ? '' : 'title="Out of stock"' }}
                        aria-label="Add {{ $productName }} to cart">

                        {{ $inStock ? 'Add to cart' : 'Out of stock' }}

                    </button>

                </div>

                <p class="user-status-note">
                    <span aria-hidden="true">i</span>
                    <span>
                        Add products to your cart to review them before checkout.
                    </span>
                </p>

            </div>
        </div>

        <!-- Product Reviews -->
        @include('reviews.index')

    </div>
</section>

@if ($productModel !== '')
@vite('resources/js/product-3d.js')
@endif


@endsection
