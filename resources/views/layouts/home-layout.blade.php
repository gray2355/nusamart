```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'NusaMart - Wisata Budaya Bali' }}</title>

    <meta name="description" content="Temukan dan pesan tiket pertunjukan seni dan budaya Bali melalui NusaMart.">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="bg-slate-50 text-slate-800 antialiased">

    {{-- NAVBAR --}}
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-5 md:px-8">

            <div class="flex items-center justify-between min-h-[76px] gap-6">

                {{-- LOGO --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 shrink-0">
                    <div class="w-11 h-11 bg-blue-600 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-sm">
                        NM
                    </div>

                    <div>
                        <h1 class="text-xl font-bold text-slate-900">
                            NusaMart
                        </h1>
                        <p class="text-xs text-slate-500">
                            Wisata Budaya Bali
                        </p>
                    </div>
                </a>

                {{-- NAVIGASI --}}
                <nav class="hidden md:flex items-center gap-7">

                    <a href="{{ route('home') }}"
                       class="text-sm font-medium text-slate-600 hover:text-blue-600 transition">
                        Beranda
                    </a>

                    <a href="{{ route('schedule') }}"
                       class="text-sm font-medium text-slate-600 hover:text-blue-600 transition">
                        Pertunjukan
                    </a>

                    <a href="{{ route('about') }}"
                       class="text-sm font-medium text-slate-600 hover:text-blue-600 transition">
                        Tentang
                    </a>

                    <a href="{{ route('contact') }}"
                       class="text-sm font-medium text-slate-600 hover:text-blue-600 transition">
                        Kontak
                    </a>

                </nav>

                {{-- LOGIN / LOGOUT --}}
                <div class="flex items-center gap-3 shrink-0">

                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-5 py-2.5 rounded-lg text-sm font-semibold transition shadow-sm">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-semibold transition shadow-sm">
                            Login
                        </a>
                    @endauth

                </div>

            </div>

            {{-- NAVIGASI MOBILE --}}
            <nav class="md:hidden flex items-center gap-5 overflow-x-auto pb-4 text-sm whitespace-nowrap">

                <a href="{{ route('home') }}"
                   class="text-slate-600 hover:text-blue-600 font-medium">
                    Beranda
                </a>

                <a href="{{ route('schedule') }}"
                   class="text-slate-600 hover:text-blue-600 font-medium">
                    Pertunjukan
                </a>

                <a href="{{ route('about') }}"
                   class="text-slate-600 hover:text-blue-600 font-medium">
                    Tentang
                </a>

                <a href="{{ route('contact') }}"
                   class="text-slate-600 hover:text-blue-600 font-medium">
                    Kontak
                </a>

            </nav>

        </div>
    </header>

    {{-- KONTEN HALAMAN --}}
    <main class="w-full min-h-screen">
        {{ $slot }}
    </main>

    {{-- FOOTER --}}
    <footer class="bg-slate-900 text-slate-300 mt-12">

        <div class="max-w-7xl mx-auto px-5 md:px-8 py-12">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

                <div>
                    <div class="flex items-center gap-3 mb-4">

                        <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold">
                            NM
                        </div>

                        <h2 class="text-xl font-bold text-white">
                            NusaMart
                        </h2>

                    </div>

                    <p class="text-sm text-slate-400 leading-relaxed">
                        Platform pemesanan tiket pertunjukan seni dan budaya
                        Bali untuk membantu wisatawan menikmati keindahan
                        budaya lokal.
                    </p>
                </div>

                <div>
                    <h3 class="font-semibold text-white mb-4">
                        Navigasi
                    </h3>

                    <div class="flex flex-col gap-3 text-sm">

                        <a href="{{ route('home') }}" class="hover:text-blue-400 transition">
                            Beranda
                        </a>

                        <a href="{{ route('schedule') }}" class="hover:text-blue-400 transition">
                            Pertunjukan
                        </a>

                        <a href="{{ route('about') }}" class="hover:text-blue-400 transition">
                            Tentang Kami
                        </a>

                        <a href="{{ route('contact') }}" class="hover:text-blue-400 transition">
                            Kontak
                        </a>

                    </div>
                </div>

                <div>
                    <h3 class="font-semibold text-white mb-4">
                        Wisata Budaya Bali
                    </h3>

                    <p class="text-sm text-slate-400 leading-relaxed">
                        Temukan berbagai pertunjukan tradisional Bali,
                        lihat jadwal, dan pesan tiket dengan mudah
                        melalui NusaMart.
                    </p>
                </div>

            </div>

            <div class="border-t border-slate-700 mt-10 pt-6 text-center text-xs text-slate-500">
                &copy; {{ date('Y') }} NusaMart. Sistem Informasi Wisata Budaya Bali.
            </div>

        </div>

    </footer>

</body>
</html>
```