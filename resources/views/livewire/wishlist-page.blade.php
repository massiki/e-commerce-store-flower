<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        
        <!-- Sidebar Profile (Same as Dashboard for consistency) -->
        <div class="md:col-span-1">
            <div class="bg-white rounded-3xl shadow-sm border border-pink-50 overflow-hidden sticky top-24">
                <div class="p-6 text-center border-b border-gray-100">
                    <div class="w-24 h-24 mx-auto bg-pink-100 rounded-full flex items-center justify-center text-pink-500 mb-4 overflow-hidden border-4 border-white shadow-md">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=fdf2f8&color=ec4899&size=128" alt="{{ $user->name }}">
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">{{ $user->name }}</h2>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                </div>

                <div class="p-4 space-y-1">
                    <a href="{{ route('dashboard') }}" wire:navigate class="w-full flex items-center px-4 py-3 text-gray-600 hover:text-pink-600 hover:bg-pink-50/50 rounded-xl transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Pesanan Saya
                    </a>
                    <button class="w-full flex items-center px-4 py-3 bg-pink-50 text-pink-600 font-semibold rounded-xl">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        Wishlist
                    </button>
                    <a href="{{ route('profile') }}" wire:navigate class="w-full flex items-center px-4 py-3 text-gray-600 hover:text-pink-600 hover:bg-pink-50/50 rounded-xl transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Pengaturan Profil
                    </a>
                </div>
            </div>
        </div>

        <!-- Wishlist Area -->
        <div class="md:col-span-3">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-8">Bunga <span class="text-pink-500">Favoritku</span></h1>

            @if($wishlists->isEmpty())
                <div class="bg-white rounded-3xl p-16 text-center shadow-sm border border-gray-100">
                    <div class="w-24 h-24 mx-auto bg-pink-50 rounded-full flex items-center justify-center mb-6 text-pink-300">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Wishlist</h3>
                    <p class="text-gray-500 mb-6">Kamu belum menambahkan satupun bunga ke daftar favoritmu.</p>
                    <a href="{{ route('products.index') }}" wire:navigate class="btn-pink-outline px-6 py-2">
                        Jelajahi Bunga
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($wishlists as $item)
                        <div class="card-product group relative flex flex-col h-full bg-white transition-opacity duration-300" wire:key="wishlist-{{ $item->id }}">
                            <button wire:click="remove({{ $item->id }})" class="absolute top-4 right-4 z-20 w-8 h-8 flex items-center justify-center rounded-full bg-white/80 backdrop-blur-sm text-red-500 hover:bg-red-500 hover:text-white transition-colors shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>

                            <a href="{{ route('products.show', $item->product->slug) }}" wire:navigate class="block relative aspect-square overflow-hidden bg-gray-100 rounded-t-2xl">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($item->product->name) }}&background=fdf2f8&color=ec4899&size=400" alt="{{ $item->product->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                            </a>
                            
                            <div class="p-5 flex flex-col flex-grow">
                                <h3 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-pink-600 transition-colors line-clamp-1">
                                    <a href="{{ route('products.show', $item->product->slug) }}" wire:navigate>{{ $item->product->name }}</a>
                                </h3>
                                
                                <div class="flex items-center justify-between mt-auto pt-4">
                                    <span class="text-xl font-extrabold text-pink-500">{{ $item->product->formatted_price }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
