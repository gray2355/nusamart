
import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import api from '../services/api';
import toast from 'react-hot-toast';

function Login() {
    const navigate = useNavigate();
    const { login } = useAuth();

    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [loading, setLoading] = useState(false);

    const handleLogin = async (e) => {
        e.preventDefault();
        setLoading(true);

        try {
            const response = await api.post('/login', {
                email,
                password,
            });

            login(response.data.token);
            toast.success('Login berhasil!');
            navigate('/dashboard');

        } catch (error) {
            toast.error(
                error.response?.data?.message || 'Login gagal!'
            );
        } finally {
            setLoading(false);
        }
    };

    return (
        <div className="min-h-screen flex items-center justify-center bg-slate-100 px-4 py-8 font-sans">

            <div className="w-full max-w-md bg-white rounded-xl shadow-lg border border-slate-200 p-8">

                <div className="text-center mb-8">
                    <div className="w-16 h-16 mx-auto bg-slate-800 rounded-xl flex items-center justify-center text-white text-2xl font-bold">
                        NM
                    </div>

                    <h1 className="text-2xl font-bold text-slate-800 mt-5">
                        NusaMart Admin
                    </h1>

                    <p className="text-sm text-slate-500 mt-2">
                        Silakan masuk untuk mengelola pertunjukan.
                    </p>
                </div>

                <form onSubmit={handleLogin}>

                    <div className="mb-5">
                        <label className="block text-sm font-semibold text-slate-700 mb-2">
                            Email
                        </label>

                        <input
                            type="email"
                            placeholder="Masukkan email"
                            value={email}
                            onChange={(e) => setEmail(e.target.value)}
                            required
                            className="w-full px-4 py-3 border border-slate-300 rounded-lg text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        />
                    </div>

                    <div className="mb-6">
                        <label className="block text-sm font-semibold text-slate-700 mb-2">
                            Password
                        </label>

                        <input
                            type="password"
                            placeholder="Masukkan password"
                            value={password}
                            onChange={(e) => setPassword(e.target.value)}
                            required
                            className="w-full px-4 py-3 border border-slate-300 rounded-lg text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        />
                    </div>

                    <button
                        type="submit"
                        disabled={loading}
                        className="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition disabled:opacity-60 disabled:cursor-not-allowed"
                    >
                        {loading ? 'Memproses...' : 'Masuk'}
                    </button>

                </form>

                <div className="border-t border-slate-200 mt-8 pt-5 text-center">
                    <p className="text-sm font-semibold text-slate-700">
                        NusaMart
                    </p>

                    <p className="text-xs text-slate-400 mt-1">
                        Platform Pertunjukan Budaya Bali
                    </p>
                </div>

            </div>
        </div>
    );
}

export default Login;
