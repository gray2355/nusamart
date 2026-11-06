
<x-home-layout>

    <div class="bg-slate-50">

        {{-- HEADER HALAMAN --}}
        <section class="bg-slate-900">
            <div class="max-w-7xl mx-auto px-5 md:px-8 py-14 md:py-16">

                <span class="text-blue-300 text-sm font-semibold uppercase tracking-wider">
                    Explore Bali
                </span>

                <h1 class="text-3xl md:text-4xl font-bold text-white mt-3">
                    Jadwal Pertunjukan
                </h1>

                <p class="text-slate-300 mt-4 max-w-2xl leading-relaxed">
                    Temukan berbagai pertunjukan seni dan budaya Bali.
                    Pilih pertunjukan favorit dan nikmati pengalaman wisata
                    budaya yang berkesan.
                </p>

            </div>
        </section>

        {{-- DAFTAR PERTUNJUKAN --}}
        <section class="max-w-7xl mx-auto px-5 md:px-8 py-12">

            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3 mb-8">

                <div>
                    <h2 class="text-2xl font-bold text-slate-800">
                        Semua Pertunjukan
                    </h2>

                    <p class="text-sm text-slate-500 mt-2">
                        Pilih pertunjukan yang ingin Anda kunjungi.
                    </p>
                </div>

                <p class="text-sm text-slate-500">
                    Total
                    <span class="font-bold text-slate-800">
                        {{ $shows->count() }}
                    </span>
                    pertunjukan
                </p>

            </div>

            {{-- GRID KARTU --}}
            @if ($shows->count() > 0)

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach ($shows as $show)

                        <article class="bg-white border border-slate-200 rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition duration-300 flex flex-col">

                            {{-- GAMBAR --}}
                            <div class="relative h-56 bg-slate-100 overflow-hidden">

                                @if (!empty($show->image))

                                    <img
                                        src="{{ asset('storage/' . $show->image) }}"
                                        alt="Pertunjukan {{ $show->name }}"
                                        class="w-full h-full object-cover hover:scale-105 transition duration-500"
                                        onerror="this.onerror=null;this.src='https://placehold.co/600x400?text=No+Image';"
                                    >

                                @else

                                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-400">
                                        <span class="text-5xl mb-3">🎭</span>
                                        <span class="text-sm font-medium">
                                            Gambar belum tersedia
                                        </span>
                                    </div>

                                @endif

                                {{-- STATUS --}}
                                <div class="absolute top-4 right-4">

                                    @if ($show->quota > 0)

                                        <span class="bg-green-50 text-green-700 px-3 py-1.5 rounded-full text-xs font-semibold shadow-sm">
                                            Tersedia
                                        </span>

                                    @else

                                        <span class="bg-red-50 text-red-600 px-3 py-1.5 rounded-full text-xs font-semibold shadow-sm">
                                            Tiket Habis
                                        </span>

                                    @endif

                                </div>

                            </div>

                            {{-- INFORMASI --}}
                            <div class="p-5 flex flex-col flex-1">

                                <h3 class="text-lg font-bold text-slate-800 line-clamp-2">
                                    {{ $show->name }}
                                </h3>

                                <div class="space-y-3 mt-4 text-sm text-slate-500">

                                    <p class="flex items-start gap-2">
                                        <span>📍</span>
                                        <span>{{ $show->location }}</span>
                                    </p>

                                    <p class="flex items-start gap-2">
                                        <span>📅</span>
                                        <span>{{ $show->date }}</span>
                                    </p>

                                    <p class="flex items-start gap-2">
                                        <span>🕒</span>
                                        <span>{{ $show->time }}</span>
                                    </p>

                                </div>

                                {{-- DESKRIPSI --}}
                                <p class="text-sm text-slate-500 leading-relaxed mt-4 line-clamp-3">
                                    {{ $show->description }}
                                </p>

                                {{-- HARGA DAN KUOTA --}}
                                <div class="border-t border-slate-100 mt-5 pt-4">

                                    <p class="text-xs text-slate-500">
                                        Harga tiket domestik
                                    </p>

                                    <p class="text-xl font-bold text-blue-600 mt-1">
                                        Rp{{ number_format($show->price_domestic, 0, ',', '.') }}
                                    </p>

                                    <p class="text-xs text-slate-500 mt-2">
                                        Kuota tersedia:
                                        <span class="font-semibold text-slate-700">
                                            {{ $show->quota }} tiket
                                        </span>
                                    </p>

                                </div>

                                {{-- TOMBOL DETAIL --}}
                                <div class="mt-auto pt-5">

                                    <a
                                        href="{{ route('detail', $show->id) }}"
                                        class="block text-center bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg text-sm font-semibold transition">
                                        Lihat Detail
                                    </a>

                                </div>

                            </div>

                        </article>

                    @endforeach

                </div>

            @else

                {{-- JIKA DATA KOSONG --}}
                <div class="bg-white border border-slate-200 rounded-xl p-12 text-center">

                    <div class="text-5xl mb-4">🎭</div>

                    <h3 class="text-xl font-bold text-slate-800">
                        Belum Ada Pertunjukan
                    </h3>

                    <p class="text-sm text-slate-500 mt-2">
                        Belum ada jadwal pertunjukan yang tersedia saat ini.
                    </p>

                    <a
                        href="{{ route('home') }}"
                        class="inline-block mt-6 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg text-sm font-semibold transition">
                        Kembali ke Beranda
                    </a>

                </div>

            @endif

        </section>

    </div>

</x-home-layout>
