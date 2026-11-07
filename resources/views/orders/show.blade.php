@extends('layout.app')

@section('title', 'Order Details — LootHub')

@section('content')
@php
    $order = $order ?? ['id' => 1, 'total_amount' => 25, 'status' => 'processing', 'created_at' => '2026-11-07 12:00:00', 'shipping_address' => 'Sample Street, Amman', 'phone' => '+962 790 000 000'];
    $items = $items ?? [['name' => 'Batman Logo Hoodie', 'quantity' => 1, 'unit_price' => 25, 'product_id' => 1]];
    $canReview = $canReview ?? false;
@endphp

<section class="user-page">
    <div class="user-container">

        <p class="user-eyebrow">Purchase details</p>

        @if (!empty($order) && isset($order['id']))

            <h1 class="user-page-title">
                Order #{{ (int) $order['id'] }}
            </h1>

            <p class="user-page-subtitle">
                Review your order information.
            </p>

            <div class="user-form-card">

                <dl class="user-order-details">

                    <dt>Order Number</dt>
                    <dd>
                        #{{ (int) $order['id'] }}
                    </dd>

                    <dt>Status</dt>
                    <dd>
                        {{ (string) ($order['status'] ?? '') }}
                    </dd>

                    <dt>Total</dt>
                    <dd>
                        {{ (string) ($order['total_amount'] ?? '') }}
                    </dd>

                    <dt>Shipping Address</dt>
                    <dd>
                        <span style="white-space: pre-line;">{{ (string) ($order['shipping_address'] ?? '') }}</span>
                    </dd>

                    @if (isset($order['delivery_lat'], $order['delivery_lng']))
                        <dt>Delivery Meeting Point</dt>
                        <dd>
                            {{ (string) ($order['meeting_point_label'] ?? 'Pinned location') }}
                            <a target="_blank" rel="noopener noreferrer" href="https://www.google.com/maps/dir/?api=1&amp;destination={{ rawurlencode((string) $order['delivery_lat'] . ',' . (string) $order['delivery_lng']) }}">Open directions in Google Maps</a>
                        </dd>
                    @endif

                    <dt>Phone Number</dt>
                    <dd>
                        {{ (string) ($order['phone'] ?? '') }}
                    </dd>

                    <dt>Placed On</dt>
                    <dd>
                        {{ (string) ($order['created_at'] ?? '') }}
                    </dd>

                </dl>

            </div>

            @if ($items !== [])
            <div class="user-form-card"><h2>Ordered products</h2><div class="user-order-items">
                @foreach ($items as $item)
                <div class="user-order-item-row">
                    <span>{{ (string)$item['name'] }} × {{ (int)$item['quantity'] }}</span>
                    <span>{{ number_format((float)$item['unit_price'], 2) }} JD</span>
                    @if ($canReview)
                    <a class="user-button-secondary" href="{{ url('/products/' . (int) $item['product_id']) . '#user-reviews-heading' }}">Rate this item (optional)</a>
                    @endif
                </div>
                @endforeach
            </div></div>
            @endif
            <div class="user-form-actions">
                <a
                    class="user-button-secondary"
                    href="{{ url('/orders') }}">
                    Back to Orders
                </a>
            </div>

        @else

            <div class="user-empty-state">

                <span class="user-empty-icon" aria-hidden="true">
                    📦
                </span>

                <h1 class="user-page-title">
                    Order Not Found
                </h1>

                <p>
                    This order is unavailable.
                </p>

                <a
                    class="user-button"
                    href="{{ url('/orders') }}">
                    Back to Orders
                </a>

            </div>

        @endif

    </div>
</section>


@endsection
