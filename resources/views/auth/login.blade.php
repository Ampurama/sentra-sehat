<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sentra Sehat | Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            /* Subtle background gradient for a fresh look */
            background-image: linear-gradient(to top right, #e2e8f0, #f8fafc); 
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md mx-auto p-4 sm:p-6 lg:p-8">
        
        {{-- Login Card Container --}}
        <div class="bg-white p-8 sm:p-10 rounded-3xl shadow-2xl border border-gray-100 transform hover:shadow-3xl transition duration-500">
            
            <header class="text-center mb-8">
                <div class="w-16 h-16 mx-auto mb-4 bg-emerald-100 rounded-full flex items-center justify-center">
                    {{-- Icon Sehat (Heartbeat/Tanda Plus) --}}
                    <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                </div>
                <h1 class="text-3xl font-extrabold text-gray-800">Selamat Datang</h1>
                <p class="text-gray-500 mt-2">Masuk ke Dashboard Sistem Sentra Sehat</p>
            </header>

            {{-- Session Status --}}
            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-4 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                {{-- Email Input --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                        class="block w-full px-4 py-3 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 transition duration-150"
                        placeholder="nama@email.com">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password Input --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="block w-full px-4 py-3 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 transition duration-150"
                        placeholder="••••••••">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember Me & Forgot Password --}}
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                            Ingat Saya
                        </label>
                    </div>
                    
                    @if (Route::has('password.request'))
                        <a class="text-sm font-medium text-emerald-600 hover:text-emerald-800 transition duration-150" href="{{ route('password.request') }}">
                            Lupa Password?
                        </a>
                    @endif
                </div>

                {{-- Login Button --}}
                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-lg font-bold text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition duration-300 transform hover:scale-[1.01] active:scale-95">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3v-4a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Masuk
                    </button>
                </div>
            </form>
            
            <footer class="mt-8 text-center text-sm text-gray-400">
                &copy; {{ date('Y') }} Sentra Sehat. Semua hak cipta dilindungi.
            </footer>
        </div>
    </div>

</body>
</html>
