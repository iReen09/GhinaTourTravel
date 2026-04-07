<!doctype html>
<html lang="id" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Ghina Tour Travel — Serving With Love')</title>
  <meta name="description" content="@yield('description', 'PT Ghina Tour Travel — solusi perjalanan wisata rombongan dengan harga sesuai anggaran Anda. Terpercaya, Fleksibel & Fun.')" />
  
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('frontend/output.css') }}" />
  
  <style>
    *, body { font-family: 'Poppins', sans-serif; }
    html { scroll-behavior: smooth; }
    :root { --gold:#D4A017; --gold-dark:#b8860b; --gold-light:#f0c94d; }

    [data-theme="light"] {
      --bg:#F8F5EE; --bg-card:#FFFFFF; --bg-nav:#FFFFFF;
      --bg-section:#F0EBE0; --bg-footer:#1a1510;
      --text:#1a1a1a; --text-muted:#6b6b6b; --border:#E0D8C8;
      --hero-overlay:rgba(0,0,0,0.42);
    }
    [data-theme="dark"] {
      --bg:#0d0d0d; --bg-card:#141414; --bg-nav:#141414;
      --bg-section:#141414; --bg-footer:#0a0a0a;
      --text:#ffffff; --text-muted:#A8A8AB; --border:#353535;
      --hero-overlay:rgba(0,0,0,0.58);
    }

    body          { background:var(--bg); color:var(--text); transition:background .3s,color .3s; }
    .nav-bg       { background:var(--bg-nav); box-shadow:0 2px 20px rgba(0,0,0,.08); }
    .card-bg      { background:var(--bg-card); }
    .sec-bg       { background:var(--bg-section); }
    .t            { color:var(--text); }
    .tm           { color:var(--text-muted); }
    .b            { border-color:var(--border); }

    .btn          { display:inline-flex;align-items:center;gap:6px;padding:10px 22px;border-radius:999px;font-weight:600;font-size:14px;transition:all .2s;cursor:pointer; }
    .btn-gold     { background:var(--gold);color:#000; }
    .btn-gold:hover{ background:var(--gold-dark); }
    .btn-out      { border:2px solid var(--gold);color:var(--gold);background:transparent; }
    .btn-out:hover{ background:var(--gold);color:#000; }

    .paket-card { transition:transform .3s,box-shadow .3s;cursor:pointer;display:block; }
    .paket-card:hover { transform:translateY(-6px);box-shadow:0 20px 40px rgba(212,160,23,.2); }

    .card-ol { background:linear-gradient(to bottom,rgba(0,0,0,.05) 10%,rgba(5,2,17,.94) 88%); }

    .galeri-item { border-radius:14px;overflow:hidden;transition:transform .3s; }
    .galeri-item:hover { transform:translateY(-4px); }

    .fade-in { opacity:0;transform:translateY(26px);transition:opacity .7s,transform .7s; }
    .fade-in.visible { opacity:1;transform:none; }

    .wa-float { position:fixed;bottom:26px;right:26px;z-index:999; }

    /* Toggle */
    .tgl { position:relative;width:54px;height:28px;cursor:pointer;flex-shrink:0; }
    .tgl input { opacity:0;width:0;height:0; }
    .tgl .sl {
      position:absolute;inset:0;border-radius:999px;transition:.3s;
      background:linear-gradient(135deg,#1a1a2e,#16213e);
      display:flex;align-items:center;justify-content:space-between;padding:0 6px;
    }
    [data-theme="light"] .tgl .sl { background:linear-gradient(135deg,var(--gold),var(--gold-light)); }
    .tgl .sl::after {
      content:'';position:absolute;width:22px;height:22px;border-radius:50%;
      background:#fff;top:3px;left:3px;transition:transform .3s;box-shadow:0 2px 6px rgba(0,0,0,.3);
    }
    [data-theme="dark"] .tgl .sl::after { transform:translateX(26px); }

    footer { background:var(--bg-footer) !important; }

    [data-theme="light"] .stats-bar { background:#fff;box-shadow:0 4px 30px rgba(0,0,0,.1); }
    [data-theme="dark"]  .stats-bar { background:#141414; }

    [data-theme="light"] .visi-card { background:#fff;border:1px solid var(--border); }
    [data-theme="dark"]  .visi-card { background:#1a1a1a; }

    [data-theme="light"] .svc-card  { background:#fff;border:1px solid var(--border); }
    [data-theme="dark"]  .svc-card  { background:#141414; }

    @yield('extra_styles')
  </style>
</head>
<body>

<!-- ===== NAVBAR ===== -->
<nav id="navbar" class="fixed inset-x-0 top-5 z-50 mx-auto w-full max-w-[1280px] px-14">
  <div class="nav-bg mx-auto flex h-[78px] items-center justify-between rounded-2xl px-7 transition-all duration-300">
    <a href="{{ route('home') }}" class="flex items-center gap-3">
      <img src="{{ asset('frontend/assets/images/logos/logo.png') }}" alt="Logo" class="h-[50px] w-auto object-contain"
           onerror="this.onerror=null;this.src='';this.style.display='none';document.getElementById('lf').style.display='flex';" />
      <div id="lf" class="hidden h-10 w-10 items-center justify-center rounded-full font-black text-black text-lg" style="background:var(--gold);">G</div>
      <div>
        <div class="text-[16px] font-bold t leading-tight">Ghina Tour Travel</div>
        <div class="text-[10px] font-medium" style="color:var(--gold);">Serving With Love</div>
      </div>
    </a>

    <ul class="flex items-center gap-7 font-semibold text-[14px]">
      <li><a href="{{ route('home') }}" class="t hover:text-yellow-500 transition-colors">Beranda</a></li>
      <li><a href="{{ route('home') }}#tentang" class="t hover:text-yellow-500 transition-colors">Tentang Kami</a></li>
      <li><a href="{{ route('packages') }}" class="t hover:text-yellow-500 transition-colors">Paket</a></li>
      <li><a href="{{ route('photos') }}" class="t hover:text-yellow-500 transition-colors">Galeri</a></li>
    </ul>

    <label class="tgl" title="Ganti tema">
      <input type="checkbox" id="themeToggle" />
      <span class="sl">
        <span style="font-size:11px;z-index:1;">☀️</span>
        <span style="font-size:11px;z-index:1;">🌙</span>
      </span>
    </label>
  </div>
</nav>

<!-- ===== MAIN CONTENT ===== -->
@yield('content')

<!-- ===== FOOTER ===== -->
<footer class="mt-20 w-full px-14 py-16 text-white">
  <div class="mx-auto grid max-w-[1280px] grid-cols-4 gap-10">
    <div>
      <div class="mb-4 flex items-center gap-3">
        <img src="{{ asset('frontend/assets/images/logos/logo.png') }}" alt="Logo" class="h-[40px] w-auto" />
        <div>
          <div class="font-bold">Ghina Tour Travel</div>
          <div class="text-[10px]" style="color:var(--gold);">Serving With Love</div>
        </div>
      </div>
      <p class="text-sm leading-6 text-gray-400">
        Biro perjalanan wisata terpercaya sejak 2010. Melayani perjalanan rombongan dengan harga sesuai anggaran Anda.
      </p>
    </div>

    <div>
      <h4 class="mb-4 font-bold">Tautan</h4>
      <ul class="space-y-2 text-sm text-gray-400">
        <li><a href="{{ route('home') }}" class="hover:text-yellow-500 transition-colors">Beranda</a></li>
        <li><a href="{{ route('packages') }}" class="hover:text-yellow-500 transition-colors">Paket Wisata</a></li>
        <li><a href="{{ route('photos') }}" class="hover:text-yellow-500 transition-colors">Galeri</a></li>
      </ul>
    </div>

    <div>
      <h4 class="mb-4 font-bold">Layanan</h4>
      <ul class="space-y-2 text-sm text-gray-400">
        <li>Paket Wisata</li>
        <li>Transportasi</li>
        <li>Akomodasi</li>
        <li>Konsumsi</li>
      </ul>
    </div>

    <div>
      <h4 class="mb-4 font-bold">Kontak</h4>
      <ul class="space-y-2 text-sm text-gray-400">
        <li>📍 Jl. Wisata No. 123, Jakarta</li>
        <li>📞 +62 812-3456-7890</li>
        <li>✉️ info@ghinatour.com</li>
      </ul>
    </div>
  </div>

  <div class="mx-auto mt-12 max-w-[1280px] border-t border-gray-700 pt-6 text-center text-sm text-gray-400">
    <p>&copy; {{ date('Y') }} PT Ghina Tour Travel. All rights reserved.</p>
  </div>
</footer>

<!-- ===== WHATSAPP FLOATING BUTTON ===== -->
<a href="https://wa.me/6281234567890" target="_blank" class="wa-float">
  <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" class="h-14 w-14 rounded-full shadow-lg hover:scale-110 transition-transform" />
</a>

<!-- ===== JAVASCRIPT ===== -->
<script>
  // Theme Toggle
  const themeToggle = document.getElementById('themeToggle');
  const html = document.documentElement;

  themeToggle.addEventListener('change', () => {
    html.setAttribute('data-theme', themeToggle.checked ? 'dark' : 'light');
    localStorage.setItem('theme', themeToggle.checked ? 'dark' : 'light');
  });

  // Load saved theme
  const savedTheme = localStorage.getItem('theme');
  if (savedTheme) {
    html.setAttribute('data-theme', savedTheme);
    themeToggle.checked = savedTheme === 'dark';
  }

  // Fade-in animation on scroll
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
      }
    });
  }, { threshold: 0.1 });

  document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));
</script>

@yield('extra_scripts')
</body>
</html>
