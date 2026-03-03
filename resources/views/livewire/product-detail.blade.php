<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Breadcrumb -->
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" wire:navigate class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-pink-600 transition-colors">
                    Beranda
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <a href="{{ route('products.index') }}" wire:navigate class="ms-1 text-sm font-medium text-gray-500 hover:text-pink-600 md:ms-2 transition-colors">Katalog Bunga</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ms-1 text-sm font-medium text-gray-400 md:ms-2">{{ $product->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="bg-white rounded-3xl shadow-lg border border-pink-50 overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-0">
            <!-- Product Image -->
            <div class="relative bg-pink-50 aspect-square md:aspect-auto">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($product->name) }}&background=fdf2f8&color=ec4899&size=800" alt="{{ $product->name }}" class="w-full h-full object-cover">
                @if($product->badge === 'best_seller')
                    <span class="absolute top-6 left-6 bg-gradient-to-r from-pink-500 to-rose-400 text-white text-sm font-bold px-4 py-2 rounded-full shadow-md">Best Seller</span>
                @elseif($product->badge === 'new')
                    <span class="absolute top-6 left-6 bg-green-500 text-white text-sm font-bold px-4 py-2 rounded-full shadow-md">Terbaru</span>
                @endif
            </div>

            <!-- Product Info -->
            <div class="p-8 md:p-12 flex flex-col justify-center">
                <div class="mb-2 text-pink-500 font-bold tracking-wider uppercase text-sm flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    {{ $product->category->name }}
                </div>
                
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">{{ $product->name }}</h1>
                
                <div class="flex items-center mb-6">
                    <div class="flex text-yellow-400 mr-2">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 {{ $i < floor($product->rating) ? 'fill-current' : 'text-gray-300' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        @endfor
                    </div>
                    <span class="text-gray-500 font-medium">({{ $product->rating }}) Reviews</span>
                    <span class="mx-3 text-gray-300">|</span>
                    <span class="text-gray-500 font-medium">Stok: <span class="{{ $product->stock > 0 ? 'text-green-500' : 'text-red-500' }} font-bold">{{ $product->stock }}</span></span>
                </div>

                <div class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-rose-400 mb-8">
                    {{ $product->formatted_price }}
                </div>

                <div class="prose prose-pink text-gray-600 mb-8 border-b border-gray-100 pb-8">
                    <p>{{ $product->description }}</p>
                </div>

                <div class="space-y-6">
                    <!-- Quantity -->
                    @if($product->stock > 0)
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Beli</label>
                            <div class="flex items-center space-x-3">
                                <button wire:click="decrement" type="button" class="w-10 h-10 rounded-xl bg-gray-100 text-gray-600 flex items-center justify-center hover:bg-pink-100 hover:text-pink-600 transition-colors focus:outline-none">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                </button>
                                <input type="number" wire:model.live="quantity" readonly class="w-16 h-10 text-center font-bold text-gray-900 border-none bg-gray-50 rounded-xl focus:ring-0">
                                <button wire:click="increment" type="button" class="w-10 h-10 rounded-xl bg-gray-100 text-gray-600 flex items-center justify-center hover:bg-pink-100 hover:text-pink-600 transition-colors focus:outline-none">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                </button>
                            </div>
                        </div>

                        <!-- Greeting Card -->
                        <div>
                            <label for="greeting" class="block text-sm font-semibold text-gray-700 mb-2">Kartu Ucapan (Opsional)</label>
                            <textarea wire:model.defer="greetingCardText" id="greeting" rows="3" class="input-pink text-sm" placeholder="Tuliskan ucapan Anda di sini..."></textarea>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-4">
                            <button wire:click="addToCart" class="btn-pink-outline flex-1 py-4 text-lg bg-pink-50/50">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                Keranjang
                            </button>
                            <button wire:click="addToCart(true)" class="btn-pink flex-1 py-4 text-lg">
                                Beli Sekarang
                            </button>
                        </div>
                    @else
                        <div class="bg-red-50 border border-red-200 text-red-600 px-6 py-4 rounded-xl flex items-center justify-center gap-3 font-semibold">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Maaf, stok bunga sedang kosong
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="mt-24">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Produk Sejenis</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                    <div class="card-product group relative flex flex-col h-full bg-white">
                        <a href="{{ route('products.show', $related->slug) }}" wire:navigate class="block relative aspect-square overflow-hidden bg-gray-100">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($related->name) }}&background=fdf2f8&color=ec4899&size=400" alt="{{ $related->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                        </a>
                        
                        <div class="p-5 flex flex-col flex-grow">
                            <h3 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-pink-600 transition-colors line-clamp-1">
                                <a href="{{ route('products.show', $related->slug) }}" wire:navigate>{{ $related->name }}</a>
                            </h3>
                            <div class="mt-auto flex items-center justify-between pt-2">
                                <span class="text-lg font-extrabold text-pink-500">{{ $related->formatted_price }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
