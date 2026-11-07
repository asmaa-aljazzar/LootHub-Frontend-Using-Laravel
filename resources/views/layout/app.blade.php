<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield ('title', 'LootHub')</title>
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    @vite (['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="user-body">
    {{-- Take the header full code from there --}}
    @include ('partials.navbar')

    <main class="user-main" id='user-main'>
        @yield ('content')
    </main>

    @include ('partials.footer')
    @stack('scripts')
</body>

</html>
