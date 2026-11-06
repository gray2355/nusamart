
import { useEffect, useState } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import { useQuery, useMutation, useQueryClient } from '@tanstack/react-query';
import toast from 'react-hot-toast';
import api from '../services/api';

function EditPertunjukan() {
    const { id } = useParams();
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
    const [preview, setPreview] = useState('');

    // Mengambil data pertunjukan
    const { data, isLoading, isError } = useQuery({
        queryKey: ['pertunjukan', id],
        queryFn: async () => {
            const response = await api.get(`/pertunjukans/${id}`);
            return response.data.data;
        },
    });

    // Menampilkan data lama pada form
    useEffect(() => {
        if (data) {
            setForm({
                name: data.name || '',
                location: data.location || '',
                date: data.date ? data.date.substring(0, 10) : '',
                time: data.time ? data.time.substring(0, 5) : '',
                price_domestic: data.price_domestic ?? '',
                price_foreign: data.price_foreign ?? '',
                quota: data.quota ?? '',
                description: data.description || '',
            });

            if (data.image) {
                let imageUrl = data.image;

                if (!imageUrl.startsWith('http')) {
                    imageUrl = imageUrl.startsWith('/storage/')
                        ? imageUrl
                        : imageUrl.startsWith('storage/')
                            ? `/${imageUrl}`
                            : `/storage/${imageUrl}`;
                }

                setPreview(imageUrl);
            }
        }
    }, [data]);

    // Memperbarui data pertunjukan
    const mutation = useMutation({
        mutationFn: async () => {
            const formData = new FormData();

            Object.entries(form).forEach(([key, value]) => {
                formData.append(key, value);
            });

            if (image) {
                formData.append('image', image);
            }

            // Method spoofing agar Laravel dapat memproses upload gambar
            formData.append('_method', 'PUT');

            return await api.post(
                `/pertunjukans/${id}`,
                formData
            );
        },

        onSuccess: () => {
            queryClient.invalidateQueries({
                queryKey: ['pertunjukans'],
            });

            queryClient.invalidateQueries({
                queryKey: ['pertunjukan', id],
            });

            toast.success('Pertunjukan berhasil diperbarui!');
            navigate('/pertunjukan');
        },

        onError: (error) => {
            const errors = error.response?.data?.errors;

            if (errors) {
                toast.error(Object.values(errors)[0][0]);
            } else {
                toast.error(
                    error.response?.data?.message ||
                    'Gagal memperbarui pertunjukan!'
                );
            }
        },
    });

    // Mengubah input form
    const handleChange = (e) => {
        const { name, value } = e.target;

        setForm((previous) => ({
            ...previous,
            [name]: value,
        }));
    };

    // Memilih gambar baru
    const handleImageChange = (e) => {
        const selectedImage = e.target.files[0];

        if (!selectedImage) return;

        const allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp',
        ];

        if (!allowedTypes.includes(selectedImage.type)) {
            toast.error('Format gambar harus JPG, JPEG, PNG, atau WEBP!');
            e.target.value = '';
            return;
        }

        if (selectedImage.size > 2 * 1024 * 1024) {
            toast.error('Ukuran gambar maksimal 2 MB!');
            e.target.value = '';
            return;
        }

        setImage(selectedImage);
        setPreview(URL.createObjectURL(selectedImage));
    };

    // Mengirim form
    const handleSubmit = (e) => {
        e.preventDefault();
        mutation.mutate();
    };

    if (isLoading) {
        return (
            <div className="min-h-screen flex items-center justify-center bg-slate-100">
                <p className="text-slate-600 font-medium">
                    Memuat data pertunjukan...
                </p>
            </div>
        );
    }

    if (isError || !data) {
        return (
            <div className="min-h-screen flex items-center justify-center bg-slate-100">
                <div className="bg-white p-8 rounded-xl shadow-sm text-center">
                    <p className="text-red-600 font-medium mb-4">
                        Gagal mengambil data pertunjukan.
                    </p>
                    <button
                        onClick={() => navigate('/pertunjukan')}
                        className="bg-blue-600 text-white px-5 py-2 rounded-lg"
                    >
                        Kembali
                    </button>
                </div>
            </div>
        );
    }

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

            </aside>

            {/* Konten Utama */}
            <main className="flex-1 min-w-0 p-5 md:p-8">

                {/* Header */}
                <div className="mb-8">
                    <h2 className="text-2xl font-bold text-slate-800">
                        Edit Pertunjukan
                    </h2>

                    <p className="text-sm text-slate-500 mt-1">
                        Perbarui informasi pertunjukan budaya Bali.
                    </p>
                </div>

                {/* Form */}
                <div className="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden max-w-5xl">

                    <div className="p-6 border-b border-slate-200">
                        <h3 className="text-lg font-bold text-slate-800">
                            Informasi Pertunjukan
                        </h3>

                        <p className="text-sm text-slate-500 mt-1">
                            Ubah informasi pertunjukan sesuai kebutuhan.
                        </p>
                    </div>

                    <form onSubmit={handleSubmit}>

                        <div className="p-6 space-y-6">

                            {/* Nama */}
                            <div>
                                <label className="block text-sm font-semibold text-slate-700 mb-2">
                                    Nama Pertunjukan
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    value={form.name}
                                    onChange={handleChange}
                                    placeholder="Contoh: Tari Kecak Uluwatu"
                                    required
                                    className="w-full border border-slate-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                />
                            </div>

                            {/* Lokasi dan Tanggal */}
                            <div className="grid grid-cols-1 md:grid-cols-2 gap-5">

                                <div>
                                    <label className="block text-sm font-semibold text-slate-700 mb-2">
                                        Lokasi
                                    </label>

                                    <input
                                        type="text"
                                        name="location"
                                        value={form.location}
                                        onChange={handleChange}
                                        placeholder="Contoh: Uluwatu, Bali"
                                        required
                                        className="w-full border border-slate-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    />
                                </div>

                                <div>
                                    <label className="block text-sm font-semibold text-slate-700 mb-2">
                                        Tanggal Pertunjukan
                                    </label>

                                    <input
                                        type="date"
                                        name="date"
                                        value={form.date}
                                        onChange={handleChange}
                                        required
                                        className="w-full border border-slate-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    />
                                </div>

                            </div>

                            {/* Waktu dan Kuota */}
                            <div className="grid grid-cols-1 md:grid-cols-2 gap-5">

                                <div>
                                    <label className="block text-sm font-semibold text-slate-700 mb-2">
                                        Waktu Pertunjukan
                                    </label>

                                    <input
                                        type="time"
                                        name="time"
                                        value={form.time}
                                        onChange={handleChange}
                                        required
                                        className="w-full border border-slate-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    />
                                </div>

                                <div>
                                    <label className="block text-sm font-semibold text-slate-700 mb-2">
                                        Kuota Tiket
                                    </label>

                                    <input
                                        type="number"
                                        name="quota"
                                        value={form.quota}
                                        onChange={handleChange}
                                        min="1"
                                        placeholder="Masukkan jumlah tiket"
                                        required
                                        className="w-full border border-slate-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    />
                                </div>

                            </div>

                            {/* Harga */}
                            <div className="grid grid-cols-1 md:grid-cols-2 gap-5">

                                <div>
                                    <label className="block text-sm font-semibold text-slate-700 mb-2">
                                        Harga Domestik (Rp)
                                    </label>

                                    <input
                                        type="number"
                                        name="price_domestic"
                                        value={form.price_domestic}
                                        onChange={handleChange}
                                        min="0"
                                        required
                                        className="w-full border border-slate-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    />
                                </div>

                                <div>
                                    <label className="block text-sm font-semibold text-slate-700 mb-2">
                                        Harga Wisatawan Asing (Rp)
                                    </label>

                                    <input
                                        type="number"
                                        name="price_foreign"
                                        value={form.price_foreign}
                                        onChange={handleChange}
                                        min="0"
                                        required
                                        className="w-full border border-slate-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    />
                                </div>

                            </div>

                            {/* Gambar */}
                            <div>
                                <label className="block text-sm font-semibold text-slate-700 mb-2">
                                    Gambar Pertunjukan
                                </label>

                                {preview && (
                                    <div className="mb-4">
                                        <p className="text-sm text-slate-500 mb-2">
                                            Preview gambar saat ini:
                                        </p>

                                        <img
                                            src={preview}
                                            alt="Preview pertunjukan"
                                            className="w-full max-w-sm h-52 object-cover rounded-lg border border-slate-200"
                                        />
                                    </div>
                                )}

                                <input
                                    type="file"
                                    accept="image/jpeg,image/png,image/webp"
                                    onChange={handleImageChange}
                                    className="w-full border border-slate-300 rounded-lg px-4 py-3 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-blue-50 file:text-blue-700 file:font-semibold hover:file:bg-blue-100"
                                />

                                <p className="text-xs text-slate-500 mt-2">
                                    Pilih gambar baru jika ingin mengganti gambar lama.
                                    Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                                </p>
                            </div>

                            {/* Deskripsi */}
                            <div>
                                <label className="block text-sm font-semibold text-slate-700 mb-2">
                                    Deskripsi Pertunjukan
                                </label>

                                <textarea
                                    name="description"
                                    value={form.description}
                                    onChange={handleChange}
                                    rows="5"
                                    placeholder="Masukkan deskripsi pertunjukan..."
                                    required
                                    className="w-full border border-slate-300 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-y"
                                />
                            </div>

                        </div>

                        {/* Tombol */}
                        <div className="p-6 border-t border-slate-200 bg-slate-50 flex flex-col sm:flex-row justify-end gap-3">

                            <button
                                type="button"
                                onClick={() => navigate('/pertunjukan')}
                                className="px-6 py-3 border border-slate-300 rounded-lg text-slate-700 font-semibold hover:bg-slate-100 transition"
                            >
                                Batal
                            </button>

                            <button
                                type="submit"
                                disabled={mutation.isPending}
                                className="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold shadow-sm transition disabled:opacity-50"
                            >
                                {mutation.isPending
                                    ? 'Menyimpan Perubahan...'
                                    : 'Simpan Perubahan'}
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

export default EditPertunjukan;
