<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Toko Bunga') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-800">
        <div class="min-h-screen flex flex-col">
            <livewire:layout.navigation />

            <!-- Page Content -->
            <main class="flex-grow">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-pink-100 py-12 mt-auto">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <div class="col-span-1 md:col-span-2">
                            <h3 class="text-2xl font-bold text-pink-500 mb-4 flex items-center gap-2">
                                <x-application-logo class="w-8 h-8 text-pink-500" />
                                {{ config('app.name', 'Toko Bunga') }}
                            </h3>
                            <p class="text-gray-500 mt-2 max-w-sm">Toko bunga online terpercaya dengan berbagai koleksi karangan bunga segar untuk setiap momen berharga Anda.</p>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-800 mb-4">Layanan</h4>
                            <ul class="space-y-2">
                                <li><a href="{{ route('products.index') }}" wire:navigate class="text-gray-500 hover:text-pink-500 transition">Katalog Bunga</a></li>
                                <li><a href="#" class="text-gray-500 hover:text-pink-500 transition">Pengiriman</a></li>
                                <li><a href="#" class="text-gray-500 hover:text-pink-500 transition">Cara Pesan</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-800 mb-4">Kontak</h4>
                            <ul class="space-y-2">
                                <li class="text-gray-500 flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    0812-3456-7890
                                </li>
                                <li class="text-gray-500 flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    hello@tokobunga.com
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="border-t border-gray-100 mt-10 pt-6 text-center text-gray-400">
                        &copy; {{ date('Y') }} {{ config('app.name', 'Toko Bunga') }}. All rights reserved.
                    </div>
                </div>
            </footer>
        </div>

        <!-- Snap Midtrans Library -->
        @if(isset($withMidtrans) && $withMidtrans)
            <script src="{{ config('midtrans.snap_url') }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
        @endif
    </body>
</html>
