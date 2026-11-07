<header class="admin-topbar">
            <div class="admin-breadcrumb">
                <button class="admin-icon-button admin-mobile-toggle" data-action="menu" aria-label="Open navigation"
                    aria-expanded="false"><svg>
                        <use href="#i-menu" />
                    </svg></button>
                <a href="{{ url('/admin/panel') }}" data-nav="overview" class="admin-workspace-crumb">Workspace</a>
                <svg>
                    <use href="#i-chevron" />
                </svg><strong id="admin-crumb">@yield('page-heading', 'Overview')</strong>
            </div>
            <div class="admin-top-actions">
                <button class="admin-global-search" data-action="search" aria-label="Search workspace"><svg>
                        <use href="#i-search" />
                    </svg><span>Search the store…</span><kbd>Ctrl K</kbd></button>
                <span class="admin-top-separator"></span>
                <a class="admin-button secondary small" href="{{ url('/admin/products?stock=attention') }}">Low stock</a>
                <details class="admin-account-menu" data-admin-account-menu>
                    <summary aria-label="Account and profile" title="Account and profile"
                        class="admin-profile-trigger">
                        <svg class="admin-profile-icon" width="26" height="26" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"
                            stroke-linejoin="round" aria-hidden="true">
                            <circle cx="12" cy="12" r="10" />
                            <circle cx="12" cy="8" r="3" />
                            <path d="M5 19c1-4 3-5 7-5s6 1 7 5" />
                        </svg>
                    </summary>
                    <div class="admin-account-dropdown">
                        <a href="{{ url('/admin/settings') }}" data-nav="settings"><svg>
                                <use href="#i-settings" />
                            </svg><span>Your Profile</span></a>
                        <div class="admin-pref-group"><span class="admin-pref-title">Language</span>
                            <div class="admin-lang-buttons" role="group" aria-label="Language">
                                <button type="button" data-admin-pref="lang" data-value="en"
                                    aria-pressed="{{ $adminLang === 'en' ? 'true' : 'false' }}">English</button>
                                <button type="button" data-admin-pref="lang" data-value="ar"
                                    aria-pressed="{{ $adminLang === 'ar' ? 'true' : 'false' }}">العربية</button>
                            </div>
                        </div>
                        <div class="admin-pref-group"><span class="admin-pref-title">Theme</span>
                            <div class="admin-theme-buttons" role="group" aria-label="Color theme">
                                <button type="button" class="admin-theme-dot admin-dot-red" data-admin-pref="theme"
                                    data-value="inferno-light" aria-label="Red and white light theme"
                                    title="Inferno Red · Light"
                                    aria-pressed="{{ $adminTheme === 'inferno-light' ? 'true' : 'false' }}"></button>
                                <button type="button" class="admin-theme-dot admin-dot-purple"
                                    data-admin-pref="theme" data-value="plum-dark"
                                    aria-label="Purple and black dark theme" title="Plum · Dark"
                                    aria-pressed="{{ $adminTheme === 'plum-dark' ? 'true' : 'false' }}"></button>
                            </div>
                        </div>
                        <form method="post" action="{{ url('/logout') }}" data-admin-logout>
                            @csrf
                            <button type="submit" class="admin-logout-button"><svg>
                                    <use href="#i-power" />
                                </svg><span>Log Out</span></button>
                        </form>
                    </div>
                </details>
            </div>
        </header>
