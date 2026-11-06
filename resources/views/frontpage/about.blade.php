
<x-home-layout>

    <div class="bg-slate-50">

        {{-- HEADER --}}
        <section class="bg-slate-900">
            <div class="max-w-7xl mx-auto px-5 md:px-8 py-16 md:py-20">

                <span class="text-blue-300 text-sm font-semibold uppercase tracking-wider">
                    About NusaMart
                </span>

                <h1 class="text-3xl md:text-5xl font-bold text-white mt-4">
                    Mengenal NusaMart
                </h1>

                <p class="text-slate-300 mt-5 max-w-2xl leading-relaxed">
                    Mengenal lebih dekat platform informasi dan pemesanan
                    pertunjukan seni serta budaya Bali.
                </p>

            </div>
        </section>

        {{-- TENTANG NUSAMART --}}
        <section class="max-w-7xl mx-auto px-5 md:px-8 py-14">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

                {{-- GAMBAR BUDAYA BALI --}}
                <div class="relative rounded-2xl overflow-hidden shadow-lg">
                    <img
                        src="{{ asset('images/budaya-bali.jpg') }}"
                        alt="Pertunjukan Budaya Bali"
                        class="w-full h-72 md:h-96 object-cover"
                    >

                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/70 to-transparent flex items-end p-6">
                        <div>
                            <h3 class="text-2xl font-bold text-white">
                                Keindahan Budaya Bali
                            </h3>
                            <p class="text-slate-200 text-sm mt-2">
                                Warisan seni dan tradisi Pulau Dewata.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- PENJELASAN --}}
                <div>

                    <span class="text-blue-600 text-sm font-semibold uppercase tracking-wider">
                        Siapa Kami?
                    </span>

                    <h2 class="text-2xl md:text-3xl font-bold text-slate-800 mt-3">
                        Mengenalkan Keindahan Budaya Bali
                    </h2>

                    <p class="text-slate-600 leading-relaxed mt-5">
                        NusaMart merupakan prototipe portal informasi wisata
                        budaya Bali. Website ini membantu pengunjung melihat
                        informasi pertunjukan, lokasi, jadwal, serta simulasi
                        pemesanan tiket.
                    </p>

                    <p class="text-slate-600 leading-relaxed mt-4">
                        Melalui platform ini, pengunjung dapat menemukan
                        informasi pertunjukan budaya Bali dan melakukan
                        simulasi pemesanan tiket secara lebih mudah.
                    </p>

                </div>

            </div>

        </section>

        {{-- TUJUAN --}}
        <section class="bg-white border-y border-slate-200">

            <div class="max-w-7xl mx-auto px-5 md:px-8 py-14">

                <div class="text-center mb-10">

                    <span class="text-blue-600 text-sm font-semibold uppercase tracking-wider">
                        Tujuan Kami
                    </span>

                    <h2 class="text-2xl md:text-3xl font-bold text-slate-800 mt-3">
                        Manfaat NusaMart
                    </h2>

                    <p class="text-slate-500 mt-3 max-w-2xl mx-auto">
                        NusaMart dirancang untuk mempermudah pengunjung
                        mendapatkan informasi wisata budaya Bali.
                    </p>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    {{-- TUJUAN 1 --}}
                    <div class="bg-slate-50 border border-slate-200 rounded-xl p-7 hover:shadow-md transition">

                        <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-2xl">
                            📚
                        </div>

                        <h3 class="text-lg font-bold text-slate-800 mt-5">
                            Informasi Pertunjukan
                        </h3>

                        <p class="text-sm text-slate-500 leading-relaxed mt-3">
                            Menyediakan informasi mengenai berbagai
                            pertunjukan seni dan budaya Bali.
                        </p>

                    </div>

                    {{-- TUJUAN 2 --}}
                    <div class="bg-slate-50 border border-slate-200 rounded-xl p-7 hover:shadow-md transition">

                        <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-2xl">
                            📅
                        </div>

                        <h3 class="text-lg font-bold text-slate-800 mt-5">
                            Informasi Jadwal
                        </h3>

                        <p class="text-sm text-slate-500 leading-relaxed mt-3">
                            Mempermudah pengunjung menemukan lokasi,
                            tanggal, dan waktu pertunjukan.
                        </p>

                    </div>

                    {{-- TUJUAN 3 --}}
                    <div class="bg-slate-50 border border-slate-200 rounded-xl p-7 hover:shadow-md transition">

                        <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-2xl">
                            🎟️
                        </div>

                        <h3 class="text-lg font-bold text-slate-800 mt-5">
                            Simulasi Pemesanan
                        </h3>

                        <p class="text-sm text-slate-500 leading-relaxed mt-3">
                            Menampilkan simulasi pemesanan tiket wisata
                            untuk mempermudah proses pemilihan tiket.
                        </p>

                    </div>

                </div>

            </div>

        </section>

        {{-- AJAKAN --}}
        <section class="max-w-7xl mx-auto px-5 md:px-8 py-14">

            <div class="bg-blue-600 rounded-2xl p-8 md:p-12 text-center">

                <h2 class="text-2xl md:text-3xl font-bold text-white">
                    Jelajahi Pertunjukan Budaya Bali
                </h2>

                <p class="text-blue-100 mt-4 max-w-2xl mx-auto leading-relaxed">
                    Temukan berbagai pertunjukan menarik dan lihat
                    informasi jadwal yang tersedia melalui NusaMart.
                </p>

                <a href="{{ route('schedule') }}"
                   class="inline-block mt-7 bg-white hover:bg-slate-100 text-blue-700 px-7 py-3 rounded-lg font-semibold transition">
                    Lihat Pertunjukan
                </a>

            </div>

        </section>

    </div>

</x-home-layout>
