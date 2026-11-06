
import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { useMutation, useQueryClient } from '@tanstack/react-query';
import toast from 'react-hot-toast';
import api from '../services/api';

function TambahPertunjukan() {
    const navigate = useNavigate();
    const queryClient = useQueryClient();

    const [form, setForm] = useState({
        name: '',
        location: '',
        date: '',
        time: '',
        price_domestic: '',
        price_foreign: '',
        quota: '',
        description: '',
    });

    const [image, setImage] = useState(null);
    const [preview, setPreview] = useState(null);

    // Menambahkan pertunjukan
    const mutation = useMutation({
        mutationFn: async (data) => {
            const formData = new FormData();

            Object.entries(data).forEach(([key, value]) => {
                formData.append(key, value);
            });

            if (image) {
                formData.append('image', image);
            }

            return await api.post('/pertunjukans', formData);
        },

        onSuccess: () => {
            queryClient.invalidateQueries({
                queryKey: ['pertunjukans'],
            });

            toast.success('Pertunjukan berhasil ditambahkan!');
            navigate('/pertunjukan');
        },

        onError: (error) => {
            const errors = error.response?.data?.errors;

            if (errors) {
                toast.error(Object.values(errors)[0][0]);
            } else {
                toast.error(
                    error.response?.data?.message ||
                    'Gagal menambahkan pertunjukan!'
                );
            }
        },
    });

    // Mengubah nilai input
    const handleChange = (e) => {
        setForm({
            ...form,
            [e.target.name]: e.target.value,
        });
    };

    // Memilih gambar
    const handleImageChange = (e) => {
        const file = e.target.files[0];

        if (!file) return;

        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp',
        ];

        if (!allowedTypes.includes(file.type)) {
            toast.error('Format gambar harus JPG, PNG, atau WEBP!');
            e.target.value = '';
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            toast.error('Ukuran gambar maksimal 2 MB!');
            e.target.value = '';
            return;
        }

        setImage(file);
        setPreview(URL.createObjectURL(file));
    };

    // Menyimpan data
    const handleSubmit = (e) => {
        e.preventDefault();

        mutation.mutate({
            ...form,
            price_domestic: Number(form.price_domestic),
            price_foreign: Number(form.price_foreign),
            quota: Number(form.quota),
        });
    };

    const inputClass =
        "w-full border border-slate-300 rounded-lg px-4 py-3 text-sm text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500";

    const labelClass =
        "block text-sm font-semibold text-slate-700 mb-2";

    return (
        <div className="min-h-screen bg-slate-100 flex flex-col md:flex-row">

            {/* Sidebar */}
            <aside className="w-full md:w-64 bg-slate-900 text-white flex flex-col shadow-lg">

                <div className="p-6 border-b border-slate-700">
                    <div className="flex items-center gap-3">
                        <div className="w-11 h-11 bg-blue-600 rounded-lg flex items-center justify-center font-bold text-lg">
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
                        className="w-full text-left px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-800 hover:text-white transition mb-2"
                    >
                        ▦ Dashboard
                    </button>

                    <button
                        onClick={() => navigate('/pertunjukan')}
                        className="w-full text-left px-4 py-3 rounded-lg bg-blue-600 text-white font-semibold"
                    >
                        ▤ Kelola Pertunjukan
                    </button>
                </nav>

                <div className="p-4 border-t border-slate-700">
                    <button
                        onClick={() => navigate('/dashboard')}
                        className="w-full text-left px-4 py-3 rounded-lg text-slate-300 hover:bg-slate-800 transition"
                    >
                        ← Kembali ke Dashboard
                    </button>
                </div>

            </aside>

            {/* Konten Utama */}
            <main className="flex-1 min-w-0 p-5 md:p-8">

                {/* Header */}
                <div className="mb-8">
                    <h2 className="text-2xl font-bold text-slate-800">
                        Tambah Pertunjukan
                    </h2>

                    <p className="text-sm text-slate-500 mt-1">
                        Masukkan informasi pertunjukan budaya Bali yang baru.
                    </p>
                </div>

                {/* Form */}
                <div className="max-w-4xl bg-white border border-slate-200 rounded-xl shadow-sm">

                    <div className="p-5 md:p-7 border-b border-slate-200">
                        <h3 className="text-lg font-bold text-slate-800">
                            Informasi Pertunjukan
                        </h3>

                        <p className="text-sm text-slate-500 mt-1">
                            Lengkapi informasi berikut untuk menambahkan pertunjukan.
                        </p>
                    </div>

                    <form onSubmit={handleSubmit} className="p-5 md:p-7">

                        <div className="grid grid-cols-1 md:grid-cols-2 gap-5">

                            {/* Nama */}
                            <div className="md:col-span-2">
                                <label className={labelClass}>
                                    Nama Pertunjukan
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    value={form.name}
                                    onChange={handleChange}
                                    placeholder="Contoh: Tari Kecak Uluwatu"
                                    className={inputClass}
                                    required
                                />
                            </div>

                            {/* Lokasi */}
                            <div>
                                <label className={labelClass}>
                                    Lokasi
                                </label>

                                <input
                                    type="text"
                                    name="location"
                                    value={form.location}
                                    onChange={handleChange}
                                    placeholder="Contoh: Uluwatu, Bali"
                                    className={inputClass}
                                    required
                                />
                            </div>

                            {/* Tanggal */}
                            <div>
                                <label className={labelClass}>
                                    Tanggal Pertunjukan
                                </label>

                                <input
                                    type="date"
                                    name="date"
                                    value={form.date}
                                    onChange={handleChange}
                                    className={inputClass}
                                    required
                                />
                            </div>

                            {/* Waktu */}
                            <div>
                                <label className={labelClass}>
                                    Waktu Pertunjukan
                                </label>

                                <input
                                    type="time"
                                    name="time"
                                    value={form.time}
                                    onChange={handleChange}
                                    className={inputClass}
                                    required
                                />
                            </div>

                            {/* Kuota */}
                            <div>
                                <label className={labelClass}>
                                    Kuota Tiket
                                </label>

                                <input
                                    type="number"
                                    name="quota"
                                    value={form.quota}
                                    onChange={handleChange}
                                    placeholder="Masukkan jumlah tiket"
                                    min="0"
                                    className={inputClass}
                                    required
                                />
                            </div>

                            {/* Harga Domestik */}
                            <div>
                                <label className={labelClass}>
                                    Harga Domestik (Rp)
                                </label>

                                <input
                                    type="number"
                                    name="price_domestic"
                                    value={form.price_domestic}
                                    onChange={handleChange}
                                    placeholder="Contoh: 150000"
                                    min="0"
                                    className={inputClass}
                                    required
                                />
                            </div>

                            {/* Harga Asing */}
                            <div>
                                <label className={labelClass}>
                                    Harga Wisatawan Asing (Rp)
                                </label>

                                <input
                                    type="number"
                                    name="price_foreign"
                                    value={form.price_foreign}
                                    onChange={handleChange}
                                    placeholder="Contoh: 200000"
                                    min="0"
                                    className={inputClass}
                                    required
                                />
                            </div>

                            {/* Upload Gambar */}
                            <div className="md:col-span-2">
                                <label className={labelClass}>
                                    Gambar Pertunjukan
                                </label>

                                <input
                                    type="file"
                                    accept="image/jpeg,image/png,image/webp"
                                    onChange={handleImageChange}
                                    className={`${inputClass} bg-white`}
                                />

                                <p className="text-xs text-slate-500 mt-2">
                                    Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                                </p>

                                {preview && (
                                    <div className="mt-4">
                                        <p className="text-sm font-medium text-slate-700 mb-2">
                                            Preview Gambar:
                                        </p>

                                        <img
                                            src={preview}
                                            alt="Preview pertunjukan"
                                            className="w-full max-w-sm h-48 object-cover rounded-lg border border-slate-200"
                                        />
                                    </div>
                                )}
                            </div>

                            {/* Deskripsi */}
                            <div className="md:col-span-2">
                                <label className={labelClass}>
                                    Deskripsi Pertunjukan
                                </label>

                                <textarea
                                    name="description"
                                    value={form.description}
                                    onChange={handleChange}
                                    placeholder="Tuliskan deskripsi pertunjukan..."
                                    rows="4"
                                    className={inputClass}
                                    required
                                />
                            </div>

                        </div>

                        {/* Tombol */}
                        <div className="flex flex-col sm:flex-row justify-end gap-3 mt-8 pt-5 border-t border-slate-200">

                            <button
                                type="button"
                                onClick={() => navigate('/pertunjukan')}
                                className="px-5 py-3 rounded-lg border border-slate-300 text-slate-700 font-semibold hover:bg-slate-100 transition"
                            >
                                Batal
                            </button>

                            <button
                                type="submit"
                                disabled={mutation.isPending}
                                className="px-6 py-3 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold transition disabled:opacity-50"
                            >
                                {mutation.isPending
                                    ? 'Menyimpan...'
                                    : 'Simpan Pertunjukan'}
                            </button>

                        </div>

                    </form>
                </div>

                <div className="mt-8 text-center text-sm text-slate-400">
                    NusaMart © 2026 - Platform Pertunjukan Budaya Bali
                </div>

            </main>
        </div>
    );
}

export default TambahPertunjukan;
