
<x-home-layout>

    <div class="bg-slate-50 min-h-screen">

        <section class="max-w-4xl mx-auto px-5 md:px-8 py-12">

            {{-- STATUS KONFIRMASI --}}
            <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

                <div class="bg-slate-900 px-6 py-10 text-center">

                    <div class="w-16 h-16 bg-green-500/20 rounded-full flex items-center justify-center mx-auto mb-5">
                        <span class="text-4xl">✓</span>
                    </div>

                    <h1 class="text-2xl md:text-3xl font-bold text-white">
                        Pemesanan Berhasil!
                    </h1>

                    <p class="text-slate-300 mt-3 text-sm md:text-base">
                        Data pemesanan Anda berhasil disimpan.
                    </p>

                </div>

                <div class="p-6 md:p-8">

                    {{-- INFORMASI BOOKING --}}
                    <div class="text-center mb-8">

                        <p class="text-sm text-slate-500">
                            Nomor Pemesanan
                        </p>

                        <p class="text-2xl font-bold text-blue-600 mt-2">
                            #{{ $savedBooking->id }}
                        </p>

                        <p class="text-xs text-slate-400 mt-2">
                            Simpan nomor ini sebagai referensi pemesanan Anda.
                        </p>

                    </div>

                    {{-- INFORMASI PEMESAN --}}
                    <div class="border border-slate-200 rounded-xl p-5">

                        <h2 class="text-lg font-bold text-slate-800 mb-5">
                            Informasi Pemesan
                        </h2>

                        <div class="space-y-4">

                            <div class="flex justify-between gap-4 text-sm">
                                <span class="text-slate-500">Nama Pemesan</span>
                                <span class="font-semibold text-slate-800 text-right">
                                    {{ $booking['name'] }}
                                </span>
                            </div>

                            <div class="flex justify-between gap-4 text-sm">
                                <span class="text-slate-500">Email</span>
                                <span class="font-semibold text-slate-800 text-right break-all">
                                    {{ $booking['email'] }}
                                </span>
                            </div>

                        </div>

                    </div>

                    {{-- INFORMASI PERTUNJUKAN --}}
                    <div class="border border-slate-200 rounded-xl p-5 mt-5">

                        <h2 class="text-lg font-bold text-slate-800 mb-5">
                            Detail Pertunjukan
                        </h2>

                        <div class="space-y-4">

                            <div class="flex justify-between gap-4 text-sm">
                                <span class="text-slate-500">Nama Pertunjukan</span>
                                <span class="font-semibold text-slate-800 text-right">
                                    {{ $show->name }}
                                </span>
                            </div>

                            <div class="flex justify-between gap-4 text-sm">
                                <span class="text-slate-500">Lokasi</span>
                                <span class="font-semibold text-slate-800 text-right">
                                    {{ $show->location }}
                                </span>
                            </div>

                            <div class="flex justify-between gap-4 text-sm">
                                <span class="text-slate-500">Tanggal</span>
                                <span class="font-semibold text-slate-800 text-right">
                                    {{ $show->date }}
                                </span>
                            </div>

                            <div class="flex justify-between gap-4 text-sm">
                                <span class="text-slate-500">Waktu</span>
                                <span class="font-semibold text-slate-800 text-right">
                                    {{ $show->time }}
                                </span>
                            </div>

                        </div>

                    </div>

                    {{-- RINCIAN PEMBAYARAN --}}
                    <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 mt-5">

                        <h2 class="text-lg font-bold text-slate-800 mb-5">
                            Rincian Pemesanan
                        </h2>

                        <div class="space-y-4">

                            <div class="flex justify-between gap-4 text-sm">
                                <span class="text-slate-600">Kategori Tiket</span>
                                <span class="font-semibold text-slate-800">
                                    {{ $booking['category'] === 'domestic' ? 'Domestik' : 'Mancanegara' }}
                                </span>
                            </div>

                            <div class="flex justify-between gap-4 text-sm">
                                <span class="text-slate-600">Jumlah Tiket</span>
                                <span class="font-semibold text-slate-800">
                                    {{ $booking['quantity'] }} tiket
                                </span>
                            </div>

                            <div class="flex justify-between gap-4 text-sm">
                                <span class="text-slate-600">Harga per Tiket</span>
                                <span class="font-semibold text-slate-800">
                                    Rp{{ number_format($price, 0, ',', '.') }}
                                </span>
                            </div>

                            <div class="border-t border-blue-200 pt-4 flex justify-between items-center gap-4">

                                <span class="font-bold text-slate-800">
                                    Total Pembayaran
                                </span>

                                <span class="text-xl md:text-2xl font-bold text-blue-700">
                                    Rp{{ number_format($total, 0, ',', '.') }}
                                </span>

                            </div>

                        </div>

                    </div>

                    {{-- INFORMASI STATUS --}}
                    <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 mt-6">

                        <p class="text-sm font-semibold text-amber-800">
                            Informasi
                        </p>

                        <p class="text-sm text-amber-700 mt-2 leading-relaxed">
                            Data pemesanan telah tersimpan di database NusaMart.
                            Halaman ini merupakan konfirmasi pemesanan, bukan bukti pembayaran.
                            Sistem pembayaran dan penerbitan tiket belum tersedia.
                        </p>

                    </div>

                    {{-- TOMBOL --}}
                    <div class="flex flex-col sm:flex-row gap-3 mt-8">

                        <a
                            href="{{ route('home') }}"
                            class="flex-1 text-center bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold transition">
                            Kembali ke Beranda
                        </a>

                        <a
                            href="{{ route('schedule') }}"
                            class="flex-1 text-center border border-slate-300 hover:bg-slate-50 text-slate-700 py-3 rounded-lg font-semibold transition">
                            Lihat Pertunjukan Lain
                        </a>

                    </div>

                </div>

            </div>

        </section>

    </div>

</x-home-layout>
