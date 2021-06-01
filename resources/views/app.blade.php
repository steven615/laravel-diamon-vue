<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Diamond PrimeVue</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    @routes
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
    @inertia
    <div class="loader-container">
        <div class="loader">
            <div class="bottom-section">
                <div class="bottom"></div>
                <div class="bottom"></div>
                <div class="bottom"></div>
                <div class="bottom"></div>
            </div>
            <div class="top-section">
                <div class="bottom"></div>
                <div class="bottom"></div>
                <div class="bottom"></div>
                <div class="bottom"></div>
            </div>
            <div class="middle"></div>
        </div>
    </div>

    <script>
        let timeInterval = setInterval(() => {
            if (document.readyState === 'complete') {
                document.querySelector('.loader-container').style.display = 'none';
                clearInterval(timeInterval);
            }
        }, 100);
    </script>
</body>

</html>