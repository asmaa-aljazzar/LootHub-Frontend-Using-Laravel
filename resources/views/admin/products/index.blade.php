@extends('layout.app')

@section('title', 'Products — LootHub')

@section('content')
@php
$userAppUrl = url('/');
$userBaseUrl = url('/');
$userLanguage = 'en';

/** @var array $products */
$products = $products ?? [['id' => 1, 'product_id' => 1, 'name' => 'Batman Logo Hoodie', 'image' => asset('images/products/batmanLogoHoodie.png'), 'price' => 25, 'stock_quantity' => 10, 'category_id' => 1, 'category_name' => 'Clothing', 'units_sold' => 1]];
$pageTitle = 'Discover';
$appUrl = url('/');
$csrfToken = $csrfToken ?? '';
$isLoggedIn = $isLoggedIn ?? false;
$userCategories = [];
$userSubcategories = [];
$userProductTypes = [];
foreach ($products as $product) {
    if (isset($product['product_type_id'], $product['product_type_name']) && $product['product_type_id'] !== null) {
        $userProductTypes[(string) $product['product_type_id']] = (string) $product['product_type_name'];
    }
    if (isset($product['category_id'], $product['category_name'])) {
        $categoryId = (string) $product['category_id'];
        $userCategories[$categoryId] = (string) $product['category_name'];
        if (isset($product['subcategorys_id'], $product['subcategorys_name'])) {
            $userSubcategories[$categoryId][(string) $product['subcategorys_id']] = (string) $product['subcategorys_name'];
        }
    }
}
asort($userCategories, SORT_NATURAL | SORT_FLAG_CASE);
asort($userProductTypes, SORT_NATURAL | SORT_FLAG_CASE);
foreach ($userSubcategories as &$categorySubcategories) {
    asort($categorySubcategories, SORT_NATURAL | SORT_FLAG_CASE);
}
unset($categorySubcategories);


@endphp

<section class="user-page">
    <div class="user-container" data-user-catalog-page>
        <p class="user-eyebrow">Curated for your next obsession</p>
        <h1 class="user-page-title">Find your next favorite.</h1>
        <p class="user-page-subtitle">
            Explore the collection, discover new picks, and save the things you love.
        </p>


        <div class="user-catalog-layout">
            <aside class="user-catalog-sidebar" aria-label="Product filters, scroll independently to see all options" tabindex="0">
                <div class="user-sidebar-heading">
                    <div><span class="user-eyebrow">FIND YOUR LOOT</span><h2>Filters</h2></div>
                    <button type="button" class="user-clear-filters" data-user-clear-filters>Clear all</button>
                </div>
                        <form class="user-catalog-search" action="{{ url('/products') }}" method="get" role="search" data-user-search-form>
            <label for="user-site-search">Search products</label>
            <input id="user-site-search" type="search" name="q" placeholder="Search products, categories and subcategories..." data-user-catalog-search autocomplete="off">
            <button type="submit" class="user-button-secondary">Search</button>
        </form>
        

                <details class="user-filter-group" open>
                    <summary><span class="user-filter-label">Category</span><span class="user-filter-arrow" aria-hidden="true"><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg></span></summary>
                    <div class="user-filter-body">        <div class="user-category-list" role="group" aria-label="Filter products by category">
            <button class="user-category-item" type="button" data-user-category data-category-id="all" data-category-name="All products" aria-pressed="true">
                All products
            </button>
            @foreach ($userCategories as $categoryId => $categoryName)
                <button
                    class="user-category-item"
                    type="button"
                    data-user-category
                    data-category-id="{{ $categoryId }}"
                    data-category-name="{{ $categoryName }}"
                    dir="auto"
                    aria-pressed="false">
                    {{ $categoryName }}
                </button>
            @endforeach
        </div>

</div>
                </details>
                <details class="user-filter-group" data-user-subcategory-group hidden open>
                    <summary><span class="user-filter-label">Subcategory</span><span class="user-filter-arrow" aria-hidden="true"><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg></span></summary>
                    <div class="user-filter-body">        <!-- Subcategory buttons appear after a category is selected. -->
        <div class="user-category-list" data-user-subcategory-list hidden role="group" aria-label="Filter products by subcategory">
            <button class="user-category-item" type="button" data-user-subcategory data-subcategory-id="all" data-subcategory-name="All subcategories" aria-pressed="true">
                All subcategories
            </button>
            @foreach ($userSubcategories as $subcategoryCategoryId => $subcategoryNames)
                @foreach ($subcategoryNames as $subcategoryId => $subcategoryName)
                    <button
                        class="user-category-item"
                        type="button"
                        data-user-subcategory
                        data-category-id="{{ (string) $subcategoryCategoryId }}"
                        data-subcategory-id="{{ (string) $subcategoryId }}"
                        data-subcategory-name="{{ $subcategoryName }}"
                        aria-pressed="false"
                        hidden>
                        {{ $subcategoryName }}
                    </button>
                @endforeach
            @endforeach
        </div>

</div>
                </details>
                <details class="user-filter-group" open>
                    <summary><span class="user-filter-label">Product Type</span><span class="user-filter-arrow" aria-hidden="true"><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg></span></summary>
                    <div class="user-filter-body">        <!-- Product types: e.g. 3D Models, Posters, Figures -->
        <div class="user-category-list" role="group" aria-label="Filter products by product type" data-user-type-list>
            <button class="user-category-item" type="button" data-user-type data-type-id="all" data-type-name="All types" aria-pressed="true">All types</button>
            @foreach ($userProductTypes as $typeId => $typeName)
                <button class="user-category-item" type="button" data-user-type
                    data-type-id="{{ $typeId }}"
                    data-type-name="{{ $typeName }}"
                    aria-pressed="false">{{ $typeName }}</button>
            @endforeach
        </div>

</div>
                </details>
                <details class="user-filter-group" open>
                    <summary><span class="user-filter-label">Price Range</span><span class="user-filter-arrow" aria-hidden="true"><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg></span></summary>
                    <div class="user-filter-body">
                        <div class="user-price-inputs">
                            <label for="user-min-price">Min (JD)<input id="user-min-price" data-user-min-price type="number" inputmode="decimal" min="0" step="0.01" placeholder="0"></label>
                            <span aria-hidden="true">—</span>
                            <label for="user-max-price">Max (JD)<input id="user-max-price" data-user-max-price type="number" inputmode="decimal" min="0" step="0.01" placeholder="Any"></label>
                        </div>
                        <div class="user-price-quick" aria-label="Price range presets" role="group">
                            <button type="button" data-user-price-preset="all" data-min="" data-max="" aria-pressed="true">All prices</button>
                            <button type="button" data-user-price-preset="0-20" data-min="0" data-max="20" aria-pressed="false">Up to 20 JD</button>
                            <button type="button" data-user-price-preset="20-50" data-min="20" data-max="50" aria-pressed="false">20 – 50 JD</button>
                            <button type="button" data-user-price-preset="50-100" data-min="50" data-max="100" aria-pressed="false">50 – 100 JD</button>
                            <button type="button" data-user-price-preset="100-200" data-min="100" data-max="200" aria-pressed="false">100 – 200 JD</button>
                            <button type="button" data-user-price-preset="200-up" data-min="200" data-max="" aria-pressed="false">200+ JD</button>
                        </div>
                    </div>
                </details>
            </aside>
            <div class="user-catalog-results">
        <div class="user-section-heading">
            <div>
                <h2>Explore the collection</h2>
                <p>Browse real products from the LootLab catalog.</p>
            </div>
        </div>

        <div class="user-catalog-toolbar">
            <p class="user-catalog-result" aria-live="polite">
                <strong data-user-result-count>{{ count($products) }}</strong>
                <span> products · </span>
                <span data-user-active-category>All products</span>
            </p>
            <div class="user-catalog-tools">
                <label for="user-product-sort">Sort by</label>
                <select class="user-select" id="user-product-sort" data-user-sort>
                    <option value="newest">Recently added</option>
                    <option value="price-asc">Price: low to high</option>
                    <option value="price-desc">Price: high to low</option>
                    <option value="name">Name</option>
                </select>
            </div>
        </div>

        <div class="user-products-grid" data-user-catalog>
            @foreach ($products as $product)
                @php
$productId = (int) ($product['id'] ?? 0);
                $categoryId = (string) ($product['category_id'] ?? '');
                $categoryName = (string) ($product['category_name'] ?? '');
                $productName = (string) ($product['name'] ?? '');
                $productDescription = trim((string) ($product['description'] ?? ''));
                $price = (float) ($product['price'] ?? 0);
                $discountPrice = isset($product['discount_price']) && $product['discount_price'] !== null
                    ? (float) $product['discount_price']
                    : null;
                $image = trim((string) ($product['image'] ?? ''));
                $inStock = (int) ($product['stock_quantity'] ?? 0) > 0;
                $has3DModel = trim((string) ($product['model_path'] ?? '')) !== '';
                
@endphp
                <article
                    class="user-product-card"
                    data-user-product-card
                    data-product-id="{{ $productId }}"
                    data-category-id="{{ $categoryId }}"
                    data-category-name="{{ $categoryName }}"
                    data-subcategory-id="{{ (string) ($product['subcategorys_id'] ?? '') }}"
                    data-subcategory-name="{{ (string) ($product['subcategorys_name'] ?? '') }}"
                    data-type-id="{{ (string) ($product['product_type_id'] ?? '') }}"
                    data-name="{{ $productName }}"
                    data-price="{{ (string) ($discountPrice ?? $price) }}">
                    <div class="user-product-media">
                        @if ($has3DModel)
                            <span class="lootlab-3d-badge">◈ 3D VIEW</span>
                        @endif
                        @if ($discountPrice !== null)
                            <span class="user-discount-badge">Deal</span>
                        @endif
                        @if (!$inStock)
                            <span class="user-stock-badge">Out of stock</span>
                        @endif
                        <button
                            class="user-favorite-button"
                            type="button"
                            data-user-favorite-button
                            data-product-id="{{ $productId }}"
                            aria-pressed="false"
                            aria-label="Add to favorites">♡</button>
                        <a class="user-product-image-link" href="{{ url('/products/' . $productId) }}" aria-label="View {{ $productName }}">
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
                        <p class="user-product-category" dir="auto">{{ $categoryName }}</p>
                        <h3 class="user-product-title" dir="auto">
                            <a href="{{ url('/products/' . $productId) }}">
                                {{ $productName }}
                            </a>
                        </h3>
                        <p class="user-product-rating">
                            @if ((int) ($product['review_count'] ?? 0) > 0)
                                <span aria-hidden="true">★</span>
                                {{ number_format((float) $product['average_rating'], 1) }} / 5
                                ({{ (int) $product['review_count'] }} reviews)
                            @else
                                No reviews yet
                            @endif
                        </p>
                        <div class="user-product-price" aria-label="Product price">
                            @if ($discountPrice !== null)
                                <span class="user-price-current">{{ number_format($discountPrice, 2) }} JD</span>
                                <span class="user-price-old">{{ number_format($price, 2) }} JD</span>
                            @else
                                <span class="user-price-current">{{ number_format($price, 2) }} JD</span>
                            @endif
                        </div>
                        <p class="user-product-description" dir="auto">{{ $productDescription !== '' ? $productDescription : 'Explore this LootLab collectible.' }}</p>
                        <a class="user-click-details" href="{{ url('/products/' . $productId) }}">CLICK TO DETAILS</a>
                        <div class="user-product-actions">
                            <button
                                class="user-button"
                                type="button"
                                data-user-add-to-cart
                                data-product-id="{{ $productId }}"
                                {{ $inStock ? '' : 'disabled' }}
                                {{ $inStock ? '' : 'title="Out of stock"' }}
                                aria-label="Add {{ $productName }} to cart">
                                {{ $inStock ? 'Add to cart' : 'Unavailable' }}
                            </button>
                        </div>
                    </div>
                </article>
            @endforeach
            @if ($products === [])
                <div class="user-empty-state">
                    <span class="user-empty-icon" aria-hidden="true">✦</span>
                    <h2>The collection is getting ready</h2>
                    <p>There are no active products to show right now. Please check back soon.</p>
                </div>
            @else
                <div class="user-empty-state" data-user-no-results hidden>
                    <span class="user-empty-icon" aria-hidden="true">⌕</span>
                    <h2>No matches found</h2>
                    <p>Try a different search or choose another category.</p>
                </div>
            @endif
        </div>
        <nav class="user-catalog-pagination" aria-label="Product pages" data-user-pagination></nav>
        <p class="user-status-note">
            <span aria-hidden="true">i</span>
            <span>Ratings are based on customer reviews. Open a product to read its reviews.</span>
        </p>
            </div>
        </div>
    </div>
</section>
@vite('resources/js/catalog-filter-fix.js')


@endsection
