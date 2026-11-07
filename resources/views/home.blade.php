@extends ('layout.app')
@section ('title', 'Home - LootHub')
@section ('content')

@php
    $topProducts = [];
    $topProductsWithSales = 0;
    $hasDemoRankings = false;
@endphp


<section class="user-page">
    <div class="user-container">
        <div class="user-home-hero">
            <p class="user-eyebrow">LOOT HUB · A WORLD OF FANDOM</p>
            <h1>Collect what you <em>love.</em></h1>
            <p>Discover gaming, anime, and pop-culture collectibles curated for fans. Find something unforgettable, save it, and make it yours.</p>
            <a class="user-button" href="{{url('/products')}}">Explore Products</a>
        </div>

        <section class="user-home-about" id="about">
            <div>
                <p class="user-eyebrow">ABOUT LOOT HUB</p>
                <h2>Made for your next obsession.</h2>
            </div>
            <div>
                <p>LootLab brings the worlds of anime, gaming, movies, and TV together in one place. Discover collectibles, figures, posters, apparel, and accessories that celebrate what you love.</p>
                <p>Save products to Favorites, preview 3D models, or ask Loote AI for personalized recommendations.</p>
            </div>
        </section>
    </div>

    <section class="user-home-featured user-topten-section" aria-labelledby="home-topten-heading">
        <div class="user-container">
            <div class="user-section-heading user-topten-heading">
                <div>
                    <p class="user-eyebrow">TOP 10 · FAN FAVORITES</p>
                    <h2 id="home-topten-heading">Best Sellers</h2>
                    <p class="user-topten-description">
                        @if ($topProductsWithSales >= count($topProducts) && count($topProducts) > 0)
                            Ranked by quantities from processed and fulfilled orders.
                        @elseif ($hasDemoRankings)
                            Preview leaderboard: simulated starting sales are added to confirmed sales for ranking.
                        @else
                            Discover popular picks while confirmed sales rankings build up.
                        @endif
                    </p>
                </div>
                <a class="user-button-secondary" href="{{url('/products')}}">View all products</a>
            </div>
        </div>

        @if ($topProducts === [])
            <div class="user-container"><p class="user-status-note">No active products are available yet.</p></div>
        @else
            <div class="user-topten-viewport" aria-label="Moving top ten product showcase. Hover or focus on a product to pause." tabindex="0">
                <div class="user-topten-track">
                    @foreach ([false, true] as $duplicate)
                        <div class="user-topten-set" @if ($duplicate) aria-hidden="true" @endif>
                            @foreach ($topProducts as $index => $product)

                                @php
                                $id = (int) ($product['id'] ?? 0);
                                $name = (string) ($product['name'] ?? '');
                                $image = trim((string) ($product['image'] ?? ''));
                                $price = (float) ($product['discount_price'] ?? $product['price'] ?? 0);
                                $unitsSold = (int) ($product['units_sold'] ?? 0);
                                $productHref = url('/products/' . $id);
                                @endphp

                                <article class="user-topten-card">
                                <a class="user-topten-details"
                                    href="{{ $productHref }}"
                                    aria-label="{{ $name }}"
                                    @if ($duplicate) tabindex="-1" @endif>
                                    <span class="user-topten-media">
                                        @if ($image !== '')
                                            <img src="{{$image }}"
                                                alt="{{$duplicate ? '' : $name }}"
                                                loading="lazy">
                                        @else
                                            <span class="user-image-fallback" aria-hidden="true">✦</span>
                                        @endif
                                        <span class="user-topten-rank">#{{ $index + 1 }}</span>
                                    </span>
                                    <span class="user-topten-copy">
                                        <strong dir="auto">{{$name}}</strong>
                                        <span class="user-topten-price">{{number_format($price, 2) }} JD</span>
                                        <span class="user-topten-cta">View details <span aria-hidden="true">↗</span></span>
                                    </span>
                                </a>
                                <div class="user-topten-actions">
                                    <button class="user-favorite-button" type="button" data-user-favorite-button
                                        data-product-id="{{$id }}" aria-pressed="false" aria-label="Add to favorites"
                                        @if ($duplicate) tabindex="-1" @endif>♡</button>
                                    <button class="user-button" type="button" data-user-add-to-cart data-product-id="{{$id }}"
                                        @if ($duplicate) tabindex="-1" @endif
                                        {{(int) ($product['stock_quantity'] ?? 0) > 0 ? '' : 'disabled' }}>
                                        {{(int) ($product['stock_quantity'] ?? 0) > 0 ? 'Add to cart' : 'Out of stock' }}
                                    </button>
                                </div>
                                </article>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
            <p class="user-topten-hint">Hover to pause · Click to explore</p>
        @endif
    </section>
</section>
@endsection