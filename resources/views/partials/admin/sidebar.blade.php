<aside class="admin-sidebar" id="admin-sidebar" aria-label="Admin navigation">
        <a class="admin-brand {{ request()->is('admin/panel') ? 'is-active' : '' }}" href="{{ url('/admin/panel') }}" aria-label="LOOT HUB Admin Overview">
            <span class="admin-brand-mark" aria-hidden="true">
                <img class="admin-logo-dark" src="{{ asset('images/branding/loot-hub-symbol.png') }}" alt="">
                <span class="admin-logo-light"><svg>
                        <use href="#i-gamepad" />
                    </svg></span>
            </span>
            <span>LOOT <b>HUB</b><small>ADMIN STUDIO</small></span>
        </a>

        <p class="admin-nav-label">WORKSPACE</p>
        <nav aria-label="Management sections">
            <a href="{{ url('/admin/panel') }}" class="{{ request()->is('admin/panel') ? 'is-active' : '' }}"><svg>
                    <use href="#i-grid" />
                </svg><span>Overview</span><span class="admin-nav-live">LIVE</span></a>
            <a href="{{ url('/admin/users') }}" class="{{ request()->is('admin/users', 'admin/users/*') ? 'is-active' : '' }}"><svg>
                    <use href="#i-users" />
                </svg><span>Users</span></a>
            <a href="{{ url('/admin/products') }}" class="{{ request()->is('admin/products', 'admin/products/*') ? 'is-active' : '' }}"><svg>
                    <use href="#i-box" />
                </svg><span>Products</span></a>
            <a href="{{ url('/admin/categories') }}" class="{{ request()->is('admin/categories', 'admin/categories/*') ? 'is-active' : '' }}"><svg>
                    <use href="#i-category" />
                </svg><span>Categories</span></a>
            <a href="{{ url('/admin/orders') }}" class="{{ request()->is('admin/orders', 'admin/orders/*') ? 'is-active' : '' }}"><svg>
                    <use href="#i-bag" />
                </svg><span>Orders</span><span id="admin-pending-count" class="admin-nav-counter" hidden></span></a>
            <p class="admin-nav-label">STORE TOOLS</p>
            <a href="{{ url('/admin/promos') }}" class="{{ request()->is('admin/promos', 'admin/promos/*') ? 'is-active' : '' }}"><svg>
                    <use href="#i-tag" />
                </svg><span>Promo codes</span></a>
            <a href="{{ url('/admin/reviews') }}" class="{{ request()->is('admin/reviews', 'admin/reviews/*') ? 'is-active' : '' }}"><svg>
                    <use href="#i-star" />
                </svg><span>Reviews</span></a>
        </nav>

        <a class="admin-workspace {{ request()->is('admin/settings', 'admin/settings/*') ? 'is-active' : '' }}" href="{{ url('/admin/settings') }}">
            <span class="admin-avatar admin-workspace-avatar" data-admin-avatar aria-hidden="true">LH</span>

            <span class="admin-workspace-identity">
                <strong data-admin-name>
                    {{ $adminName }}
                </strong>
                <small>Account settings</small>
            </span>

            <span class="admin-live-dot"></span>
        </a>
    </aside>
