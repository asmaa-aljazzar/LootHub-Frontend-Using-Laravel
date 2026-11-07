@php
    $email = 'example@gmail.com';
@endphp

@endphp
@extends('layout.app')

@section('title', 'Verify your email - LootHub')


@section('content')

    <section class="user-page loothub-auth-page">
        <div class="loothub-auth-shell">
            <aside class="loothub-auth-hero"><span class="loothub-auth-logo">L✦</span>
                <p class="loothub-auth-kicker">ONE MORE STEP</p>
                <h2>Check your<br><em>inbox.</em></h2>
                <p>You're almost part of the LootHub community.</p>
            </aside>
            <div class="user-container">
                <div class="user-form-card loothub-auth-card">
                    <p class="user-eyebrow">Email verification</p>
                    <h1 class="user-page-title">Verify your email</h1>
                    <p class="user-page-subtitle">We sent a 6-digit code to <strong>{{ $email }}</strong>. The code
                        expires in 10 minutes.</p>
                    <form method="post" action="{{ url('/verify-email/pending') }}" class="user-form"
                        data-user-async-form>
                        @csrf
                        <div class="user-field"><label for="verify-code">6-digit code</label><input
                                class="user-input loothub-otp-input" id="verify-code" name="code" type="text"
                                inputmode="numeric" autocomplete="one-time-code" maxlength="6" pattern="[0-9]{6}"
                                placeholder="000000" required></div>
                        <p data-user-form-message class="user-form-message" role="status" aria-live="polite"></p>
                        <button class="user-button" type="submit" data-user-submit>Verify & create account</button>
                    </form>
                    <form method="post" action="{{ url('/verify-email/resend') }}" class="user-form" data-user-async-form>
                        @csrf
                        <p data-user-form-message class="user-form-message" role="status" aria-live="polite"></p>
                        <button class="user-button-secondary" type="submit" data-user-submit>Resend code</button>
                    </form>
                    <p class="user-form-links"><a href="{{ url('/register') }}">Use another email</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection
