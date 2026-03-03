<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Admin Dashboard - {{ config('app.name', 'Toko Bunga') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased flex h-screen bg-gray-50 overflow-hidden text-gray-800">

        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-pink-100 flex-shrink-0 flex flex-col h-full hidden md:flex">
            <div class="h-16 flex items-center px-6 border-b border-pink-100">
                <a href="{{ route('admin.dashboard') }}" wire:navigate class="flex items-center gap-2 text-xl font-bold text-pink-500">
                    <x-application-logo class="w-8 h-8 text-pink-500" />
                    Admin Panel
                </a>
            </div>

            <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
                <a href="{{ route('admin.dashboard') }}" wire:navigate class="{{ request()->routeIs('admin.dashboard') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.categories') }}" wire:navigate class="{{ request()->routeIs('admin.categories') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    Kategori Bunga
                </a>
                <a href="{{ route('admin.products') }}" wire:navigate class="{{ request()->routeIs('admin.products') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Produk Bunga
                </a>
                <a href="{{ route('admin.orders') }}" wire:navigate class="{{ request()->routeIs('admin.orders') ? 'sidebar-link-active' : 'sidebar-link' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    Pesanan Masuk
                </a>
            </nav>
            
            <div class="p-4 border-t border-pink-100">
                <a href="{{ route('home') }}" wire:navigate class="flex items-center gap-2 text-sm text-gray-500 hover:text-pink-500 transition px-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Toko
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Topbar -->
            <header class="h-16 bg-white border-b border-pink-100 flex items-center justify-between px-6 flex-shrink-0">
                <div class="md:hidden">
                    <span class="font-bold text-pink-500">Admin</span>
                </div>
                <!-- ... mobile menu toggle omitted for brevity ... -->
                
                <div class="flex items-center gap-4 ml-auto">
                    <!-- Nav items align right -->
                    <div class="text-sm">
                        Halo, <span class="font-semibold text-gray-800">{{ auth()->user()->name ?? 'Admin' }}</span>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-pink-50/30 p-6">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
