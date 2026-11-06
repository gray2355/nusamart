
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import api from '../services/api';
import toast from 'react-hot-toast';

function Dashboard() {
    const navigate = useNavigate();
    const { logout } = useAuth();

    const handleLogout = async () => {
        try {
            await api.post('/logout');
            toast.success('Logout berhasil!');
        } catch (error) {
            toast.error('Sesi logout tidak dapat dikonfirmasi.');
        } finally {
            logout();
            navigate('/login');
        }
    };

    return (
        <div className="min-h-screen bg-slate-100 flex flex-col md:flex-row">

            {/* Sidebar */}
            <aside className="w-full md:w-64 bg-slate-900 text-white flex flex-col shadow-lg">

                {/* Logo */}
                <div className="p-6 border-b border-slate-700">
                    <div className="flex items-center gap-3">
                        <div className="w-11 h-11 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-lg">
                            NM
                        </div>

                        <div>
                            <h1 className="text-xl font-bold">
                                NusaMart
                            </h1>
                            <p className="text-xs text-slate-400">
                                Admin Panel
                            </p>
                        </div>
                    </div>
                </div>

                {/* Navigasi */}
                <nav className="p-4 flex-1">

                    <p className="text-xs font-semibold text-slate-400 uppercase mb-4 px-3">
                        Menu Utama
                    </p>

                    <button
                        onClick={() => navigate('/dashboard')}
                        className="w-full flex items-center gap-3 px-4 py-3 rounded-lg bg-blue-600 text-white font-semibold mb-2"
                    >
                        <span>▦</span>
                        Dashboard
                    </button>

                    <button
                        onClick={() => navigate('/pertunjukan')}
                        className="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition"
                    >
                        <span>▤</span>
                        Kelola Pertunjukan
                    </button>

                </nav>

                {/* Logout */}
                <div className="p-4 border-t border-slate-700">
                    <button
                        onClick={handleLogout}
                        className="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-red-400 hover:bg-slate-800 hover:text-red-300 transition font-medium"
                    >
                        <span>↪</span>
                        Logout
                    </button>
                </div>

            </aside>

            {/* Konten Utama */}
            <main className="flex-1 p-5 md:p-8">

                {/* Header */}
                <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">

                    <div>
                        <h2 className="text-2xl font-bold text-slate-800">
                            Dashboard
                        </h2>

                        <p className="text-slate-500 text-sm mt-1">
                            Ringkasan pengelolaan NusaMart
                        </p>
                    </div>

                    <div className="flex items-center gap-3 bg-white border border-slate-200 px-4 py-2 rounded-lg shadow-sm">
                        <div className="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold">
                            A
                        </div>

                        <div>
                            <p className="text-sm font-semibold text-slate-800">
                                Administrator
                            </p>
                            <p className="text-xs text-slate-500">
                                Admin NusaMart
                            </p>
                        </div>
                    </div>

                </div>

                {/* Banner Sambutan */}
                <div className="bg-slate-800 rounded-xl p-7 md:p-9 text-white shadow-md mb-8">

                    <p className="text-blue-300 text-sm mb-2">
                        Selamat datang di NusaMart
                    </p>

                    <h1 className="text-2xl md:text-3xl font-bold mb-3">
                        Halo, Admin!
                    </h1>

                    <p className="text-slate-300 text-sm md:text-base max-w-xl leading-relaxed">
                        Kelola pertunjukan budaya Bali dengan mudah melalui
                        halaman administrator NusaMart.
                    </p>

                    <button
                        onClick={() => navigate('/pertunjukan')}
                        className="mt-6 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg font-semibold transition"
                    >
                        Kelola Pertunjukan →
                    </button>

                </div>

                {/* Menu Pengelolaan */}
                <div className="mb-5">
                    <h3 className="text-lg font-bold text-slate-800">
                        Menu Pengelolaan
                    </h3>

                    <p className="text-sm text-slate-500 mt-1">
                        Pilih menu untuk mengelola aplikasi NusaMart.
                    </p>
                </div>

                <div className="grid grid-cols-1 md:grid-cols-2 gap-5">

                    {/* Kartu Pertunjukan */}
                    <div className="bg-white p-6 rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition">

                        <div className="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-2xl mb-4">
                            🎭
                        </div>

                        <h4 className="font-bold text-slate-800 text-lg">
                            Data Pertunjukan
                        </h4>

                        <p className="text-slate-500 text-sm mt-2 mb-5 leading-relaxed">
                            Tambah, lihat, ubah, dan hapus data pertunjukan
                            budaya Bali.
                        </p>

                        <button
                            onClick={() => navigate('/pertunjukan')}
                            className="text-blue-600 font-semibold text-sm hover:text-blue-800 transition"
                        >
                            Buka Data Pertunjukan →
                        </button>

                    </div>

                    {/* Kartu Sistem */}
                    <div className="bg-white p-6 rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition">

                        <div className="w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center text-2xl mb-4">
                            ⚙️
                        </div>

                        <h4 className="font-bold text-slate-800 text-lg">
                            Pengelolaan Sistem
                        </h4>

                        <p className="text-slate-500 text-sm mt-2 mb-5 leading-relaxed">
                            Kelola informasi pertunjukan melalui halaman
                            administrator NusaMart.
                        </p>

                        <button
                            onClick={() => navigate('/pertunjukan')}
                            className="text-blue-600 font-semibold text-sm hover:text-blue-800 transition"
                        >
                            Mulai Mengelola →
                        </button>

                    </div>

                </div>

                {/* Footer */}
                <div className="mt-10 text-center text-sm text-slate-400">
                    NusaMart © 2026 - Platform Pertunjukan Budaya Bali
                </div>

            </main>
        </div>
    );
}

export default Dashboard;
