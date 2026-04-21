@extends('components.layout.admin')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
    <style>
        *,
        body {
            font-family: 'Poppins', sans-serif;
        }

        :root {
            --gold: #D4A017;
            --gold-dark: #b8860b;
            --orange: #FF9357;
        }

        [data-theme="light"] {
            --bg: #F2F3F7;
            --bg-card: #FFFFFF;
            --text: #1a1a1a;
            --text-muted: #6b7280;
            --border: #E5E7EB;
            --table-head: #F9FAFB;
            --table-border: #F3F4F6;
            --shadow-card: 0 2px 8px rgba(0, 0, 0, .06);
            --sidebar-active-bg: #FFF4EB;
        }

        [data-theme="dark"] {
            --bg: #0f1117;
            --bg-card: #1e2130;
            --text: #f1f5f9;
            --text-muted: #94a3b8;
            --border: #2d3348;
            --table-head: #1a1f2e;
            --table-border: #2a3045;
            --shadow-card: 0 2px 12px rgba(0, 0, 0, .3);
            --sidebar-active-bg: rgba(212, 160, 23, .12);
        }

        /* ── Stat cards ── */
        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: var(--shadow-card);
            padding: 22px 26px;
            display: flex;
            align-items: center;
            gap: 18px;
            transition: background .3s, border-color .3s;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stat-label {
            font-size: 13px;
            color: var(--text-muted);
            margin: 0 0 4px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: var(--text);
            line-height: 1;
            margin: 0;
        }

        /* ── Table card ── */
        .adm-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: var(--shadow-card);
            overflow: hidden;
        }

        .adm-tbl {
            width: 100%;
            border-collapse: collapse;
        }

        .adm-tbl thead th {
            background: var(--table-head);
            color: var(--text-muted);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
            padding: 13px 18px;
            text-align: left;
            border-bottom: 1px solid var(--table-border);
        }

        .adm-tbl tbody td {
            padding: 14px 18px;
            font-size: 14px;
            color: var(--text);
            border-bottom: 1px solid var(--table-border);
        }

        .adm-tbl tbody tr:last-child td {
            border-bottom: none;
        }

        .adm-tbl tbody tr:hover {
            background: var(--sidebar-active-bg);
        }

        /* ── Badge paket ── */
        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
        }

        .badge-day {
            background: #FFF4EB;
            color: var(--orange);
        }

        .badge-inap {
            background: #EFF6FF;
            color: #2563eb;
        }

        [data-theme="dark"] .badge-day {
            background: rgba(255, 147, 87, .15);
            color: #ff9357;
        }

        [data-theme="dark"] .badge-inap {
            background: rgba(37, 99, 235, .15);
            color: #60a5fa;
        }

        /* ── Invoice icon button ── */
        .btn-view {
            background: transparent;
            color: #8b5cf6;
            border: none;
            cursor: pointer;
            padding: 5px;
            border-radius: 6px;
            transition: background .15s;
            display: inline-flex;
            align-items: center;
        }

        .btn-view:hover {
            background: rgba(139, 92, 246, .1);
        }
    </style>

    {{-- ── Judul ── --}}
    <h1 style="font-size:26px;font-weight:700;color:var(--text);margin:0 0 24px;">Dashboard</h1>

    {{-- ── Stat Cards ── --}}
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:18px;margin-bottom:32px;">

        <div class="stat-card">
            <div class="stat-icon" style="background:#FFF4EB;">
                <svg style="width:24px;height:24px;color:var(--orange);" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <div>
                <p class="stat-label">Total Paket</p>
                <p class="stat-value">{{ $totalPaket }}</p>
            </div>
        </div>


    </div>

    {{-- ── Tabel Pesanan Terbaru ── --}}
    <div class="adm-card">
        <div style="padding:18px 20px;border-bottom:1px solid var(--border);">
            <h2 style="font-size:16px;font-weight:700;color:var(--text);margin:0;">Pesanan Terbaru</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="adm-tbl">
                <thead>
                    <tr>
                        <th style="width:50px;">No</th>
                        <th>Nama Perwakilan</th>
                        <th>No. HP</th>
                        <th>Paket</th>
                        <th>Harga Total</th>
                        <th style="width:90px;text-align:center;">Invoice</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Data dummy pesanan; ganti dengan relasi Pesanan/Order jika sudah ada --}}
                    {{-- @php
                        $dummyPesanan = [
                            [
                                'nama' => 'Admin User',
                                'hp' => '081234567890',
                                'paket' => 'Jogja 1 Day',
                                'harga' => 207200,
                                'inap' => false,
                            ],
                            [
                                'nama' => 'Admin User',
                                'hp' => '081234567890',
                                'paket' => 'Bali 1 Day',
                                'harga' => 207200,
                                'inap' => true,
                            ],
                            [
                                'nama' => 'Admin User',
                                'hp' => '081234567890',
                                'paket' => 'Jogja 1 Day',
                                'harga' => 207200,
                                'inap' => false,
                            ],
                            [
                                'nama' => 'Admin User',
                                'hp' => '081234567890',
                                'paket' => 'Bali 1 Day',
                                'harga' => 207200,
                                'inap' => true,
                            ],
                            [
                                'nama' => 'Budi Santoso',
                                'hp' => '082134500000',
                                'paket' => 'Karimunjawa 3D2N',
                                'harga' => 555000,
                                'inap' => true,
                            ],
                            [
                                'nama' => 'Sari Dewi',
                                'hp' => '085678901234',
                                'paket' => 'Semarang 1 Day',
                                'harga' => 300000,
                                'inap' => false,
                            ],
                        ];
                    @endphp --}}

                    @foreach ($orders as $i => $p)
                        <tr>
                            <td style="color:var(--text-muted);font-size:13px;">{{ $i + 1 }}</td>
                            <td style="font-weight:500;">{{ $p['nama'] }}</td>
                            <td style="color:var(--text-muted);">{{ $p['hp'] }}</td>
                            <td>
                                <span class="badge {{ $p['inap'] ? 'badge-inap' : 'badge-day' }}">
                                    {{ $p['paket'] }}
                                </span>
                            </td>
                            <td style="font-weight:600;">Rp {{ number_format($p['harga'], 0, ',', '.') }}</td>
                            <td style="text-align:center;">
                                <button class="btn-view" title="Lihat Invoice">
                                    <svg style="width:17px;height:17px;" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
