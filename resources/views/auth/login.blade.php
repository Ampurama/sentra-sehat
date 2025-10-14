<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sentra Sehat | Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #0a0a0a;
            overflow-x: hidden;
        }

        /* Dark Premium Background */
        .dark-premium-bg {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a2e 50%, #0a0a0a 100%);
            position: relative;
            min-height: 100vh;
        }

        /* Animated Gradient Orbs */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.5;
            animation: float-orb 20s ease-in-out infinite;
        }

        .orb-1 {
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.4) 0%, transparent 70%);
            top: -10%;
            left: -10%;
            animation-delay: 0s;
        }

        .orb-2 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.4) 0%, transparent 70%);
            bottom: -10%;
            right: -10%;
            animation-delay: 7s;
        }

        .orb-3 {
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.4) 0%, transparent 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: 14s;
        }

        @keyframes float-orb {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(50px, -50px) scale(1.1); }
            66% { transform: translate(-30px, 30px) scale(0.9); }
        }

        /* Grid Overlay */
        .grid-overlay {
            position: absolute;
            inset: 0;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
            background-size: 60px 60px;
            mask-image: radial-gradient(ellipse 70% 60% at 50% 50%, black 30%, transparent 100%);
        }

        /* Premium Glass Card */
        .glass-premium {
            background: rgba(255, 255, 255, 0.04);
            backdrop-filter: blur(30px) saturate(150%);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 
                0 0 0 1px rgba(255, 255, 255, 0.04),
                0 25px 70px rgba(0, 0, 0, 0.6);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-premium:hover {
            border-color: rgba(255, 255, 255, 0.15);
            transform: translateY(-8px);
            box-shadow: 
                0 0 0 1px rgba(255, 255, 255, 0.08),
                0 35px 90px rgba(0, 0, 0, 0.7);
        }

        /* Gradient Icon Container */
        .icon-container-premium {
            background: linear-gradient(135deg, #10b981, #3b82f6, #a855f7);
            position: relative;
            overflow: hidden;
        }

        .icon-container-premium::before {
            content: '';
            position: absolute;
            inset: -3px;
            background: linear-gradient(45deg, #10b981, #3b82f6, #a855f7, #ec4899, #10b981);
            background-size: 300% 300%;
            border-radius: inherit;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.6s ease;
            animation: gradient-rotate 4s linear infinite;
        }

        .icon-container-premium:hover::before {
            opacity: 1;
        }

        @keyframes gradient-rotate {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Modern Input Field */
        .input-modern {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .input-modern:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(16, 185, 129, 0.5);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
            transform: translateY(-2px);
        }

        .input-modern::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        /* Checkbox Modern */
        .checkbox-modern {
            appearance: none;
            width: 20px;
            height: 20px;
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .checkbox-modern:checked {
            background: linear-gradient(135deg, #10b981, #3b82f6);
            border-color: transparent;
        }

        .checkbox-modern:checked::after {
            content: '';
            position: absolute;
            left: 6px;
            top: 2px;
            width: 4px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        /* Premium Button */
        .btn-premium {
            background: linear-gradient(135deg, #10b981, #3b82f6);
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-premium::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, #3b82f6, #a855f7);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .btn-premium:hover::before {
            opacity: 1;
        }

        .btn-premium::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.25);
            transform: translate(-50%, -50%);
            transition: width 0.6s ease, height 0.6s ease;
        }

        .btn-premium:hover::after {
            width: 400px;
            height: 400px;
        }

        .btn-premium:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 50px rgba(16, 185, 129, 0.4);
        }

        .btn-premium span {
            position: relative;
            z-index: 1;
        }

        /* Link Hover Effect */
        .link-modern {
            position: relative;
            transition: color 0.3s ease;
        }

        .link-modern::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #10b981, #3b82f6);
            transition: width 0.3s ease;
        }

        .link-modern:hover::after {
            width: 100%;
        }

        /* Glow Text */
        .glow-title {
            text-shadow: 0 0 30px rgba(16, 185, 129, 0.4);
        }

        /* Float Animation */
        @keyframes float-icon {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        .float-icon {
            animation: float-icon 3s ease-in-out infinite;
        }

        /* Pulse Animation */
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 30px rgba(16, 185, 129, 0.4); }
            50% { box-shadow: 0 0 50px rgba(16, 185, 129, 0.7), 0 0 80px rgba(59, 130, 246, 0.5); }
        }

        .pulse-glow {
            animation: pulse-glow 3s ease-in-out infinite;
        }
    </style>
</head>
<body>
    
    <div class="dark-premium-bg">
        <!-- Animated Orbs -->
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
        
        <!-- Grid Overlay -->
        <div class="grid-overlay"></div>

        <div class="relative z-10 flex items-center justify-center min-h-screen px-4 py-16">
            <div class="w-full max-w-md">
                
                <!-- Login Card -->
                <div class="glass-premium rounded-3xl p-10 sm:p-12">
                    
                    <!-- Header -->
                    <header class="text-center mb-10">
                        <div class="icon-container-premium float-icon inline-flex items-center justify-center w-20 h-20 rounded-2xl mb-8 pulse-glow">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <h1 class="text-4xl font-black text-white mb-3 glow-title">
                            Sentra Sehat
                        </h1>
                        <p class="text-gray-400 text-base font-medium">
                            Dashboard Sistem Kesehatan
                        </p>
                    </header>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/20">
                            <div class="flex items-center gap-3 text-green-400 text-sm font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ session('status') }}
                            </div>
                        </div>
                    @endif

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <!-- Role Selection -->
                        <div class="space-y-2">
                            <label for="login_type" class="block text-xs font-bold text-gray-400 tracking-wider uppercase">
                                Login Sebagai
                            </label>
                            <div class="flex gap-4">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="login_type" value="admin" {{ (isset($defaultLoginType) && $defaultLoginType === 'admin') || !isset($defaultLoginType) ? 'checked' : '' }} class="hidden peer" id="admin_radio">
                                    <div class="w-4 h-4 rounded-full border-2 border-gray-400 peer-checked:border-emerald-400 peer-checked:bg-emerald-400 transition-colors"></div>
                                    <span class="text-sm text-gray-400 peer-checked:text-white font-medium">Admin</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="login_type" value="patient" {{ isset($defaultLoginType) && $defaultLoginType === 'patient' ? 'checked' : '' }} class="hidden peer" id="patient_radio">
                                    <div class="w-4 h-4 rounded-full border-2 border-gray-400 peer-checked:border-emerald-400 peer-checked:bg-emerald-400 transition-colors"></div>
                                    <span class="text-sm text-gray-400 peer-checked:text-white font-medium">Pasien</span>
                                </label>
                            </div>
                        </div>

                        <!-- Dynamic Field (Email/NIK) -->
                        <div class="space-y-2">
                            <label for="email" class="block text-xs font-bold text-gray-400 tracking-wider uppercase" id="dynamic-label">
                                Email
                            </label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-500 group-focus-within:text-emerald-400 transition-colors" id="field-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                    class="input-modern w-full pl-12 pr-4 py-4 rounded-xl focus:outline-none text-base font-medium @error('email') border-red-500/50 @enderror @error('nik') border-red-500/50 @enderror"
                                    placeholder="nama@email.com">
                            </div>
                            @error('email')
                                <p class="text-red-400 text-sm mt-2 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                            @error('nik')
                                <p class="text-red-400 text-sm mt-2 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="space-y-2">
                            <label for="password" class="block text-xs font-bold text-gray-400 tracking-wider uppercase">
                                Password
                            </label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-500 group-focus-within:text-emerald-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <input 
                                    id="password" 
                                    type="password" 
                                    name="password" 
                                    required
                                    class="input-modern w-full pl-12 pr-4 py-4 rounded-xl focus:outline-none text-base font-medium @error('password') border-red-500/50 @enderror"
                                    placeholder="••••••••">
                            </div>
                            @error('password')
                                <p class="text-red-400 text-sm mt-2 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Remember & Forgot -->
                        <div class="flex items-center justify-between pt-2">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input 
                                    type="checkbox" 
                                    name="remember" 
                                    id="remember_me"
                                    class="checkbox-modern">
                                <span class="text-sm text-gray-400 group-hover:text-white transition-colors font-medium">
                                    Ingat Saya
                                </span>
                            </label>
                            
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="link-modern text-sm text-gray-400 hover:text-white font-medium">
                                    Lupa Password?
                                </a>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button type="submit" class="btn-premium w-full py-4 rounded-xl text-white font-bold text-lg shadow-2xl">
                                <span class="flex items-center justify-center gap-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                    </svg>
                                    Masuk
                                </span>
                            </button>
                        </div>
                    </form>
                    
                    <!-- Footer -->
                    <footer class="mt-10 text-center">
                        <div class="flex items-center justify-center gap-2 text-xs text-gray-500 font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"></path>
                            </svg>
                            <span>&copy; {{ date('Y') }} Sentra Sehat. Hak cipta dilindungi.</span>
                        </div>
                    </footer>
                </div>

                <!-- Additional Info -->
                <div class="text-center mt-8">
                    <p class="text-gray-500 text-sm font-medium">
                        Sistem Informasi Kesehatan Terpadu
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Handle radio button selection
        const adminRadio = document.getElementById('admin_radio');
        const patientRadio = document.getElementById('patient_radio');

        // Function to update form based on selection
        function updateFormForRole() {
            const isPatient = patientRadio.checked;
            const emailField = document.getElementById('email');
            const emailLabel = document.getElementById('dynamic-label');
            const fieldIcon = document.getElementById('field-icon');

            if (isPatient) {
                // Change to NIK field for patient
                emailField.setAttribute('name', 'nik');
                emailField.setAttribute('type', 'text');
                emailField.setAttribute('placeholder', 'Masukkan 16 digit NIK');
                emailLabel.textContent = 'NIK';
                emailField.value = '';

                // Change icon to ID card icon
                fieldIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>';
            } else {
                // Change back to email field for admin
                emailField.setAttribute('name', 'email');
                emailField.setAttribute('type', 'email');
                emailField.setAttribute('placeholder', 'nama@email.com');
                emailLabel.textContent = 'Email';
                emailField.value = '';

                // Change icon back to email icon
                fieldIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>';
            }
        }

        // Add event listeners to radio buttons
        adminRadio.addEventListener('change', updateFormForRole);
        patientRadio.addEventListener('change', updateFormForRole);

        // Initialize form
        updateFormForRole();

        // Add particle effect on mouse move
        let lastTime = 0;
        const throttleDelay = 50; // milliseconds

        document.addEventListener('mousemove', function(e) {
            const currentTime = Date.now();
            if (currentTime - lastTime < throttleDelay) return;
            lastTime = currentTime;

            const particle = document.createElement('div');
            particle.style.position = 'fixed';
            particle.style.left = e.clientX + 'px';
            particle.style.top = e.clientY + 'px';
            particle.style.width = '3px';
            particle.style.height = '3px';
            particle.style.background = 'rgba(16, 185, 129, 0.6)';
            particle.style.borderRadius = '50%';
            particle.style.pointerEvents = 'none';
            particle.style.zIndex = '9999';
            particle.style.boxShadow = '0 0 10px rgba(16, 185, 129, 0.8)';

            document.body.appendChild(particle);

            // Animate
            let opacity = 1;
            let scale = 1;
            const animate = setInterval(() => {
                opacity -= 0.05;
                scale += 0.05;
                particle.style.opacity = opacity;
                particle.style.transform = `scale(${scale}) translateY(-${20 * (1 - opacity)}px)`;

                if (opacity <= 0) {
                    clearInterval(animate);
                    particle.remove();
                }
            }, 30);
        });

        // Input focus animation
        const inputs = document.querySelectorAll('.input-modern');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
                this.parentElement.style.transition = 'transform 0.3s ease';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Form submission animation
        const form = document.querySelector('form');
        const submitBtn = document.querySelector('.btn-premium');

        form.addEventListener('submit', function() {
            submitBtn.style.transform = 'scale(0.95)';
            submitBtn.style.opacity = '0.7';

            // Create loading spinner
            const spinner = document.createElement('div');
            spinner.innerHTML = `
                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            `;
            submitBtn.querySelector('span').innerHTML = spinner.innerHTML;
        });
    </script>

</body>
</html>