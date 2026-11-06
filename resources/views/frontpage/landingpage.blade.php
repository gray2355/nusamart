
<x-home-layout>

    <div class="min-h-screen bg-slate-50">

        {{-- HERO SECTION --}}
        <section class="bg-slate-900 text-white">
            <div class="max-w-7xl mx-auto px-6 py-16 md:py-24">
                <div class="max-w-3xl">
                    <span class="inline-block bg-blue-500/20 text-blue-300 px-4 py-2 rounded-full text-sm font-semibold mb-5">
                        Discover the Beauty of Bali
                    </span>

                    <h1 class="text-3xl md:text-5xl font-bold leading-tight">
                        Jelajahi Keindahan
                        <span class="text-blue-400">Budaya Bali</span>
                    </h1>

                    <p class="text-slate-300 mt-5 text-base md:text-lg leading-relaxed">
                        Temukan berbagai pertunjukan seni dan budaya Bali.
                        Nikmati pengalaman wisata budaya yang menarik dan
                        pesan tiket pertunjukan favoritmu dengan mudah.
                    </p>

                    <a href="#daftar-pertunjukan"
                       class="inline-block mt-8 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                        Jelajahi Pertunjukan
                    </a>
                </div>
            </div>
        </section>

        {{-- KONTEN UTAMA --}}
        <section id="daftar-pertunjukan"
                 class="max-w-7xl mx-auto px-6 py-12">

            
            {{-- JUDUL DAN FILTER --}}
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-8">

                <div>
                    <span class="text-blue-600 text-sm font-semibold uppercase tracking-wide">
                        Explore Bali
                    </span>

                    <h2 class="text-2xl md:text-3xl font-bold text-slate-800 mt-2">
                        Pertunjukan Budaya Bali
                    </h2>

                    <p class="text-slate-500 mt-2">
                        Temukan pertunjukan menarik untuk pengalaman wisata Anda.
                    </p>
                </div>

                {{-- FILTER TANGGAL --}}
                <form action="{{ route('schedule') }}"
                    method="GET"
                    class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm">

                    <p class="text-sm font-semibold text-slate-700 mb-3">
                        Cari berdasarkan tanggal
                    </p>

                    <div class="flex flex-col sm:flex-row gap-2">

                        <input
                            type="date"
                            name="start_date"
                            class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >

                        <input
                            type="date"
                            name="end_date"
                            class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-semibold transition">
                            Cari
                        </button>

                    </div>
                </form>

            </div>

            {{-- PENCARIAN NAMA DAN LOKASI --}}
            <div class="bg-white border border-slate-200 rounded-xl p-5 shadow-sm mb-7">

                <form action="{{ route('home') }}" method="GET">

                    <label for="keyword" class="block text-sm font-semibold text-slate-700 mb-3">
                        Cari Pertunjukan Berdasarkan Nama atau Lokasi
                    </label>

                    <div class="flex flex-col sm:flex-row gap-3">

                        <div class="relative flex-1">
                            <input
                                type="text"
                                id="keyword"
                                name="keyword"
                                value="{{ $keyword ?? '' }}"
                                placeholder="Contoh: Tari Kecak, Uluwatu, Ubud..."
                                class="w-full border border-slate-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                        </div>

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-7 py-3 rounded-lg text-sm font-semibold transition">
                            🔍 Cari Pertunjukan
                        </button>

                        @if (!empty($keyword))
                            <a
                                href="{{ route('home') }}"
                                class="border border-slate-300 hover:bg-slate-50 text-slate-700 px-5 py-3 rounded-lg text-sm font-semibold text-center transition">
                                Reset
                            </a>
                        @endif

                    </div>

                    <p class="text-xs text-slate-400 mt-3">
                        Masukkan nama pertunjukan atau lokasi yang ingin Anda cari.
                    </p>

                </form>

            </div>


            {{-- DAFTAR KARTU PERTUNJUKAN --}}
            @forelse ($shows as $show)

                <div class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition mb-6">

                    <div class="grid grid-cols-1 md:grid-cols-3">

                        {{-- GAMBAR --}}
                        <div class="relative h-56 md:h-full min-h-64 bg-slate-100">

                            @if (!empty($show->image))
                                <img
                                    src="{{ asset('storage/' . $show->image) }}"
                                    alt="Pertunjukan {{ $show->name }}"
                                    class="w-full h-full object-cover"
                                    onerror="this.onerror=null;this.src='https://placehold.co/600x400?text=No+Image';"
                                >
                            @else
                                <div class="w-full h-full min-h-64 flex flex-col items-center justify-center bg-slate-100 text-slate-400">
                                    <span class="text-5xl mb-3">🎭</span>
                                    <span class="text-sm font-medium">Gambar belum tersedia</span>
                                </div>
                            @endif

                        </div>

                        {{-- INFORMASI --}}
                        <div class="md:col-span-2 p-5 md:p-7 flex flex-col">

                            <div class="flex flex-wrap justify-between items-start gap-3">

                                <div>
                                    <h3 class="text-xl font-bold text-slate-800">
                                        {{ $show->name }}
                                    </h3>

                                    <p class="text-sm text-slate-500 mt-2">
                                        <span class="mr-1">📍</span>
                                        {{ $show->location }}
                                    </p>
                                </div>

                                @if ($show->quota > 0)
                                    <span class="bg-green-50 text-green-700 text-xs font-semibold px-3 py-2 rounded-full">
                                        Tersedia
                                    </span>
                                @else
                                    <span class="bg-red-50 text-red-600 text-xs font-semibold px-3 py-2 rounded-full">
                                        Habis
                                    </span>
                                @endif

                            </div>

                            {{-- TANGGAL DAN WAKTU --}}
                            <div class="flex flex-wrap gap-5 mt-4 text-sm text-slate-500">

                                <span>
                                    📅 {{ $show->date }}
                                </span>

                                <span>
                                    🕒 {{ $show->time }}
                                </span>

                            </div>

                            {{-- HARGA --}}
                            <div class="mt-5">
                                <p class="text-xs text-slate-500">
                                    Harga tiket mulai dari
                                </p>

                                <p class="text-2xl font-bold text-blue-600 mt-1">
                                    Rp{{ number_format($show->price_domestic, 0, ',', '.') }}
                                </p>
                            </div>

                            {{-- DESKRIPSI --}}
                            <p class="text-sm text-slate-600 leading-relaxed mt-4">
                                {{ $show->description }}
                            </p>

                            {{-- PEMBATAS --}}
                            <div class="border-t border-slate-200 mt-5 pt-5">

                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">

                                    <p class="text-sm text-slate-500">
                                        Kuota tersedia:
                                        <span class="font-semibold text-slate-800">
                                            {{ $show->quota }} tiket
                                        </span>
                                    </p>

                                    {{-- TOMBOL --}}
                                    <div class="flex flex-wrap gap-2">

                                        <a
                                            href="{{ route('detail', $show->id) }}"
                                            class="border border-slate-300 text-slate-700 hover:bg-slate-100 px-5 py-2.5 rounded-lg text-sm font-semibold transition">
                                            Lihat Detail
                                        </a>

                                        @if ($show->quota > 0)
                                            <a
                                                href="{{ route('booking', $show->id) }}"
                                                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-semibold transition">
                                                Booking Tiket
                                            </a>
                                        @else
                                            <button
                                                disabled
                                                class="bg-slate-300 text-slate-500 px-5 py-2.5 rounded-lg text-sm font-semibold cursor-not-allowed">
                                                Tiket Habis
                                            </button>
                                        @endif

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                {{-- JIKA BELUM ADA DATA --}}
                <div class="bg-white border border-slate-200 rounded-xl p-12 text-center">

                    <div class="text-5xl mb-4">🎭</div>

                    <h3 class="text-lg font-bold text-slate-800">
                        Belum Ada Pertunjukan
                    </h3>

                    <p class="text-sm text-slate-500 mt-2">
                        Saat ini belum tersedia pertunjukan budaya Bali.
                        Silakan kunjungi kembali nanti.
                    </p>

                </div>

            @endforelse

            {{-- TOMBOL LIHAT SEMUA JADWAL --}}
            @if ($shows->count() > 0)
                <div class="text-center mt-10">

                    <a
                        href="{{ route('schedule') }}"
                        class="inline-block bg-white border border-slate-300 hover:bg-slate-100 text-slate-700 px-7 py-3 rounded-lg font-semibold text-sm transition">
                        Lihat Semua Jadwal Pertunjukan
                    </a>

                </div>
            @endif

        </section>

    </div>

</x-home-layout>
