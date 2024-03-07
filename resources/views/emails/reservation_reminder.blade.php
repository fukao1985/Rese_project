<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>本日{{ $today }}に{{ $reservation->name }}での予約があります。</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1 class="text-base font-bold">本日{{ $reservation->name }}での予約があります。</h1>
    <p>日にち:{{ $reservation->date }}</p>
    <p>時間:{{ $reservation->time }}</p>
    <p>人数:{{ $reservation->number }}</p>
    <h2 class="text-base font-bold text-blue-600">Rese</h2>
</body>
</html>