@extends('layout.app')

@section('title', 'Login - LootHub')


@section('content')

    <section class="user-page loothub-auth-page">
        <div class="loothub-auth-shell">
            <aside class="loothub-auth-hero">
                <span class="loothub-auth-logo">L✦</span>
                <p class="loothub-auth-kicker">SECURE YOUR ACCOUNT</p>
                <h2>Make a<br><em>fresh start.</em></h2>
                <p>Choose a strong password to protect your LootLab account.</p>
            </aside>
            <div class="user-container">
                <section class="user-form-card loothub-auth-card">
                    <p class="user-eyebrow">ACCOUNT RECOVERY</p>
                    <h1 class="user-page-title">Choose a new password</h1>
                    <p class="user-page-subtitle">Use 8–72 bytes, including uppercase, lowercase, and a number.</p>
                    <form class="user-form" method="post">

                        @csrf

                        <input type="hidden" name="token" value="{{ $token ?? '' }}">
                        <div class="user-field"><label for="password">New password</label>
                            <input class="user-input" id="password" type="password" name="password"
                                autocomplete="new-password" minlength="8" required>
                        </div>
                        <div class="user-field"><label for="password_confirmation">Confirm password</label>
                            <input class="user-input" id="password_confirmation" type="password"
                                name="password_confirmation" autocomplete="new-password" minlength="8" required>
                        </div>
                        <div class="user-form-actions"><button class="user-button" type="submit">Reset password</button>
                        </div>
                    </form>
                    <p class="user-form-links">Remember your password?
                        <a href="{{ url('/login') }}">Back to login</a>
                    </p>
                </section>
            </div>
        </div>
    </section>

@endsection
