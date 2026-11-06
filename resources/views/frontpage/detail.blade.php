
<x-home-layout>

    <div class="bg-slate-50">

        {{-- HEADER --}}
        <section class="bg-slate-900">
            <div class="max-w-7xl mx-auto px-5 md:px-8 py-10">

                <a href="{{ route('schedule') }}"
                   class="text-sm text-blue-300 hover:text-white transition">
                    ← Kembali ke Jadwal Pertunjukan
                </a>

                <p class="text-blue-300 text-sm font-semibold uppercase tracking-wider mt-6">
                    Detail Pertunjukan
                </p>

                <h1 class="text-3xl md:text-4xl font-bold text-white mt-3">
                    {{ $show->name }}
                </h1>

                <p class="text-slate-300 mt-3">
                    📍 {{ $show->location }}
                </p>

            </div>
        </section>

        {{-- KONTEN DETAIL --}}
        <section class="max-w-7xl mx-auto px-5 md:px-8 py-10">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- INFORMASI UTAMA --}}
                <div class="lg:col-span-2 space-y-7">

                    {{-- GAMBAR --}}
                    <div class="bg-white rounded-xl overflow-hidden border border-slate-200 shadow-sm">

                        @if (!empty($show->image))

                            <img
                                src="{{ asset('storage/' . $show->image) }}"
                                alt="Pertunjukan {{ $show->name }}"
                                class="w-full h-64 md:h-96 object-cover"
                                onerror="this.onerror=null;this.src='https://placehold.co/1000x600?text=No+Image';"
                            >

                        @else

                            <div class="w-full h-64 md:h-96 bg-slate-100 flex flex-col items-center justify-center text-slate-400">
                                <span class="text-7xl mb-4">🎭</span>
                                <p class="font-medium">
                                    Gambar pertunjukan belum tersedia
                                </p>
                            </div>

                        @endif

                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 md:p-8">

                        <h2 class="text-xl font-bold text-slate-800">
                            Tentang Pertunjukan
                        </h2>

                        <p class="text-slate-600 leading-relaxed mt-4 whitespace-pre-line">
                            {{ $show->description ?: 'Belum ada deskripsi untuk pertunjukan ini.' }}
                        </p>

                    </div>

                    {{-- INFORMASI JADWAL --}}
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 md:p-8">

                        <h2 class="text-xl font-bold text-slate-800 mb-6">
                            Informasi Pertunjukan
                        </h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 rounded-lg bg-blue-50 flex items-center justify-center text-xl shrink-0">
                                    📍
                                </div>

                                <div>
                                    <p class="text-sm text-slate-500">
                                        Lokasi
                                    </p>

                                    <p class="font-semibold text-slate-800 mt-1">
                                        {{ $show->location }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 rounded-lg bg-blue-50 flex items-center justify-center text-xl shrink-0">
                                    📅
                                </div>

                                <div>
                                    <p class="text-sm text-slate-500">
                                        Tanggal
                                    </p>

                                    <p class="font-semibold text-slate-800 mt-1">
                                        {{ $show->date }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 rounded-lg bg-blue-50 flex items-center justify-center text-xl shrink-0">
                                    🕒
                                </div>

                                <div>
                                    <p class="text-sm text-slate-500">
                                        Waktu
                                    </p>

                                    <p class="font-semibold text-slate-800 mt-1">
                                        {{ $show->time }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 rounded-lg bg-blue-50 flex items-center justify-center text-xl shrink-0">
                                    🎟️
                                </div>

                                <div>
                                    <p class="text-sm text-slate-500">
                                        Kuota Tersedia
                                    </p>

                                    <p class="font-semibold text-slate-800 mt-1">
                                        {{ $show->quota }} tiket
                                    </p>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                {{-- KARTU PEMESANAN --}}
                <div class="lg:col-span-1">

                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6 sticky top-24">

                        <h2 class="text-xl font-bold text-slate-800">
                            Harga Tiket
                        </h2>

                        <p class="text-sm text-slate-500 mt-2">
                            Pilih kategori tiket sesuai kebutuhan Anda.
                        </p>

                        {{-- HARGA DOMESTIK --}}
                        <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 mt-6">

                            <p class="text-sm text-slate-600">
                                Wisatawan Domestik
                            </p>

                            <p class="text-2xl font-bold text-blue-700 mt-2">
                                Rp{{ number_format($show->price_domestic, 0, ',', '.') }}
                            </p>

                        </div>

                        {{-- HARGA MANCANEGARA --}}
                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-5 mt-4">

                            <p class="text-sm text-slate-600">
                                Wisatawan Mancanegara
                            </p>

                            <p class="text-2xl font-bold text-slate-800 mt-2">
                                Rp{{ number_format($show->price_foreign, 0, ',', '.') }}
                            </p>

                        </div>

                        {{-- STATUS --}}
                        <div class="flex items-center justify-between mt-6">

                            <span class="text-sm text-slate-500">
                                Status Tiket
                            </span>

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

                        <div class="border-t border-slate-200 mt-5 pt-5">

                            @if ($show->quota > 0)

                                <a
                                    href="{{ route('booking', $show->id) }}"
                                    class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold transition">
                                    Pesan Tiket Sekarang
                                </a>

                            @else

                                <button
                                    disabled
                                    class="block w-full bg-slate-300 text-slate-500 py-3 rounded-lg font-semibold cursor-not-allowed">
                                    Tiket Sudah Habis
                                </button>

                            @endif

                            <a
                                href="{{ route('schedule') }}"
                                class="block w-full text-center border border-slate-300 hover:bg-slate-50 text-slate-700 py-3 rounded-lg font-semibold mt-3 transition">
                                Kembali ke Jadwal
                            </a>

                        </div>

                        <p class="text-xs text-slate-400 text-center mt-5">
                            Nikmati pengalaman wisata budaya Bali bersama NusaMart.
                        </p>

                    </div>

                </div>

            </div>

        </section>

    </div>

</x-home-layout>
