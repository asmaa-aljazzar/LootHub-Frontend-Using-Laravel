@php
$email = 'example@email.com'
@endphp

@extends('layout.app')

@section('title', 'Verify email pending - LootHub')


@section('content')

    <section class="user-page">
        <div class="user-container">
            <div class="user-form-card">
                <p class="user-eyebrow">One more step</p>
                <h1 class="user-page-title">Enter your email code</h1>
                <p class="user-page-subtitle">We sent a 6-digit verification code to your email. Open Gmail on any device,
                    then enter the code here. It expires in 10 minutes.</p>
                <form class="user-form" method="post" action=" {{ url('/verify-email/confirm') }}" data-user-async-form
                    data-user-auto-hide="false">

                    @csrf

                    <div class="user-field"><label for="verify-email">Email</label>
                        <input class="user-input" id="verify-email" name="email" type="email" autocomplete="email"
                            maxlength="255" required value="{{ $email }}">
                    </div>
                    <div class="user-field"><label for="verify-code">Verification code</label>
                        <input class="user-input" id="verify-code" name="code" type="text" inputmode="numeric"
                            pattern="[0-9]{6}" maxlength="6" minlength="6" autocomplete="one-time-code"
                            placeholder="123456" required autofocus>
                    </div>
                    <p class="user-form-message" data-user-form-message role="alert" aria-live="polite"></p>
                    <div class="user-form-actions"><button class="user-button" data-user-submit type="submit">Verify &amp;
                            continue</button></div>
                </form>
                <hr style="border:0;border-top:1px solid rgba(160,140,190,.2);margin:28px 0;">
                <p class="user-page-subtitle">Didn't get a code? You can request a new one (limited attempts).</p>
                <form class="user-form" method="post" action=" {{ url('/verify-email/resend') }}" data-user-async-form
                    data-user-auto-hide="false">

                    @csrf

                    <div class="user-field"><label for="resend-email">Email to resend to</label>
                        <input class="user-input" id="resend-email" name="email" type="email" autocomplete="email"
                            maxlength="255" required value="{{ $email }}">
                    </div>
                    <p class="user-form-message" data-user-form-message role="alert" aria-live="polite"></p>
                    <div class="user-form-actions"><button class="user-button-secondary" data-user-submit
                            type="submit">Resend code</button></div>
                </form>
                <div class="user-form-links"><a href=" {{ url('/login') }}">Back
                        to login</a></div>
            </div>
        </div>
    </section>
    @endsection