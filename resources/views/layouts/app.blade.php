<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Social Authentication</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'bounce-slow': 'bounce 2s infinite',
                        'fade-in': 'fadeIn 0.8s ease-in-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'scale-in': 'scaleIn 0.4s ease-out'
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' }
                        },
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(100px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' }
                        },
                        scaleIn: {
                            '0%': { transform: 'scale(0.8)', opacity: '0' },
                            '100%': { transform: 'scale(1)', opacity: '1' }
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .gradient-bg {
            background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #f5576c, #4facfe, #00f2fe);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .social-btn {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .social-btn:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .floating-icons {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .floating-icon {
            position: absolute;
            opacity: 0.1;
            animation: floatRandom 20s linear infinite;
        }

        @keyframes floatRandom {
            0% {
                transform: translateY(100vh) rotate(0deg);
            }

            100% {
                transform: translateY(-100px) rotate(360deg);
            }
        }
    </style>
</head>

<body class="gradient-bg min-h-screen flex items-center justify-center p-4 relative">
    <!-- Floating Background Icons -->
    <div class="floating-icons">
        <div class="floating-icon text-6xl" style="left: 10%; animation-delay: 0s; animation-duration: 25s;">🔐</div>
        <div class="floating-icon text-4xl" style="left: 20%; animation-delay: 3s; animation-duration: 30s;">🌟</div>
        <div class="floating-icon text-5xl" style="left: 70%; animation-delay: 6s; animation-duration: 20s;">✨</div>
        <div class="floating-icon text-3xl" style="left: 80%; animation-delay: 9s; animation-duration: 35s;">🚀</div>
        <div class="floating-icon text-4xl" style="left: 90%; animation-delay: 12s; animation-duration: 25s;">💫</div>
    </div>

    <div class="w-full max-w-md animate-fade-in">
        <!-- Main Auth Card -->
        <div class="glass rounded-3xl p-8 shadow-2xl animate-slide-up">
            <!-- Header -->
            <div class="text-center mb-8 animate-scale-in">
                <div
                    class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-purple-400 to-pink-400 rounded-full flex items-center justify-center animate-pulse-slow">
                    <span class="text-3xl">🔑</span>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Welcome Back</h1>
                <p class="text-gray-200">Choose your preferred sign-in method</p>
            </div>

            <!-- Social Auth Buttons -->
            @yield('content')

            <!-- Divider -->
            <div class="flex items-center my-8">
                <div class="flex-1 border-t border-gray-300"></div>
                <span class="px-4 text-gray-300 text-sm">or</span>
                <div class="flex-1 border-t border-gray-300"></div>
            </div>

            <!-- Traditional Login -->
            <button onclick="toggleTraditionalLogin()"
                class="w-full bg-gradient-to-r from-purple-500 to-pink-500 text-white py-4 px-6 rounded-2xl font-semibold hover:from-purple-600 hover:to-pink-600 transition-all duration-300 transform hover:scale-105 social-btn">
                <span>Sign in with Email</span>
            </button>

            <!-- Traditional Login Form (Hidden by default) -->
            <div id="traditionalLogin" class="hidden mt-6 space-y-4 animate-fade-in">
                <div>
                    <input type="email" placeholder="Email address"
                        class="w-full bg-white/20 border border-white/30 text-white placeholder-gray-300 py-3 px-4 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-400">
                </div>
                <div>
                    <input type="password" placeholder="Password"
                        class="w-full bg-white/20 border border-white/30 text-white placeholder-gray-300 py-3 px-4 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-400">
                </div>
                <button
                    class="w-full bg-white text-gray-800 py-3 px-6 rounded-xl font-semibold hover:bg-gray-100 transition-colors duration-300">
                    Sign In
                </button>
            </div>

            <!-- Footer -->
            <div class="text-center mt-8 text-gray-300 text-sm">
                <p>Don't have an account? <a href="#" class="text-white hover:underline font-semibold">Sign up</a></p>
            </div>
        </div>

        <!-- Security Badge -->
        <div class="text-center mt-6 animate-fade-in" style="animation-delay: 0.8s;">
            <div
                class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-lg rounded-full px-4 py-2 text-white text-sm">
                <svg class="w-4 h-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" />
                </svg>
                <span>Secure Authentication</span>
            </div>
        </div>
    </div>

    <script>
        function handleSocialAuth(provider) {
            // Add loading animation
            event.target.innerHTML = `
                <div class="flex items-center justify-center space-x-3">
                    <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-white"></div>
                    <span>Connecting...</span>
                </div>
            `;

            // Simulate API call
            setTimeout(() => {
                showNotification(`Redirecting to ${provider.charAt(0).toUpperCase() + provider.slice(1)}...`, 'success');

                // Reset button after 2 seconds
                setTimeout(() => {
                    window.location.href = `/auth/${provider}`
                }, 2000);
            }, 1500);
        }

        function toggleTraditionalLogin() {
            const form = document.getElementById('traditionalLogin');
            form.classList.toggle('hidden');
        }

        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 p-4 rounded-lg text-white z-50 animate-fade-in ${type === 'success' ? 'bg-green-500' : 'bg-blue-500'
                }`;
            notification.textContent = message;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function () {
            // Add sparkle effect on hover
            const buttons = document.querySelectorAll('.social-btn');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function () {
                    this.style.boxShadow = '0 0 30px rgba(255, 255, 255, 0.3)';
                });

                button.addEventListener('mouseleave', function () {
                    this.style.boxShadow = '';
                });
            });
        });
    </script>
</body>

</html>