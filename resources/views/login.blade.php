<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Admin</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(60px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.92);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out;
        }
        
        .animate-scaleIn {
            animation: scaleIn 0.6s ease-out 0.2s both;
        }
        
        .hover-scale:hover {
            transform: scale(1.02);
        }
        
        .hover-scale:active {
            transform: scale(0.97);
        }
        
        .hover-scale {
            transition: transform 0.2s ease;
        }
    </style>
</head>
<body>
    <section 
        class="animate-fadeInUp relative w-full min-h-screen flex justify-center items-center bg-cover bg-center px-6"
        style="background-image: url('{{ asset('backgroundImg.png') }}')">
        
        <div class="absolute inset-0 bg-white/60 backdrop-blur-md"></div>
        
        <div class="animate-scaleIn relative z-10 w-full max-w-md bg-white/60 backdrop-blur-xl shadow-lg rounded-3xl p-8 border border-white/30">
            
            <h2 class="text-3xl font-semibold text-center mb-8">Login</h2>
            
            <!-- Error message -->
            @if(session('error'))
                <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-full text-center text-sm">
                    {{ session('error') }}
                </div>
            @endif
            
            @if($errors->any())
                <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-full text-center text-sm">
                    {{ $errors->first() }}
                </div>
            @endif
            
            <form action="{{ route('login.submit') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label class="block mb-1 font-medium">Username</label>
                    <input
                        type="text"
                        name="username"
                        class="w-full p-3 rounded-full border bg-white/70 focus:ring-2 focus:ring-[#8B4513] outline-none"
                        placeholder="Enter your username..."
                        value="{{ old('username') }}"
                        required>
                </div>
                
                <div>
                    <label class="block mb-1 font-medium">Password</label>
                    <input
                        type="password"
                        name="password"
                        class="w-full p-3 rounded-full border bg-white/70 focus:ring-2 focus:ring-[#8B4513] outline-none"
                        placeholder="Enter your password..."
                        required>
                </div>
                
                <button
                    type="submit"
                    class="hover-scale w-full py-3 bg-[#8B4513] text-white rounded-full font-medium shadow-md hover:bg-[#6B3410] transition-colors">
                    Login
                </button>
            </form>
        </div>
    </section>
</body>
</html>