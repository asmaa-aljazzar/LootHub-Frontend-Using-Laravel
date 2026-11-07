@php $adminName = 'Asmaa' @endphp

@extends('layout.admin')

@section('title', 'Overview — LootHub Admin')

@section('content')
    <div class="admin-preview-banner">Frontend preview · Sample values, not live store data.</div>

    <div class="admin-page-header">
        <div>
            <p class="admin-nav-label">WORKSPACE OVERVIEW</p>
            <h1>Welcome back, Administrator</h1>
            <p>Your store at a glance.</p>
        </div>
    </div>

    @php
        $metrics = [
            ['icon' => 'wallet', 'label' => 'Completed order value', 'value' => '25.00', 'unit' => 'JOD', 'note' => 'Completed orders'],
            ['icon' => 'users', 'label' => 'Customers', 'value' => '1', 'unit' => '', 'note' => 'Registered customer accounts'],
            ['icon' => 'box', 'label' => 'Active products', 'value' => '1', 'unit' => '', 'note' => 'Products in your collection'],
            ['icon' => 'bag', 'label' => 'Total orders', 'value' => '1', 'unit' => '', 'note' => 'Orders placed in your store'],
        ];
    @endphp

    <div class="admin-metrics">
        @foreach ($metrics as $metric)
            <article class="admin-metric">
                <div class="admin-metric-label">
                    <svg aria-hidden="true"><use href="#i-{{ $metric['icon'] }}" /></svg>
                    {{ $metric['label'] }}
                </div>
                <div class="admin-metric-value">
                    <span>{{ $metric['value'] }}</span>
                    @if ($metric['unit'] !== '')
                        <small>{{ $metric['unit'] }}</small>
                    @endif
                </div>
                <div class="admin-metric-note"><i></i>{{ $metric['note'] }}</div>
            </article>
        @endforeach
    </div>

    <div class="admin-dashboard-grid">
        <section class="admin-panel" aria-labelledby="sales-heading">
            <div class="admin-panel-header">
                <div><h2 id="sales-heading">Sales performance</h2><p>Completed order value over time</p></div>
            </div>
            <div class="admin-empty">
                <svg aria-hidden="true"><use href="#i-chart" /></svg>
                <h3>Your sales story starts here</h3>
                <p>The sales chart will appear when order data is connected.</p>
            </div>
        </section>
        <section class="admin-panel" aria-labelledby="activity-heading">
            <div class="admin-panel-header"><h2 id="activity-heading">Order activity</h2></div>
            <div class="admin-empty">
                <svg aria-hidden="true"><use href="#i-bag" /></svg>
                <h3>No orders to display</h3>
                <p>Order activity will appear here when connected.</p>
            </div>
        </section>
    </div>

    <div class="admin-two-panels">
        <section class="admin-panel" aria-labelledby="orders-heading">
            <div class="admin-panel-header"><h2 id="orders-heading">Recent orders</h2></div>
            <div class="admin-empty">
                <svg aria-hidden="true"><use href="#i-bag" /></svg>
                <h3>Order #1 · Asmaa</h3>
                <p>Processing · 25.00 JD · 7 November 2026</p>
            </div>
        </section>
        <section class="admin-panel" aria-labelledby="products-heading">
            <div class="admin-panel-header"><h2 id="products-heading">Best-selling products</h2></div>
            <div class="admin-empty">
                <svg aria-hidden="true"><use href="#i-star" /></svg>
                <h3>Batman Logo Hoodie</h3>
                <p>1 unit sold · 25.00 JD</p>
            </div>
        </section>
    </div>
@endsection
