@extends('layout.app')

@section('title', 'Verify phone — LootHub')

@section('content')
@php
    $maskedPhone = $maskedPhone ?? '+962 79 *** 0000';
    $error = $error ?? null;
    $notice = $notice ?? null;
@endphp

<section class="user-page">
  <div class="user-container">
    <div class="user-form-card checkout-otp-card">
      <p class="user-eyebrow">Secure checkout</p>
      <h1 class="user-page-title">Verify your phone</h1>
      <p class="checkout-otp-subtitle">We sent a 6-digit SMS code to <strong>{{ (string) $maskedPhone }}</strong>. Enter it below before proceeding to payment or placing your order.</p>
      @if (!empty($error))
        <p class="user-form-message" role="alert" style="color:#ff9b9b">{{ (string) $error }}</p>
      @endif
      @if (!empty($notice))
        <p class="user-form-message" role="status">{{ (string) $notice }}</p>
      @endif
      <form class="user-form" method="POST" action="{{ url('/checkout/verify') }}">
        @csrf
        <div class="user-field">
          <label for="otp">Verification code</label>
          <input class="user-input" type="text" name="otp" id="otp" inputmode="numeric" pattern="[0-9]{6}" minlength="6" maxlength="6" autocomplete="one-time-code" placeholder="000000" required autofocus>
        </div>
        <button class="user-button" type="submit">Verify &amp; continue</button>
      </form>
      <p class="checkout-otp-help">The code expires in 5 minutes. Maximum 5 attempts. You can request a new SMS after 60 seconds (up to 3 SMS per 15 minutes).</p>
      <form method="POST" action="{{ url('/checkout/verify/resend') }}">
        @csrf
        <button class="user-button-secondary" type="submit">Resend SMS code</button>
      </form>
      <p><a href="{{ url('/checkout') }}">← Edit shipping address or phone number</a></p>
    </div>
  </div>
</section>

@endsection
