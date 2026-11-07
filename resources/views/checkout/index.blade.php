@extends('layout.app')

@section('title', 'Checkout — LootHub')

@section('content')
@php
    $old = $old ?? ['shipping_address' => 'Sample Street, Amman', 'phone' => '+962 790 000 000'];
    $error = $error ?? null;
    $notice = $notice ?? null;
    $selectedMethod = $old['payment_method'] ?? 'cod';
    $totals = $totals ?? ['subtotal' => 25, 'discount' => 0, 'total' => 25];
    $appliedPromoCode = $appliedPromoCode ?? '';
    $promoNotice = $promoNotice ?? null;
    $promoError = $promoError ?? null;
    $conversionRate = $conversionRate ?? '1.41'; // Display-only preview value.
@endphp
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<section class="user-page">
    <div class="user-container">

        <p class="user-eyebrow">Almost yours</p>
        <h1 class="user-page-title">Checkout</h1>
        <p class="user-page-subtitle">
            Review your order and delivery information.
        </p>

        <div class="user-form-card">

            @if ($error)
                <p class="user-form-message" role="alert">
                    {{ (string) $error }}
                </p>
            @endif

            @if ($notice)
                <p class="user-form-message" role="status">
                    {{ (string) $notice }}
                </p>
            @endif

<div class="user-field">

    <h2>Promo Code</h2>

    @if ($promoNotice)
        <p role="status" style="color: green;">
            {{ $promoNotice }}
        </p>
    @endif

    @if ($promoError)
        <p role="alert" style="color: crimson;">
            {{ $promoError }}
        </p>
    @endif

    <form class="user-promo-form" method="POST"
          action="{{ url('/checkout/promo') }}">

        @csrf

        <input
            class="user-input"
            type="text"
            name="promo_code"
            aria-label="Promo code"
            placeholder="Enter promo code"
            maxlength="100"
            required>

        <button class="user-button" type="submit">
            Apply Promo
        </button>
    </form>

    @if ($appliedPromoCode !== '')

        <p>
            Applied:
            <strong>
                {{ $appliedPromoCode }}
            </strong>
        </p>

        <form method="POST"
              action="{{ url('/checkout/promo/remove') }}">

            @csrf

            <button class="user-button-secondary" type="submit">
                Remove Promo
            </button>
        </form>

    @endif

</div>

<div class="user-field">
    <h2>Order Summary</h2>

    <p>
        Subtotal:
        {{ number_format((float) $totals['subtotal'], 2) }} JOD
    </p>

    <p>
        Discount:
        -{{ number_format((float) $totals['discount'], 2) }} JOD
    </p>

    <h3>
        Total:
        {{ number_format((float) $totals['total'], 2) }} JOD
    </h3>
</div>


            <form
                class="user-form"
                action="{{ url('/checkout') }}"
                method="POST">

                @csrf

                <div class="user-field">
                    <label for="shipping_address">
                        Shipping Address
                    </label>

                    <textarea
                        class="user-input"
                        id="shipping_address"
                        name="shipping_address"
                        required>{{ (string) ($old['shipping_address'] ?? '') }}</textarea>
                </div>

                <div class="checkout-map-section" data-checkout-map>
                    <div class="checkout-map-header">
                        <div>
                            <h2>Choose your delivery meeting point</h2>
                            <p>Search your address in Jordan, then drag the pin to the exact spot where the courier should meet you.</p>
                        </div>
                        <span class="checkout-map-country">🇯🇴 Jordan only</span>
                    </div>
                    <div class="checkout-map-tools">
                        <button class="user-button-secondary" type="button" id="checkout-find-address">Search address on map</button>
                        <button class="user-button-secondary" type="button" id="checkout-my-location">Use my location</button>
                    </div>
                    <div class="checkout-map-results" id="checkout-address-results" hidden></div>
                    <div class="checkout-map-canvas" id="checkout-jordan-map" role="application" aria-label="Map of Jordan, click to set delivery meeting point"></div>
                    <p class="checkout-map-hint">Click the map or drag the marker to pin your meeting point. The pin must be inside Jordan.</p>
                    <p class="checkout-map-status" id="checkout-map-status" role="status">No meeting point selected yet.</p>
                    <div class="checkout-selected-location">
                        <strong>📍 Delivery meeting point:</strong>
                        <span id="checkout-meeting-point-preview">Not selected</span>
                    </div>
                    <input type="hidden" id="delivery_lat" name="delivery_lat" value="{{ (string) ($old['delivery_lat'] ?? '') }}">
                    <input type="hidden" id="delivery_lng" name="delivery_lng" value="{{ (string) ($old['delivery_lng'] ?? '') }}">
                    <input type="hidden" id="meeting_point_label" name="meeting_point_label" value="{{ (string) ($old['meeting_point_label'] ?? '') }}">
                </div>

                <div class="user-field">
                    <label for="phone">
                        Phone Number
                    </label>

                    <input
                        class="user-input"
                        type="tel"
                        id="phone"
                        name="phone"
                        value="{{ (string) ($old['phone'] ?? '') }}"
                        required>
                </div>

                <p class="checkout-otp-notice">🔐 Before placing the order or paying with Stripe, we'll send a 6-digit SMS verification code to your phone.</p>

                <fieldset class="user-field">
                    <legend>Payment Method</legend>

                    <label>
                        <input
                            type="radio"
                            name="payment_method"
                            value="cod"
                            @checked($selectedMethod === 'cod')>
                        Cash on Delivery
                    </label>

                    <label>
                        <input
                            type="radio"
                            name="payment_method"
                            value="stripe"
                            @checked($selectedMethod === 'stripe')>
                        Credit / Debit Card (Stripe)
                    </label>
                </fieldset>

                <p class="user-page-subtitle">
                    Stripe payments use the sandbox environment.
                    Conversion rate:
                    1 JOD =
                    {{ $conversionRate }}
                    USD.
                    Order totals are stored in JOD.
                </p>

                <div class="user-form-actions">

                    <button
                        class="user-button"
                        type="submit"
                        formaction="{{ url('/checkout') }}">
                        Place Order (Cash on Delivery)
                    </button>

                    <button
                        class="user-button-secondary"
                        type="submit"
                        formaction="{{ url('/checkout/stripe') }}">
                        Pay with Stripe
                    </button>

                </div>

            </form>

        </div>

    </div>
</section>




@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" defer></script>
    @vite('resources/js/checkout-map.js')
@endpush
