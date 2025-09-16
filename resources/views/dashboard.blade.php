@extends('layouts.auth')
@section('title')
    Dashboard - {{ Auth::user()->provider }}
@endsection

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-8">
        <div class="container mx-auto px-4">
            <!-- Header -->
            <div class="mb-8 text-center">
                <h1 class="text-4xl font-bold text-gray-800 mb-2">Welcome Back!</h1>
                <p class="text-gray-600">Manage your account and settings</p>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="grid md:grid-cols-3 gap-6">
                    <!-- Main User Info Card -->
                    <div class="md:col-span-2 bg-white rounded-xl shadow-lg p-8">
                        <div class="flex items-center mb-6">
                            <!-- Avatar -->
                            <div
                                class="w-20 h-20 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-2xl font-bold text-white mr-6">
                                <img src="{{ Auth::user()->avatar }}" alt="">
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">{{ Auth::user()->name }}</h2>
                                <p class="text-gray-600">{{ Auth::user()->email }}</p>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Email Info -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <label class="block text-sm font-medium text-gray-600 mb-1">Email Address</label>
                                <p class="text-gray-800 font-medium">{{ Auth::user()->email }}</p>
                            </div>

                            <!-- Provider Info -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <label class="block text-sm font-medium text-gray-600 mb-1">Login Provider</label>
                                <div class="flex items-center space-x-2">
                                    @php
                                        $providerIcons = [
                                            'google' => '🔍',
                                            'facebook' => '📘',
                                            'github' => '🐙',
                                            'twitter' => '🐦',
                                            'linkedin' => '💼',
                                            'apple' => '🍎',
                                            'discord' => '🎮',
                                            'spotify' => '🎵',
                                        ];
                                        $icon = $providerIcons[strtolower(Auth::user()->provider)] ?? '🔐';
                                    @endphp
                                    <span class="text-xl">{{ $icon }}</span>
                                    <span class="text-gray-800 font-medium capitalize">{{ Auth::user()->provider }}</span>
                                </div>
                            </div>

                            <!-- Member Since -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <label class="block text-sm font-medium text-gray-600 mb-1">Member Since</label>
                                <p class="text-gray-800 font-medium">{{ Auth::user()->created_at->format('M d, Y') }}</p>
                            </div>

                            <!-- Last Updated -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <label class="block text-sm font-medium text-gray-600 mb-1">Last Updated</label>
                                <p class="text-gray-800 font-medium">{{ Auth::user()->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions Sidebar -->
                    <div class="space-y-4">
                        <!-- Account Actions -->
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Account Actions</h3>
                            <div class="space-y-3">
                                <form action="{{ route('logout') }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit"
                                        class="w-full bg-gray-500 text-white px-4 py-3 rounded-lg hover:bg-gray-600 transition-colors font-medium">
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Danger Zone -->
                        <div class="bg-white rounded-xl shadow-lg p-6 border-2 border-red-100">
                            <h3 class="text-lg font-semibold text-red-600 mb-4">⚠️ Danger Zone</h3>
                            <button onclick="openDeleteModal()"
                                class="w-full bg-red-500 text-white px-4 py-3 rounded-lg hover:bg-red-600 transition-colors font-medium">
                                Delete Account
                            </button>
                        </div>

                        <!-- Account Stats -->
                        <div class="bg-white rounded-xl shadow-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Account Stats</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Status</span>
                                    <span class="text-green-500 font-medium">Active</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Verified</span>
                                    <span class="text-green-500">✓</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Two-Factor</span>
                                    <span class="text-gray-400">Disabled</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-8 max-w-md mx-4 transform transition-all">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Delete Account</h3>
                <p class="text-gray-600">This action cannot be undone. All your data will be permanently deleted.</p>
            </div>

            <form action="{{ route('account.delete') }}" method="POST" onsubmit="return confirmDelete()">
                @csrf
                @method('DELETE')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Type "DELETE" to confirm:
                    </label>
                    <input type="text" id="deleteConfirmation" name="confirmation"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500"
                        placeholder="Type DELETE here" required>
                </div>

                <div class="flex space-x-3">
                    <button type="button" onclick="closeDeleteModal()"
                        class="flex-1 bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition-colors font-medium">
                        Cancel
                    </button>
                    <button type="submit" id="deleteButton" disabled
                        class="flex-1 bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors font-medium disabled:bg-gray-300 disabled:cursor-not-allowed">
                        Delete Account
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openDeleteModal() {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteModal').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.getElementById('deleteModal').classList.remove('flex');
            document.body.style.overflow = 'auto';
            document.getElementById('deleteConfirmation').value = '';
            document.getElementById('deleteButton').disabled = true;
        }

        // Enable delete button only when "DELETE" is typed
        document.getElementById('deleteConfirmation').addEventListener('input', function () {
            const deleteButton = document.getElementById('deleteButton');
            if (this.value === 'DELETE') {
                deleteButton.disabled = false;
                deleteButton.classList.remove('disabled:bg-gray-300');
            } else {
                deleteButton.disabled = true;
                deleteButton.classList.add('disabled:bg-gray-300');
            }
        });

        function confirmDelete() {
            return confirm('Are you absolutely sure? This action cannot be undone!');
        }

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function (e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeDeleteModal();
            }
        });
    </script>

    @if(session('success'))
        <div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('error') }}
        </div>
    @endif
@endsection