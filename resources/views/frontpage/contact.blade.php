
<x-home-layout>

    <div class="bg-slate-50">

        {{-- HEADER --}}
        <section class="bg-slate-900">
            <div class="max-w-7xl mx-auto px-5 md:px-8 py-16">

                <span class="text-blue-300 text-sm font-semibold uppercase tracking-wider">
                    Contact Us
                </span>

                <h1 class="text-3xl md:text-4xl font-bold text-white mt-4">
                    Hubungi NusaMart
                </h1>

                <p class="text-slate-300 mt-4 max-w-2xl leading-relaxed">
                    Kami menyediakan informasi seputar pertunjukan seni
                    dan budaya Bali untuk membantu pengalaman wisata Anda.
                </p>

            </div>
        </section>

        {{-- KONTEN --}}
        <section class="max-w-7xl mx-auto px-5 md:px-8 py-14">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                {{-- INFORMASI KONTAK --}}
                <div>

                    <span class="text-blue-600 text-sm font-semibold uppercase tracking-wider">
                        Informasi Layanan
                    </span>

                    <h2 class="text-2xl md:text-3xl font-bold text-slate-800 mt-3">
                        Kami Siap Membantu Anda
                    </h2>

                    <p class="text-slate-500 leading-relaxed mt-4">
                        NusaMart merupakan platform informasi wisata budaya
                        Bali yang membantu pengunjung menemukan informasi
                        pertunjukan, lokasi, jadwal, dan simulasi pemesanan tiket.
                    </p>

                    <div class="space-y-4 mt-8">

                        {{-- NAMA LAYANAN --}}
                        <div class="bg-white border border-slate-200 rounded-xl p-5 flex items-start gap-4">

                            <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center text-2xl shrink-0">
                                🏝️
                            </div>

                            <div>
                                <p class="text-sm text-slate-500">
                                    Nama Layanan
                                </p>

                                <p class="font-bold text-slate-800 mt-1">
                                    NusaMart Wisata Budaya
                                </p>
                            </div>

                        </div>

                        {{-- WILAYAH --}}
                        <div class="bg-white border border-slate-200 rounded-xl p-5 flex items-start gap-4">

                            <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center text-2xl shrink-0">
                                📍
                            </div>

                            <div>
                                <p class="text-sm text-slate-500">
                                    Wilayah Informasi
                                </p>

                                <p class="font-bold text-slate-800 mt-1">
                                    Bali, Indonesia
                                </p>
                            </div>

                        </div>

                        {{-- EMAIL --}}
                        <div class="bg-white border border-slate-200 rounded-xl p-5 flex items-start gap-4">

                            <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center text-2xl shrink-0">
                                ✉️
                            </div>

                            <div>
                                <p class="text-sm text-slate-500">
                                    Email
                                </p>

                                <p class="font-bold text-slate-800 mt-1">
                                    Belum dikonfigurasi
                                </p>

                                <p class="text-xs text-slate-400 mt-1">
                                    Informasi email akan tersedia setelah dikonfigurasi.
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

                {{-- KARTU INFORMASI --}}
                <div class="bg-blue-600 rounded-2xl p-8 md:p-10 flex flex-col justify-between min-h-80">

                    <div>

                        <div class="w-16 h-16 bg-white/15 rounded-xl flex items-center justify-center text-4xl">
                            🎭
                        </div>

                        <h2 class="text-2xl md:text-3xl font-bold text-white mt-7">
                            Jelajahi Budaya Bali Bersama NusaMart
                        </h2>

                        <p class="text-blue-100 leading-relaxed mt-4">
                            Temukan berbagai pertunjukan seni dan budaya Bali.
                            Dapatkan informasi jadwal dan harga tiket melalui
                            platform NusaMart.
                        </p>

                    </div>

                    <a href="{{ route('schedule') }}"
                       class="inline-block text-center bg-white hover:bg-blue-50 text-blue-700 font-semibold px-6 py-3 rounded-lg mt-8 transition">
                        Lihat Pertunjukan
                    </a>

                </div>

            </div>

        </section>

    </div>

</x-home-layout>
