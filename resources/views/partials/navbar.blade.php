@php
    $userIsSignedIn = false;
    $userIsAdmin = true;
    $userLanguage = 'en';
    $userTheme = 'plum-dark';

    // Take first (true) as match.
    $userActiveNav = match (true) {
        request()->is('/') => 'home',
        request()->is('products', 'products/*') => 'products',
        request()->is('favorites', 'favorites/*') => 'favorites',
        request()->is('orders', 'orders/*') => 'orders',
        request()->is('cart', 'cart/*', 'checkout', 'checkout/*') => 'cart',
        default => '',
    };

@endphp

<header class="user-navbar" data-user-navbar>

    <div class="user-navbar-inner">

        <!-- Brand -->
        <a class="user-brand" href="{{ url('/') }}" aria-label="Loot Hub homepage">
            <span class="loot-brand-icon">
                <img class="loot-logo-dark" src="{{ url('/images/branding/loot-hub-symbol.png') }}" alt="">

                <span class="loot-logo-light">
                    <i class="fa-solid fa-gamepad"></i>
                </span>
            </span>

            <span>
                LOOT <strong>HUB</strong>
            </span>
        </a>

        @if (!$userIsSignedIn)

            <!-- Guest Navigation -->
            <nav class="loothub-guest-nav" aria-label="Guest navigation">
                <a class="user-nav-link{{ $userActiveNav === 'home' ? ' user-nav-active' : '' }}"
                    href="{{ url('/') }}">
                    <i class="fa-solid fa-house" aria-hidden="true"></i>
                    <span data-i18n="Home">Home</span>
                </a>
                <a class="user-nav-link{{ $userActiveNav === 'favorites' ? ' user-nav-active' : '' }}"
                    href="{{ url('/favorites') }}">
                    <i class="fa-solid fa-heart" aria-hidden="true"></i>
                    <span data-i18n="Favorites">Favorites</span>
                    <span class="user-nav-count" data-user-favorite-count hidden>0</span>
                </a>
                <a class="user-nav-link user-nav-cart{{ $userActiveNav === 'cart' ? ' user-nav-active' : '' }}"
                    href="{{ url('/cart') }}">
                    <i class="fa-solid fa-cart-shopping" aria-hidden="true"></i>
                    <span data-i18n="Cart">Cart</span><span class="user-nav-count" data-user-cart-count hidden
                        aria-label="Cart quantity">0</span>
                </a>
            </nav>

            <div class="user-guest-auth" aria-label="Account">
                <a class="user-button-secondary" href="{{ url('/login') }}">
                    <span data-i18n="Login">Login</span>
                </a>
                <a class="user-button" href="{{ url('/register') }}">
                    <span data-i18n="Register">Register</span>
                </a>
            </div>
        @else
            <!-- Mobile Menu Toggle -->
            <button class="user-menu-toggle" type="button" aria-expanded="false" aria-controls="user-primary-nav"
                data-user-menu-toggle>
                <span class="user-visually-hidden">
                    Toggle navigation
                </span>

                <span></span>
                <span></span>
                <span></span>
            </button>

            <!-- Authenticated Navigation -->
            <nav class="user-primary-nav" id="user-primary-nav" aria-label="Main navigation" data-user-nav>

                <div class="user-nav-main">

                    <!-- Home -->
                    <a class="user-nav-link{{ $userActiveNav === 'home' ? ' user-nav-active' : '' }}"
                        href="{{ url('/') }}" @if ($userActiveNav === 'home') aria-current="page" @endif>
                        <i class="fa-solid fa-house" aria-hidden="true"></i>
                        <span data-i18n="Home">Home</span>
                    </a>

                    <!-- Products -->
                    <a class="user-nav-link{{ $userActiveNav === 'products' ? ' user-nav-active' : '' }}"
                        href="{{ url('/products') }}"
                        @if ($userActiveNav === 'products') aria-current="page" @endif>
                        <i class="fa-solid fa-bag-shopping" aria-hidden="true"></i>
                        <span data-i18n="Products">Products</span>
                    </a>

                    <!-- Favorites -->
                    <a class="user-nav-link{{ $userActiveNav === 'favorites' ? ' user-nav-active' : '' }}"
                        href="{{ url('/favorites') }}">
                        <i class="fa-solid fa-heart" aria-hidden="true"></i>
                        <span data-i18n="Favorites">Favorites</span>

                        <span class="user-nav-count" data-user-favorite-count hidden>
                            0
                        </span>
                    </a>

                    <!-- Cart -->
                    <a class="user-nav-link user-nav-cart{{ $userActiveNav === 'cart' ? ' user-nav-active' : '' }}"
                        href="{{ url('/cart') }}">
                        <i class="fa-solid fa-cart-shopping" aria-hidden="true"></i>
                        <span data-i18n="Cart">Cart</span><span class="user-nav-count" data-user-cart-count hidden
                            aria-label="Cart quantity">0</span>
                    </a>

                    <!-- My Orders -->
                    <a class="user-nav-link{{ $userActiveNav === 'orders' ? ' user-nav-active' : '' }}"
                        href="{{ url('/orders') }}" @if ($userActiveNav === 'orders') aria-current="page" @endif>
                        <i class="fa-solid fa-box" aria-hidden="true"></i>
                        <span data-i18n="My Orders">My Orders</span>
                    </a>

                </div>

                <!-- Right Navigation Tools -->
                <div class="user-nav-tools">

                    <!-- Admin Dashboard -->
                    @if ($userIsAdmin)
                        <a class="user-nav-link user-admin-shortcut" href="{{ url('/admin/panel') }}">
                            <i class="fa-solid fa-gauge-high" aria-hidden="true"></i>
                            <span data-i18n="Go to Dashboard">Go to Dashboard</span>
                        </a>
                    @endif

                    <!-- AI Image Studio -->
                    <a class="user-image-ai-link" href="{{ url('/ai/image') }}" aria-label="AI Image Studio"
                        title="AI Image Studio">
                        <svg class="user-ai-image-icon" viewBox="0 0 36 36" width="34" height="34" fill="none"
                            aria-hidden="true">
                            <rect x="2.5" y="5.5" width="26" height="24" rx="5" stroke="currentColor"
                                stroke-width="2" />

                            <circle cx="11" cy="13" r="2.5" fill="currentColor" />

                            <path d="m5 25 8-8 5 5 4-4 4 5" stroke="currentColor" stroke-width="2"
                                stroke-linejoin="round" />

                            <path d="m29 1 1.4 5.3L35 8l-4.6 1.5L29 15l-1.4-5.5L23 8l4.6-1.7z" fill="#e5c6ff" />
                        </svg>

                        <span class="user-ai-image-label">
                            AI Image
                        </span>
                    </a>

                    <!-- Account Dropdown -->
                    <details class="user-account-menu" data-user-account-menu>

                        <summary class="user-nav-link" aria-label="Account and profile" title="Account">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.7" stroke-linecap="round"
                                stroke-linejoin="round" aria-hidden="true">
                                <circle cx="12" cy="12" r="10" />
                                <circle cx="12" cy="8" r="3" />
                                <path d="M5 19c1-4 3-5 7-5s6 1 7 5" />
                            </svg>
                        </summary>

                        <div class="user-account-dropdown">

                            <a href="{{ url('/profile') }}">
                                Your Profile
                            </a>

                            <a href="{{ url('/orders') }}">
                                Your Orders
                            </a>

                            <div class="loot-preference-block">
                                <span class="loot-setting-label" data-i18n="Language">Language</span>
                                <div class="loot-lang-options" role="group" aria-label="Language">
                                    <button type="button" data-loot-pref="lang" data-loot-value="en"
                                        aria-pressed="{{ $userLanguage === 'en' ? 'true' : 'false' }}">English</button>
                                    <button type="button" data-loot-pref="lang" data-loot-value="ar"
                                        aria-pressed="{{ $userLanguage === 'ar' ? 'true' : 'false' }}">العربية</button>
                                </div>
                            </div>
                            <div class="loot-preference-block loot-theme-options" role="group"
                                aria-label="Color theme">
                                <span class="loot-setting-label" data-i18n="Theme">Theme</span>
                                <div class="loot-theme-choices">
                                    <button type="button" class="loot-theme-dot loot-dot-inferno"
                                        data-loot-pref="theme" data-loot-value="inferno-light"
                                        aria-label="Red and white light theme" title="Inferno Red · Light"
                                        aria-pressed="{{ $userTheme === 'inferno-light' ? 'true' : 'false' }}"></button>
                                    <button type="button" class="loot-theme-dot loot-dot-plum"
                                        data-loot-pref="theme" data-loot-value="plum-dark"
                                        aria-label="Purple and black dark theme" title="Plum · Dark"
                                        aria-pressed="{{ $userTheme === 'plum-dark' ? 'true' : 'false' }}"></button>
                                </div>
                            </div>
                            <div class="loot-dropdown-divider" aria-hidden="true"></div>

                            <!-- Logout -->
                            <form method="post" action="{{ url('/logout') }}" data-user-logout>
                                @csrf
                                <button class="user-logout-action" type="submit">
                                    Log Out
                                </button>
                            </form>

                        </div>

                    </details>

                </div>

            </nav>

        @endif

    </div>

</header>
