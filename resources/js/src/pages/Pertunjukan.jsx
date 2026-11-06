
import { useState } from 'react';
import { useQuery, useMutation, useQueryClient } from '@tanstack/react-query';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import toast from 'react-hot-toast';
import api from '../services/api';

function Pertunjukan() {
    const navigate = useNavigate();
    const queryClient = useQueryClient();
    const { logout } = useAuth();

    const [keyword, setKeyword] = useState('');
    const [search, setSearch] = useState('');
    const [location, setLocation] = useState('');
    const [page, setPage] = useState(1);

    const limit = 5;

    // Mengambil data pertunjukan
    const { data, isLoading, isError } = useQuery({
        queryKey: ['pertunjukans', search, location, page],
        queryFn: async () => {
            const response = await api.get('/pertunjukans', {
                params: {
                    keyword: search,
                    location: location,
                    page: page,
                    limit: limit,
                },
            });

            return response.data;
        },
        placeholderData: (previousData) => previousData,
    });

    // Menghapus pertunjukan
    const hapusMutation = useMutation({
        mutationFn: async (id) => {
            return await api.delete(`/pertunjukans/${id}`);
        },
        onSuccess: () => {
            queryClient.invalidateQueries({
                queryKey: ['pertunjukans'],
            });

            toast.success('Pertunjukan berhasil dihapus!');
        },
        onError: () => {
            toast.error('Gagal menghapus pertunjukan!');
        },
    });

    // Logout admin
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

    // Pencarian
    const handleSearch = () => {
        setPage(1);
        setSearch(keyword);
    };

    // Filter lokasi
    const handleLocation = (value) => {
        setLocation(value);
        setPage(1);
    };

    if (isLoading && !data) {
        return (
            <div className="min-h-screen flex items-center justify-center bg-slate-100">
                <p className="text-slate-600 font-medium">
                    Memuat data pertunjukan...
                </p>
            </div>
        );
    }

    if (isError) {
        return (
            <div className="min-h-screen flex items-center justify-center bg-slate-100">
                <p className="text-red-600 font-medium">
                    Gagal mengambil data pertunjukan.
                </p>
            </div>
        );
    }

    const pertunjukans = data?.data || [];
    const pagination = data?.pagination;

    const locations = [
        ...new Set(pertunjukans.map((item) => item.location))
    ];

    return (
        <div className="min-h-screen bg-slate-100 flex flex-col md:flex-row">

            {/* Sidebar */}
            <aside className="w-full md:w-64 bg-slate-900 text-white flex flex-col shadow-lg">

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

                <nav className="p-4 flex-1">
                    <p className="text-xs font-semibold text-slate-400 uppercase mb-4 px-3">
                        Menu Utama
                    </p>

                    <button
                        onClick={() => navigate('/dashboard')}
                        className="w-full flex items-center gap-3 px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition mb-2"
                    >
                        <span>▦</span>
                        Dashboard
                    </button>

                    <button
                        onClick={() => navigate('/pertunjukan')}
                        className="w-full flex items-center gap-3 px-4 py-3 rounded-lg bg-blue-600 text-white font-semibold"
                    >
                        <span>▤</span>
                        Kelola Pertunjukan
                    </button>
                </nav>

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
            <main className="flex-1 min-w-0 p-5 md:p-8">

                {/* Header */}
                <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                    <div>
                        <h2 className="text-2xl font-bold text-slate-800">
                            Kelola Pertunjukan
                        </h2>

                        <p className="text-sm text-slate-500 mt-1">
                            Kelola daftar pertunjukan budaya Bali.
                        </p>
                    </div>

                    <button
                        onClick={() => navigate('/tambah-pertunjukan')}
                        className="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg font-semibold shadow-sm transition"
                    >
                        + Tambah Pertunjukan
                    </button>
                </div>

                {/* Ringkasan */}
                <div className="bg-white border border-slate-200 rounded-xl p-5 mb-6 shadow-sm">
                    <div className="flex items-center gap-4">
                        <div className="w-12 h-12 bg-blue-100 text-blue-700 rounded-lg flex items-center justify-center text-2xl">
                            🎭
                        </div>

                        <div>
                            <p className="text-sm text-slate-500">
                                Total data pada hasil pencarian
                            </p>

                            <h3 className="text-2xl font-bold text-slate-800">
                                {pagination?.total ?? 0}
                            </h3>
                        </div>
                    </div>
                </div>

                {/* Daftar Pertunjukan */}
                <div className="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

                    {/* Pencarian dan Filter */}
                    <div className="p-5 border-b border-slate-200">
                        <h3 className="text-lg font-bold text-slate-800">
                            Daftar Pertunjukan
                        </h3>

                        <p className="text-sm text-slate-500 mt-1">
                            Cari dan kelola data pertunjukan.
                        </p>

                        <div className="flex flex-col md:flex-row gap-3 mt-5">

                            <input
                                type="text"
                                placeholder="Cari nama atau lokasi..."
                                value={keyword}
                                onChange={(e) => setKeyword(e.target.value)}
                                onKeyDown={(e) => {
                                    if (e.key === 'Enter') handleSearch();
                                }}
                                className="flex-1 border border-slate-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            />

                            <select
                                value={location}
                                onChange={(e) => handleLocation(e.target.value)}
                                className="border border-slate-300 rounded-lg px-4 py-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                            >
                                <option value="">Semua Lokasi</option>

                                {locations.map((item) => (
                                    <option key={item} value={item}>
                                        {item}
                                    </option>
                                ))}
                            </select>

                            <button
                                onClick={handleSearch}
                                className="bg-slate-800 hover:bg-slate-900 text-white px-6 py-3 rounded-lg text-sm font-semibold transition"
                            >
                                Cari
                            </button>

                        </div>
                    </div>

                    {/* Tabel */}
                    <div className="overflow-x-auto">
                        <table className="w-full text-sm text-left">

                            <thead className="bg-slate-50 text-slate-600 uppercase text-xs">
                                <tr>
                                    <th className="px-5 py-4">No</th>
                                    <th className="px-5 py-4">Gambar</th>
                                    <th className="px-5 py-4">Nama Pertunjukan</th>
                                    <th className="px-5 py-4">Lokasi</th>
                                    <th className="px-5 py-4">Harga Domestik</th>
                                    <th className="px-5 py-4">Kuota</th>
                                    <th className="px-5 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody className="divide-y divide-slate-100">

                                {pertunjukans.length > 0 ? (
                                    pertunjukans.map((item, index) => {

                                        const imageUrl = item.image
                                            ? (item.image.startsWith('http')
                                                ? item.image
                                                : `/storage/${item.image}`)
                                            : null;

                                        return (
                                            <tr
                                                key={item.id}
                                                className="hover:bg-slate-50 transition"
                                            >
                                                <td className="px-5 py-4 text-slate-600">
                                                    {(page - 1) * limit + index + 1}
                                                </td>

                                                {/* Gambar */}
                                                <td className="px-5 py-4">
                                                    {imageUrl ? (
                                                        <img
                                                            src={imageUrl}
                                                            alt={item.name}
                                                            className="w-20 h-16 object-cover rounded-lg border border-slate-200"
                                                            onError={(e) => {
                                                                e.currentTarget.style.display = 'none';
                                                            }}
                                                        />
                                                    ) : (
                                                        <div className="w-20 h-16 bg-slate-100 rounded-lg border border-slate-200 flex items-center justify-center text-xs text-slate-400">
                                                            No Image
                                                        </div>
                                                    )}
                                                </td>

                                                <td className="px-5 py-4 font-semibold text-slate-800">
                                                    {item.name}
                                                </td>

                                                <td className="px-5 py-4 text-slate-600">
                                                    {item.location}
                                                </td>

                                                <td className="px-5 py-4 font-medium text-slate-700">
                                                    Rp{Number(item.price_domestic).toLocaleString('id-ID')}
                                                </td>

                                                <td className="px-5 py-4 text-slate-600">
                                                    {item.quota} tiket
                                                </td>

                                                <td className="px-5 py-4">
                                                    <div className="flex justify-center gap-2">
                                                        <button
                                                            onClick={() => navigate(`/edit-pertunjukan/${item.id}`)}
                                                            className="bg-blue-50 text-blue-700 hover:bg-blue-100 px-3 py-2 rounded-md font-medium transition"
                                                        >
                                                            Edit
                                                        </button>

                                                        <button
                                                            onClick={() => {
                                                                if (window.confirm('Apakah kamu yakin ingin menghapus pertunjukan ini?')) {
                                                                    hapusMutation.mutate(item.id);
                                                                }
                                                            }}
                                                            disabled={hapusMutation.isPending}
                                                            className="bg-red-50 text-red-600 hover:bg-red-100 px-3 py-2 rounded-md font-medium transition disabled:opacity-50"
                                                        >
                                                            Hapus
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        );
                                    })
                                ) : (
                                    <tr>
                                        <td
                                            colSpan="7"
                                            className="px-5 py-10 text-center text-slate-500"
                                        >
                                            Tidak ada data pertunjukan.
                                        </td>
                                    </tr>
                                )}

                            </tbody>
                        </table>
                    </div>

                    {/* Pagination */}
                    {pagination && (
                        <div className="flex flex-col sm:flex-row items-center justify-between gap-4 p-5 border-t border-slate-200">

                            <p className="text-sm text-slate-500">
                                Halaman {pagination.current_page} dari {pagination.last_page}
                                {' '}· Total {pagination.total} data
                            </p>

                            <div className="flex gap-2">
                                <button
                                    disabled={page <= 1}
                                    onClick={() => setPage((old) => old - 1)}
                                    className="px-4 py-2 border border-slate-300 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-100 disabled:opacity-40 disabled:cursor-not-allowed"
                                >
                                    Sebelumnya
                                </button>

                                <button
                                    disabled={page >= pagination.last_page}
                                    onClick={() => setPage((old) => old + 1)}
                                    className="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 disabled:opacity-40 disabled:cursor-not-allowed"
                                >
                                    Berikutnya
                                </button>
                            </div>
                        </div>
                    )}

                </div>

                {/* Footer */}
                <div className="mt-8 text-center text-sm text-slate-400">
                    NusaMart © 2026 - Platform Pertunjukan Budaya Bali
                </div>

            </main>
        </div>
    );
}

export default Pertunjukan;
