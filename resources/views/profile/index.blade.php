@extends('layout.app')

@section('title', 'Your profile — LootHub')

@section('content')
@php
    $user = $user ?? ['name' => 'Asmaa', 'email' => 'asmaa@example.com', 'phone' => '+962 790 000 000', 'role' => 'customer'];
    $designs = $designs ?? [['id' => 1, 'created_at' => '2026-11-07', 'image' => asset('images/products/batmanLogoHoodie.png')]];
    $userLanguage = $userLanguage ?? 'en';
@endphp

<section class="user-page">
    <div class="user-container">

        <p class="user-eyebrow">Your account</p>

        <h1 class="user-page-title">Profile</h1>

        <p class="user-page-subtitle">
            Manage your account information and saved AI designs.
        </p>

        <div class="user-profile-grid">

            <!-- ACCOUNT INFORMATION -->
            <section
                class="user-info-card"
                aria-labelledby="user-profile-info-heading">

                <h2 id="user-profile-info-heading">
                    Account Information
                </h2>

                <dl class="user-profile-facts">

                    <div>
                        <dt>Name</dt>
                        <dd dir="auto">
                            {{ 
                                (string) ($user['name'] ?? '') }}
                        </dd>
                    </div>

                    <div>
                        <dt>Email</dt>
                        <dd>
                            {{ 
                                (string) ($user['email'] ?? '') }}
                        </dd>
                    </div>

                    <div>
                        <dt>Phone</dt>
                        <dd>
                            {{ 
                                (string) ($user['phone'] ?? '') ?: 'Not provided' }}
                        </dd>
                    </div>

                    <div>
                        <dt>Account Type</dt>
                        <dd>
                            {{ 
                                (string) ($user['role'] ?? '') }}
                        </dd>
                    </div>

                </dl>

                <hr class="user-divider">

                <!-- UPDATE PROFILE -->
                <form
                    class="user-form"
                    action="{{ url('/profile') }}"
                    method="post"
                    data-user-async-form
                    data-user-method="PUT"
                    data-user-json="true"
                    data-user-auto-hide="true">

                    <h3>Update Profile</h3>

                    @csrf
                    @method('PUT')

                    <div class="user-field">
                        <label for="profile-name">Name</label>

                        <input
                            class="user-input"
                            id="profile-name"
                            type="text"
                            name="name"
                            maxlength="100"
                            value="{{ (string) ($user['name'] ?? '') }}"
                            required>
                    </div>

                    <div class="user-field">
                        <label for="profile-phone">Phone</label>

                        <input
                            class="user-input"
                            id="profile-phone"
                            type="tel"
                            name="phone"
                            maxlength="25"
                            value="{{ (string) ($user['phone'] ?? '') }}">
                    </div>

                    <p
                        class="user-form-message"
                        data-user-form-message
                        role="status"
                        aria-live="polite"></p>

                    <div class="user-form-actions">
                        <button
                            class="user-button"
                            type="submit"
                            data-user-submit>
                            Save Changes
                        </button>
                    </div>

                </form>

            </section>

            <!-- SESSION / ACCOUNT SETTINGS -->
            <aside class="user-data-card">

                <h2>Session</h2>

                <p class="user-page-subtitle">
                    Sign out from this device when you are finished.
                </p>

                <!-- LOGOUT -->
                <form
                    class="user-form"
                    id="logout-form"
                    action="{{ url('/logout') }}"
                    method="post"
                    data-user-async-form>

                    @csrf

                    <p
                        class="user-form-message"
                        id="logout-message"
                        data-user-form-message
                        role="status"
                        aria-live="polite"></p>

                    <button
                        class="user-button-secondary"
                        type="submit"
                        data-user-submit>
                        Log Out
                    </button>

                </form>

                <hr class="user-divider">

                <!-- DELETE ACCOUNT -->
                <details>

                    <summary class="user-nav-link">
                        Delete Account
                    </summary>

                    <p class="user-status-note">
                        This action is permanent. Google accounts require
                        identity confirmation that is not available in this form.
                    </p>

                    <form
                        class="user-form"
                        action="{{ url('/profile') }}"
                        method="post"
                        data-user-async-form
                        data-user-method="DELETE"
                        data-user-json="true"
                        data-user-confirm="Delete your LootLab account? This cannot be undone.">

                        @csrf
                        @method('DELETE')

                        <div class="user-field">
                            <label for="delete-password">
                                Password
                            </label>

                            <input
                                class="user-input"
                                id="delete-password"
                                type="password"
                                name="password"
                                autocomplete="current-password"
                                required>
                        </div>

                        <p
                            class="user-form-message"
                            data-user-form-message
                            role="status"
                            aria-live="polite"></p>

                        <button
                            class="user-button-quiet"
                            type="submit"
                            data-user-submit>
                            Delete Account
                        </button>

                    </form>

                </details>

            </aside>

        </div>

        <!-- AI CUSTOM DESIGNS -->
        <section class="user-designs">

            <p class="user-eyebrow">AI Creations</p>

            <h2 class="user-page-title">
                	My Designs
            </h2>

            <p class="user-page-subtitle">
                Your saved AI-generated designs.
            </p>

            @if (empty($designs))

                <div class="user-empty-state">

                    <span
                        class="user-empty-icon"
                        aria-hidden="true">
                        ✦
                    </span>

                    <h3>No saved designs yet</h3>

                    <p>
                        Create your first AI design and find it here.
                    </p>

                </div>

            @else

                <div
                    class="user-products-grid"
                    style="margin-top: 24px;">

                    @foreach ($designs as $design)

                        @php
$designId = (int) ($design['id'] ?? 0);

                        $imageUrl = ($design['image'] ?? url('/profile/design-image?id=' . $designId));

                        $designLink = url('/aiImage.php?design_id=' . $designId);
                        @endphp

                        <article class="user-product-card user-design-card">

                            <div class="user-product-media">

                                <a
                                    class="user-product-image-link"
                                    href="{{ $imageUrl }}"
                                    target="_blank"
                                    rel="noopener">

                                    <img
                                        class="user-product-image"
                                        src="{{ $imageUrl }}"
                                        alt="AI Design #{{ $designId }}"
                                        loading="lazy">

                                </a>

                            </div>

                            <div class="user-product-content">

                                <h3 class="user-product-title">
                                   {{ $userLanguage === 'ar' ? 'تصميم' : 'Design' }} #{{ $designId }}
                                </h3>

                                <p class="user-product-category">
                                    {{ 
                                        (string) ($design['created_at'] ?? '') }}
                                </p>

                                <div class="user-product-actions">

                                    <a
                                        class="user-button-secondary"
                                        href="{{ $imageUrl }}"
                                        target="_blank"
                                        rel="noopener">
                                        View Design
                                    </a>

                                    <a
                                        class="user-button"
                                        href="{{ $designLink }}">
                                       	Customize a Product
                                    </a>

                                </div>

                            </div>

                        </article>

                    @endforeach

                </div>

            @endif

        </section>

    </div>
</section>


@endsection
