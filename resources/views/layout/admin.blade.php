@php
    $adminName = $adminName ?? 'Administrator';
    $adminLang = 'en';
    $adminTheme = 'plum-dark';
    $bootstrap = [
        'appUrl' => url('/'),
        'csrf' => csrf_token(),
        'preview' => true,
        'user' => ['name' => 'Preview Administrator', 'email' => ''],
        'avatar' => '',
    ];
@endphp
<!DOCTYPE html>
<html lang="{{ $adminLang }}" dir="{{ $adminLang === 'ar' ? 'rtl' : 'ltr' }}" data-loot-theme="{{ $adminTheme }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="theme-color" content="{{ $adminTheme === 'plum-dark' ? '#08070B' : '#FFFFFF' }}">
    <title>@yield('title', 'LootHub — Admin Studio')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app-admin.css', 'resources/js/admin-app.js'])
</head>

<body class="admin-body">
    <a class="admin-skip" href="#admin-main">Skip to content</a>
    @include('partials.admin.icons')
    @include('partials.admin.sidebar')
    <button class="admin-mobile-scrim" id="admin-mobile-scrim" aria-label="Close navigation" hidden></button>
    <div class="admin-shell">
    @include('partials.admin.topbar')
        <main class="admin-main" id="admin-main" tabindex="-1">
            @yield('content')
        </main>
    @include('partials.admin.footer')
    </div>
    <dialog class="admin-drawer" id="admin-drawer" aria-label="Record details"></dialog>
    <dialog class="admin-modal" id="admin-modal" aria-label="Admin action"></dialog>
    <div class="admin-toasts" id="admin-toasts" aria-live="polite" aria-atomic="false"></div>
    @stack('scripts')
</body>

</html>
