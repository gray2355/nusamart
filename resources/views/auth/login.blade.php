
<x-guest-layout>

    <div class="min-h-screen bg-slate-50 flex items-center justify-center px-5 py-12">

        <div class="w-full max-w-md">

            {{-- KEMBALI KE BERANDA --}}
            <div class="text-center mb-6">
                <a href="{{ route('home') }}"
                   class="text-sm text-slate-500 hover:text-blue-600 transition">
                    ← Kembali ke Beranda
                </a>
            </div>

            {{-- KARTU LOGIN --}}
            <div class="bg-white border border-slate-200 rounded-2xl shadow-lg p-7 md:p-9">

                {{-- LOGO --}}
                <div class="text-center mb-8">

                    <a href="{{ route('home') }}"
                       class="inline-flex items-center justify-center w-14 h-14 bg-blue-600 rounded-xl text-white font-bold text-xl shadow-sm">
                        NM
                    </a>

                    <h1 class="text-2xl font-bold text-slate-800 mt-5">
                        Selamat Datang!
                    </h1>

                    <p class="text-sm text-slate-500 mt-2">
                        Login ke akun NusaMart Anda.
                    </p>

                </div>

                {{-- STATUS SESSION --}}
                <x-auth-session-status
                    class="mb-4"
                    :status="session('status')"
                />

                {{-- VALIDASI ERROR --}}
                <x-auth-validation-errors
                    class="mb-4"
                    :errors="$errors"
                />

                {{-- FORM LOGIN --}}
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    {{-- EMAIL --}}
                    <div>
                        <label for="email"
                               class="block text-sm font-semibold text-slate-700 mb-2">
                            Alamat Email
                        </label>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Masukkan alamat email"
                            required
                            autofocus
                            autocomplete="username"
                            class="w-full border border-slate-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>

                    {{-- PASSWORD --}}
                    <div>
                        <label for="password"
                               class="block text-sm font-semibold text-slate-700 mb-2">
                            Password
                        </label>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="Masukkan password"
                            required
                            autocomplete="current-password"
                            class="w-full border border-slate-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>

                    {{-- REMEMBER ME --}}
                    <div class="flex items-center justify-between gap-3">

                        <label for="remember_me"
                               class="flex items-center gap-2 text-sm text-slate-600">

                            <input
                                id="remember_me"
                                type="checkbox"
                                name="remember"
                                class="rounded border-slate-300 text-blue-600 focus:ring-blue-500"
                            >

                            Ingat saya

                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                                Lupa password?
                            </a>
                        @endif

                    </div>

                    {{-- TOMBOL LOGIN --}}
                    <button
                        type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold transition shadow-sm">
                        Login
                    </button>

                </form>

                {{-- REGISTRASI --}}
                <div class="border-t border-slate-200 mt-7 pt-6 text-center">

                    <p class="text-sm text-slate-500">
                        Belum punya akun?

                        <a href="{{ route('register') }}"
                           class="text-blue-600 hover:text-blue-700 font-semibold">
                            Daftar Sekarang
                        </a>
                    </p>

                </div>

            </div>

            {{-- FOOTER --}}
            <p class="text-center text-xs text-slate-400 mt-7">
                © {{ date('Y') }} NusaMart - Wisata Budaya Bali
            </p>

        </div>

    </div>

</x-guest-layout>
