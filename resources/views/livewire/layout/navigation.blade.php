<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-white border-b border-pink-100 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" wire:navigate class="flex items-center gap-2">
                        <x-application-logo class="block h-10 w-auto text-pink-500" />
                        <span class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-rose-400 hidden sm:block">
                            {{ config('app.name', 'Toko Bunga') }}
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 lg:flex h-full">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')" wire:navigate>
                        {{ __('Beranda') }}
                    </x-nav-link>
                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')" wire:navigate>
                        {{ __('Katalog Bunga') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Right Side -->
            <div class="hidden lg:flex items-center gap-6">
                <!-- Cart Icon -->
                @auth
                    <livewire:cart-counter />
                @endauth

                <!-- Auth / Profile -->
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-full text-gray-500 bg-pink-50 hover:text-pink-600 focus:outline-none transition ease-in-out duration-150">
                                <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @if(auth()->user()->isAdmin())
                                <x-dropdown-link :href="route('admin.dashboard')" wire:navigate class="text-pink-600 font-medium">
                                    {{ __('Admin Panel') }}
                                </x-dropdown-link>
                                <div class="border-t border-gray-100"></div>
                            @endif

                            <x-dropdown-link :href="route('dashboard')" wire:navigate>
                                {{ __('Dashboard') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('profile')" wire:navigate>
                                {{ __('Profil') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <button wire:click="logout" class="w-full text-start">
                                <x-dropdown-link>
                                    {{ __('Keluar') }}
                                </x-dropdown-link>
                            </button>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" wire:navigate class="text-gray-500 hover:text-pink-500 font-medium transition">Masuk</a>
                        <a href="{{ route('register') }}" wire:navigate class="btn-pink-sm px-5 py-2">Daftar</a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center lg:hidden gap-3">
                @auth
                    <livewire:cart-counter />
                @endauth

                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-pink-50 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" wire:navigate>
                {{ __('Beranda') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')" wire:navigate>
                {{ __('Katalog Bunga') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-pink-100">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                    <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    @if(auth()->user()->isAdmin())
                        <x-responsive-nav-link :href="route('admin.dashboard')" wire:navigate class="text-pink-600 font-medium">
                            {{ __('Admin Panel') }}
                        </x-responsive-nav-link>
                    @endif

                    <x-responsive-nav-link :href="route('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('profile')" wire:navigate>
                        {{ __('Profil') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <button wire:click="logout" class="w-full text-start">
                        <x-responsive-nav-link>
                            {{ __('Keluar') }}
                        </x-responsive-nav-link>
                    </button>
                </div>
            </div>
        @else
            <div class="pt-4 pb-3 border-t border-pink-100 space-y-1">
                <x-responsive-nav-link :href="route('login')" wire:navigate>
                    {{ __('Masuk') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')" wire:navigate class="text-pink-500 font-medium">
                    {{ __('Daftar') }}
                </x-responsive-nav-link>
            </div>
        @endauth
    </div>
</nav>
