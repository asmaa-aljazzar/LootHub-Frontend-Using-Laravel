@extends('layout.app')

@section('title', 'Order confirmation — LootHub')

@section('content')
@php
    $orderId = (int) ($orderId ?? 1);
    $paymentMethod = $paymentMethod ?? 'cod';
    $paidAmount = $paidAmount ?? null;
@endphp

<section class="user-page">
    <div class="user-container">
        <div class="user-empty-state">

            <span class="user-empty-icon" aria-hidden="true">
                ✓
            </span>

            <p class="user-eyebrow">
                Order confirmation
            </p>

            @if ($orderId > 0)

                <h1 class="user-page-title">
                    Thank you for your order!
                </h1>

                <p>
                    Your order
                    <strong>
                        #{{ (string) $orderId }}
                    </strong>
                    was placed successfully.
                </p>

                @if ($paymentMethod === 'stripe')

                    <p>
                        Payment received by card.
                    </p>

                    @if ($paidAmount !== null)
                        <p>
                            Amount charged:
                            <strong>
                                {{ (string) $paidAmount }}
                            </strong>
                        </p>
                    @endif

                @else

                    <p>
                        Payment method:
                        <strong>Cash on Delivery</strong>
                    </p>

                    <p>
                        You pay when your order arrives.
                    </p>

                @endif

            @else

                <h1 class="user-page-title">
                    No order confirmation available
                </h1>

                <p>
                    We could not find an order to confirm.
                </p>

            @endif

            <a
                class="user-button"
                href="{{ url('/products') }}">
                Continue shopping
            </a>

        </div>
    </div>
</section>


@endsection
