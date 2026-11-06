import React from 'react';
import ReactDOM from 'react-dom/client';


import {
    QueryClient,
    QueryClientProvider
} from '@tanstack/react-query';

import {
    BrowserRouter,
    Routes,
    Route,
    Navigate
} from 'react-router-dom';

import { Toaster } from 'react-hot-toast';

import Login from './pages/Login';
import Dashboard from './pages/Dashboard';
import Pertunjukan from './pages/Pertunjukan';
import TambahPertunjukan from './pages/TambahPertunjukan';
import EditPertunjukan from './pages/EditPertunjukan';
import { AuthProvider, useAuth } from './context/AuthContext';

const queryClient = new QueryClient();

function App() {
    const { token } = useAuth();

    return (
        <BrowserRouter basename="/admin">
            <Routes>

                <Route
                    path="/"
                    element={<Navigate to="/login" replace />}
                />

                <Route
                    path="/login"
                    element={<Login />}
                />

                <Route
                    path="/dashboard"
                    element={
                        token
                            ? <Dashboard />
                            : <Navigate to="/login" replace />
                    }
                />

                <Route
                    path="/pertunjukan"
                    element={
                        token
                            ? <Pertunjukan />
                            : <Navigate to="/login" replace />
                    }
                />

                <Route
                    path="/tambah-pertunjukan"
                    element={
                        token
                            ? <TambahPertunjukan />
                            : <Navigate to="/login" replace />
                    }
                />
                <Route
                    path="/edit-pertunjukan/:id"
                    element={
                        token
                            ? <EditPertunjukan />
                            : <Navigate to="/login" replace />
                    }
                />
            </Routes>
        </BrowserRouter>
    );
}

const rootElement = document.getElementById('react-app');

if (rootElement) {
    ReactDOM.createRoot(rootElement).render(
        <React.StrictMode>
            <QueryClientProvider client={queryClient}>
                <AuthProvider>
                    <Toaster position="top-right" />
                    <App />
                </AuthProvider>
            </QueryClientProvider>
        </React.StrictMode>
    );
}