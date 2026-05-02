<!doctype html>
<html lang="id" data-theme="light">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Ghina Tour Travel — Serving With Love')</title>
<meta name="description" content="@yield('description', 'PT Ghina Tour Travel — solusi perjalanan wisata rombongan dengan harga sesuai anggaran Anda. Terpercaya, Fleksibel & Fun.')" />

@vite(['resources/css/app.css', 'resources/css/customer.css', 'resources/js/app.js'])
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

@yield('extra_styles')
</head>
<body>

@include('components.layout.navbar')

@yield('content')

@include('components.layout.footer')

<a href="https://wa.me/6281234567890" target="_blank" class="wa-float">
  <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" class="h-14 w-14 rounded-full shadow-lg hover:scale-110 transition-transform" />
</a>

@include('components.layout.scripts')
@yield('extra_scripts')
</body>
</html>