@extends('layouts.guest')

@section('title', 'Login Pasien - Sentra Sehat')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

    body {
        font-family: 'Inter', sans-serif !important;
        background: #0a0a0a !important;
        overflow-x: hidden;
    }

    /* Premium Animated Background */
    .premium-bg {
        background: #0a0a0a;
        position: relative;
        min-height: 100vh;
        overflow: hidden;
    }

    .premium-bg::before {
        content: '';
        position: absolute;
        width: 200%;
        height: 200%;
        background: 
            radial-gradient(circle at 20% 50%, rgba(14, 165, 233, 0.3) 0%, transparent 50%),
            radial-gradient(circle at 80% 50%, rgba(168, 85, 247, 0.3) 0%, transparent 50%);
        animation: bg-shift 10s ease infinite;
    }

    @keyframes bg-shift {
        0%, 100% { transform: translate(0, 0); }
        50% { transform: translate(-10%, -10%); }
    }

    /* Mesh Gradient */
    .mesh-gradient {
        position: absolute;
        inset: 0;
        background: 
            radial-gradient(at 0% 0%, rgba(14, 165, 233, 0.2) 0px, transparent 50%),
            radial-gradient(at 100% 0%, rgba(168, 85, 247, 0.2) 0px, transparent 50%),
            radial-gradient(at 100% 100%, rgba(236, 72, 153, 0.2) 0px, transparent 50%),
            radial-gradient(at 0% 100%, rgba(34, 211, 238, 0.2) 0px, transparent 50%);
        filter: blur(60px);
    }

    /* Grid Pattern */
    .grid-pattern {
        position: absolute;
        inset: 0;
        background-image: 
            linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
        background-size: 50px 50px;
        mask-image: radial-gradient(ellipse 80% 50% at 50% 50%, black 40%, transparent 100%);
    }

    /* Premium Card */
    .premium-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(40px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 
            0 0 0 1px rgba(255, 255, 255, 0.05),
            0 20px 60px rgba(0, 0, 0, 0.5);
        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .premium-card:hover {
        border-color: rgba(255, 255, 255, 0.2);
        box-shadow: 
            0 0 0 1px rgba(255, 255, 255, 0.1),
            0 30px 80px rgba(0, 0, 0, 0.6);
        transform: translateY(-5px);
    }

    /* Gradient Icon */
    .icon-gradient {
        background: linear-gradient(135deg, #0ea5e9, #a855f7);
        position: relative;
    }

    .icon-gradient::before {
        content: '';
        position: absolute;
        inset: -2px;
        background: linear-gradient(135deg, #0ea5e9, #a855f7, #ec4899, #22d3ee);
        border-radius: inherit;
        z-index: -1;
        opacity: 0;
        transition: opacity 0.6s ease;
    }

    .icon-gradient:hover::before {
        opacity: 1;
        animation: rotate-gradient 3s linear infinite;
    }

    @keyframes rotate-gradient {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Modern Input */
    .modern-input {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
        transition: all 0.3s ease;
    }

    .modern-input:focus {
        background: rgba(255, 255, 255, 0.08);
        border-color: rgba(14, 165, 233, 0.5);
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
        transform: translateY(-2px);
        outline: none;
    }

    .modern-input::placeholder {
        color: rgba(255, 255, 255, 0.4);
    }

    /* Premium Button */
    .premium-button {
        background: linear-gradient(135deg, #0ea5e9, #a855f7);
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .premium-button::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, #22d3ee, #ec4899);
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .premium-button:hover::before {
        opacity: 1;
    }

    .premium-button::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s ease, height 0.6s ease;
    }

    .premium-button:hover::after {
        width: 300px;
        height: 300px;
    }

    .premium-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 40px rgba(14, 165, 233, 0.4);
    }

    .premium-button span {
        position: relative;
        z-index: 1;
    }

    /* Floating Animation */
    @keyframes float-smooth {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    .float-animation {
        animation: float-smooth 4s ease-in-out infinite;
    }

    /* Glow Effect */
    .glow-text {
        text-shadow: 0 0 20px rgba(14, 165, 233, 0.5);
    }
</style>

<div class="premium-bg">
    <div class="mesh-gradient"></div>
    <div class="grid-pattern"></div>
    
    <div class="relative z-10 min-h-screen flex items-center justify-center py-16 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-10">
            
            <!-- Header -->
            <div class="text-center float-animation">
                <div class="icon-gradient inline-flex items-center justify-center w-24 h-24 rounded-3xl mb-8 shadow-2xl">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h1 class="text-5xl md:text-6xl font-black text-white mb-4 glow-text">
                    Portal Pasien
                </h1>
                <p class="text-xl text-gray-400 font-medium">
                    Akses riwayat kesehatan Anda dengan aman
                </p>
            </div>

            <!-- Form Card -->
            <div class="premium-card rounded-3xl p-8 sm:p-10">
                <form action="{{ route('patient.login') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- NIK Field -->
                    <div class="space-y-2">
                        <label for="nik" class="block text-sm font-bold text-gray-300 tracking-wide uppercase">
                            NIK
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-500 group-focus-within:text-sky-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                                </svg>
                            </div>
                            <input 
                                id="nik" 
                                name="nik" 
                                type="text" 
                                required 
                                class="modern-input w-full pl-12 pr-4 py-4 rounded-xl text-base font-medium"
                                placeholder="Masukkan 16 digit NIK">
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-2">
                        <label for="password" class="block text-sm font-bold text-gray-300 tracking-wide uppercase">
                            Password
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-500 group-focus-within:text-sky-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input 
                                id="password" 
                                name="password" 
                                type="password" 
                                required 
                                class="modern-input w-full pl-12 pr-4 py-4 rounded-xl text-base font-medium"
                                placeholder="Masukkan password">
                        </div>
                    </div>

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="rounded-xl bg-red-500/10 border border-red-500/20 p-4">
                            <div class="flex items-start gap-3">
                                <svg class="h-5 w-5 text-red-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div class="flex-1">
                                    <h3 class="text-sm font-bold text-red-400 mb-1">
                                        Terjadi kesalahan
                                    </h3>
                                    <ul class="text-sm text-red-300 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <button type="submit" class="premium-button w-full py-4 rounded-xl text-white font-bold text-lg shadow-2xl">
                        <span class="flex items-center justify-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            Masuk
                        </span>
                    </button>

                    <!-- Back Link -->
                    <div class="text-center pt-4">
                        <a href="/" class="inline-flex items-center gap-2 text-sm text-gray-400 hover:text-white font-medium transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke Beranda
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection