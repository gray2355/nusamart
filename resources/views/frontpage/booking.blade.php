
<x-home-layout>

    <div class="bg-slate-50">

        {{-- HEADER --}}
        <section class="bg-slate-900">
            <div class="max-w-7xl mx-auto px-5 md:px-8 py-12">

                <a href="{{ route('detail', $show->id) }}"
                   class="text-sm text-blue-300 hover:text-white transition">
                    ← Kembali ke Detail Pertunjukan
                </a>

                <p class="text-blue-300 text-sm font-semibold uppercase tracking-wider mt-6">
                    Pemesanan Tiket
                </p>

                <h1 class="text-3xl md:text-4xl font-bold text-white mt-3">
                    Pesan Tiket Pertunjukan
                </h1>

                <p class="text-slate-300 mt-3">
                    Lengkapi informasi berikut untuk melakukan pemesanan.
                </p>

            </div>
        </section>

        {{-- KONTEN BOOKING --}}
        <section class="max-w-7xl mx-auto px-5 md:px-8 py-10">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- FORM PEMESANAN --}}
                <div class="lg:col-span-2">

                    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

                        <div class="p-6 border-b border-slate-200">
                            <h2 class="text-xl font-bold text-slate-800">
                                Informasi Pemesan
                            </h2>

                            <p class="text-sm text-slate-500 mt-2">
                                Masukkan data diri dan pilih tiket yang ingin dipesan.
                            </p>
                        </div>

                        <form action="{{ route('booking.store', $show->id) }}"
                              method="POST"
                              class="p-6 space-y-6">

                            @csrf

                            {{-- NAMA --}}
                            <div>
                                <label for="name"
                                       class="block text-sm font-semibold text-slate-700 mb-2">
                                    Nama Lengkap
                                </label>

                                <input
                                    id="name"
                                    name="name"
                                    type="text"
                                    value="{{ old('name') }}"
                                    placeholder="Masukkan nama lengkap"
                                    maxlength="100"
                                    required
                                    class="w-full border border-slate-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >

                                @error('name')
                                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- EMAIL --}}
                            <div>
                                <label for="email"
                                       class="block text-sm font-semibold text-slate-700 mb-2">
                                    Alamat Email
                                </label>

                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    value="{{ old('email') }}"
                                    placeholder="contoh@email.com"
                                    maxlength="150"
                                    required
                                    class="w-full border border-slate-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >

                                @error('email')
                                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- KATEGORI --}}
                            <div>
                                <label for="category"
                                       class="block text-sm font-semibold text-slate-700 mb-2">
                                    Kategori Wisatawan
                                </label>

                                <select
                                    id="category"
                                    name="category"
                                    required
                                    class="w-full border border-slate-300 rounded-lg px-4 py-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                                    <option value="domestic"
                                        {{ old('category', 'domestic') === 'domestic' ? 'selected' : '' }}>
                                        Wisatawan Domestik
                                    </option>

                                    <option value="foreign"
                                        {{ old('category') === 'foreign' ? 'selected' : '' }}>
                                        Wisatawan Mancanegara
                                    </option>

                                </select>

                                @error('category')
                                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- JUMLAH TIKET --}}
                            <div>
                                <label for="quantity"
                                       class="block text-sm font-semibold text-slate-700 mb-2">
                                    Jumlah Tiket
                                </label>

                                <input
                                    id="quantity"
                                    name="quantity"
                                    type="number"
                                    min="1"
                                    max="{{ min(10, max(1, $show->quota)) }}"
                                    value="{{ old('quantity', 1) }}"
                                    required
                                    class="w-full border border-slate-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                >

                                <p class="text-xs text-slate-500 mt-2">
                                    Maksimal 10 tiket per pemesanan dan tidak melebihi kuota tersedia.
                                </p>

                                @error('quantity')
                                    <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- RINGKASAN HARGA --}}
                            <div class="bg-blue-50 border border-blue-100 rounded-xl p-5">

                                <h3 class="font-bold text-slate-800 mb-4">
                                    Ringkasan Pembayaran
                                </h3>

                                <div class="flex justify-between gap-3 text-sm mb-3">
                                    <span class="text-slate-600">Harga per tiket</span>
                                    <span id="unit-price" class="font-semibold text-slate-800">
                                        Rp{{ number_format($show->price_domestic, 0, ',', '.') }}
                                    </span>
                                </div>

                                <div class="flex justify-between gap-3 text-sm mb-4">
                                    <span class="text-slate-600">Jumlah tiket</span>
                                    <span id="ticket-count" class="font-semibold text-slate-800">
                                        {{ old('quantity', 1) }} tiket
                                    </span>
                                </div>

                                <div class="border-t border-blue-200 pt-4 flex justify-between items-center gap-3">
                                    <span class="font-bold text-slate-800">
                                        Total Pembayaran
                                    </span>

                                    <span id="total-price"
                                          class="text-xl font-bold text-blue-700">
                                        Rp{{ number_format($show->price_domestic * old('quantity', 1), 0, ',', '.') }}
                                    </span>
                                </div>

                            </div>

                            {{-- TOMBOL --}}
                            <div class="flex flex-col sm:flex-row gap-3 pt-2">

                                <a href="{{ route('detail', $show->id) }}"
                                   class="flex-1 text-center border border-slate-300 text-slate-700 hover:bg-slate-50 py-3 rounded-lg font-semibold transition">
                                    Batal
                                </a>

                                <button
                                    type="submit"
                                    {{ $show->quota < 1 ? 'disabled' : '' }}
                                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold transition disabled:bg-slate-300 disabled:cursor-not-allowed">
                                    {{ $show->quota < 1 ? 'Tiket Habis' : 'Lanjutkan Pemesanan' }}
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

                {{-- RINGKASAN PERTUNJUKAN --}}
                <div class="lg:col-span-1">

                    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden lg:sticky lg:top-24">

                        {{-- GAMBAR --}}
                        @if (!empty($show->image))

                            <img
                                src="{{ asset('storage/' . $show->image) }}"
                                alt="{{ $show->name }}"
                                class="w-full h-52 object-cover"
                                onerror="this.onerror=null;this.src='https://placehold.co/600x400?text=No+Image';"
                            >

                        @else

                            <div class="w-full h-52 bg-slate-100 flex flex-col items-center justify-center text-slate-400">
                                <span class="text-5xl mb-3">🎭</span>
                                <span class="text-sm">Gambar belum tersedia</span>
                            </div>

                        @endif

                        <div class="p-6">

                            <span class="text-xs font-semibold text-blue-600 uppercase tracking-wide">
                                Pertunjukan Pilihan
                            </span>

                            <h2 class="text-xl font-bold text-slate-800 mt-2">
                                {{ $show->name }}
                            </h2>

                            <div class="space-y-4 mt-5 text-sm">

                                <div class="flex gap-3">
                                    <span>📍</span>
                                    <div>
                                        <p class="text-slate-500">Lokasi</p>
                                        <p class="font-semibold text-slate-800 mt-1">
                                            {{ $show->location }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex gap-3">
                                    <span>📅</span>
                                    <div>
                                        <p class="text-slate-500">Tanggal</p>
                                        <p class="font-semibold text-slate-800 mt-1">
                                            {{ $show->date }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex gap-3">
                                    <span>🕒</span>
                                    <div>
                                        <p class="text-slate-500">Waktu</p>
                                        <p class="font-semibold text-slate-800 mt-1">
                                            {{ $show->time }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex gap-3">
                                    <span>🎟️</span>
                                    <div>
                                        <p class="text-slate-500">Kuota tersedia</p>
                                        <p class="font-semibold text-slate-800 mt-1">
                                            {{ $show->quota }} tiket
                                        </p>
                                    </div>
                                </div>

                            </div>

                            <div class="border-t border-slate-200 mt-6 pt-5">

                                <p class="text-xs text-slate-500">
                                    Harga tiket mulai dari
                                </p>

                                <p class="text-2xl font-bold text-blue-600 mt-1">
                                    Rp{{ number_format(min($show->price_domestic, $show->price_foreign), 0, ',', '.') }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </div>

    {{-- PERHITUNGAN HARGA OTOMATIS --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const category = document.getElementById('category');
            const quantity = document.getElementById('quantity');
            const unitPrice = document.getElementById('unit-price');
            const ticketCount = document.getElementById('ticket-count');
            const totalPrice = document.getElementById('total-price');

            const prices = {
                domestic: {{ (float) $show->price_domestic }},
                foreign: {{ (float) $show->price_foreign }}
            };

            const rupiah = (number) => {
                return 'Rp' + new Intl.NumberFormat('id-ID').format(number);
            };

            function updateTotal() {
                const selectedPrice = prices[category.value];
                const ticketQuantity = Math.max(1, parseInt(quantity.value) || 1);

                unitPrice.textContent = rupiah(selectedPrice);
                ticketCount.textContent = ticketQuantity + ' tiket';
                totalPrice.textContent = rupiah(selectedPrice * ticketQuantity);
            }

            category.addEventListener('change', updateTotal);
            quantity.addEventListener('input', updateTotal);

            updateTotal();
        });
    </script>

</x-home-layout>
