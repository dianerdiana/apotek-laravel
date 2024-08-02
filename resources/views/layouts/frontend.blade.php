<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') | Parma</title>
  <link rel="shortcut icon" href="{{ asset('assets/svgs/logo-mark.svg') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  @yield('content')

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

  <script src="{{ asset('scripts/sliderConfig.js') }}" type="module"></script>
  <script src="{{ asset('scripts/searchProductListener.js') }}" type="module"></script>
  <script src="{{ asset('scripts/global.js') }}"></script>
</body>

</html>
