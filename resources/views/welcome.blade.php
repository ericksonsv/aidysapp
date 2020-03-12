<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#141925">
    <title>{{ config('app.name') }} - {{ config('app.desc') }}</title>
    <link rel="icon" href="{{ asset('img/aidysapp-icon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Nunito', sans-serif; }
        .logo { font-family: 'Righteous', cursive; }
    </style>
</head>
<body class="h-full bg-gray-100 leading-none">

    <div class="flex flex-col justify-center items-center p-8">
        <img src="{{ asset('img/hero-welcome.svg') }}" alt="{{ __('Hero Image') }}" class="mx-auto">
        <div class="flex justify-center items-center my-10">
            <img src="{{ asset('img/aidysapp-logo.svg') }}" alt="{{ __('Logo') }}" class="h-20">
        </div>
        <div class="mx-auto text-center">
            <div id="lottie" class="h-56"></div>
            <h1 class="text-gray-700 text-2xl font-extrabold tracking-widest">{{ __('UNDER CONSTRUCTION') }}</h1>
        </div>
    </div>

    <script src="{{ asset('vendor/lottie/lottie.min.js') }}"></script>
    <script>
        var animation = bodymovin.loadAnimation({
          container: document.getElementById('lottie'), // Required
          path: 'lotties/under-construction.json', // Required
          renderer: 'svg', // Required
          loop: true, // Optional
          autoplay: true, // Optional
          name: "Hello World", // Name for future reference. Optional.
      });
  </script>
</body>
</html>
