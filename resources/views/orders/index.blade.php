@extends('layout.app')

@section('title', 'My Orders — LootHub')

@section('content')
@php
    $orders = $orders ?? [['id' => 1, 'total_amount' => 25, 'status' => 'processing', 'created_at' => '2026-11-07 12:00:00', 'shipping_address' => 'Sample Street, Amman', 'phone' => '+962 790 000 000']];
@endphp

<section class="user-page">
    <div class="user-container">

        <p class="user-eyebrow">Your purchase history</p>

        <h1 class="user-page-title">My Orders</h1>

        <p class="user-page-subtitle">
            Track your order status and review previous purchases.
        </p>

        @if (empty($orders))

            <div class="user-empty-state">
                <span class="user-empty-icon" aria-hidden="true">
                    📦
                </span>

                <h2>No orders yet</h2>

                <p>
                    You haven't placed any orders yet.
                </p>

                <a
                    class="user-button"
                    href="{{ url('/products') }}">
                    Start Shopping
                </a>
            </div>

        @else

            <div class="user-form-card">

                <div style="overflow-x: auto;">
                    <table class="user-table" style="width: 100%;">

                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Placed</th>
                                <th>Details</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($orders as $order)
                                <tr>

                                    <td>
                                        #{{ (int) $order['id'] }}
                                    </td>

                                    <td>
                                        {{ (string) $order['total_amount'] }} JD
                                    </td>

                                    <td>
                                        {{ (string) $order['status'] }}
                                    </td>

                                    <td>
                                        {{ (string) $order['created_at'] }}
                                    </td>

                                    <td>
                                        <a
                                            class="user-button-secondary"
                                            href="{{ url('/orders/details?id=' . (int) $order['id']) }}">
                                            View Order
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>

        @endif

    </div>
</section>


@endsection
