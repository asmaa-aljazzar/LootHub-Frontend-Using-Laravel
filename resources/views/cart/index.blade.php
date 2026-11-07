@extends('layout.app')

@section('title', 'Cart — LootHub')

@section('content')
<section class="user-page user-cart" data-store-preview>
    <div class="user-container">
        <p class="user-eyebrow">Your picks</p>
        <h1 class="user-page-title">Shopping cart</h1>
        <p class="user-page-subtitle">Review your selected products before checkout.</p>
        <div data-user-cart>
            <p class="user-form-message" data-cart-status role="status" aria-live="polite">Sample product for frontend preview.</p>
            <div class="user-empty-state" data-cart-empty hidden>
                <span class="user-empty-icon" aria-hidden="true">▱</span>
                <h2>Your cart is empty</h2>
                <p>Find something you love and add it to your cart.</p>
                <a class="user-button-secondary" href="{{ url('/products') }}">Continue browsing</a>
            </div>
            <div class="user-cart-items" data-cart-items>
                <article class="user-cart-item">
                    <div class="user-cart-item-info">
                        <img class="user-cart-image" src="{{ asset('images/products/batmanLogoHoodie.png') }}" alt="Batman Logo Hoodie" width="96" height="96">
                        <div><h2>Batman Logo Hoodie</h2><p>25.00 JD · Quantity: 1</p><strong>25.00 JD</strong></div>
                    </div>
                    <div class="user-cart-item-controls">
                        <label>Quantity <input type="number" value="1" min="1" disabled></label>
                        <button class="user-button-quiet" type="button" disabled>Remove</button>
                    </div>
                </article>
            </div>
            <section class="user-cart-summary user-data-card" data-cart-summary aria-label="Cart totals">
                <h2>Order summary</h2>
                <dl>
                    <div><dt>Subtotal</dt><dd data-cart-subtotal>25.00 JD</dd></div>
                    <div><dt>Discount</dt><dd data-cart-discount>0.00 JD</dd></div>
                    <div class="user-cart-total"><dt>Total</dt><dd data-cart-total>25.00 JD</dd></div>
                </dl>
            </section>
            <div class="user-cart-page-actions">
            <a class="user-button loothub-checkout-btn" href="{{ url('/checkout') }}">Proceed to checkout →</a>
            <a class="user-button-secondary" href="{{ url('/products') }}">Continue browsing</a>
            </div>
        </div>
    </div>
</section>

@endsection
