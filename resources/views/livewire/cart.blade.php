<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-extrabold text-gray-900 mb-8">Keranjang <span class="text-pink-500">Belanja</span></h1>

    @if($carts->isEmpty())
        <div class="bg-white rounded-3xl p-16 text-center shadow-sm border border-pink-50">
            <div class="w-32 h-32 mx-auto bg-pink-50 rounded-full flex items-center justify-center mb-6">
                <svg class="w-16 h-16 text-pink-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Keranjang Masih Kosong</h2>
            <p class="text-gray-500 mb-8 max-w-md mx-auto">Anda belum menambahkan rangkaian bunga ke keranjang belanja. Yuk, pilih bunga spesialmu sekarang!</p>
            <a href="{{ route('products.index') }}" wire:navigate class="btn-pink px-8 py-3">
                Mulai Belanja
            </a>
        </div>
    @else
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Cart Items -->
            <div class="w-full lg:w-2/3 space-y-6">
                @foreach($carts as $cart)
                    <div class="bg-white rounded-2xl shadow-sm border border-pink-50 p-6 flex flex-col sm:flex-row items-center gap-6 relative group transition-all duration-300 hover:shadow-md">
                        <!-- Remove button -->
                        <button wire:click="remove({{ $cart->id }})" class="absolute top-4 right-4 text-gray-300 hover:text-red-500 transition-colors p-2" title="Hapus">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>

                        <!-- Product Image -->
                        <div class="w-full sm:w-32 h-32 flex-shrink-0 bg-gray-50 rounded-xl overflow-hidden">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($cart->product->name) }}&background=fdf2f8&color=ec4899&size=200" alt="{{ $cart->product->name }}" class="w-full h-full object-cover">
                        </div>

                        <!-- Product Summary -->
                        <div class="flex-grow text-center sm:text-left">
                            <a href="{{ route('products.show', $cart->product->slug) }}" wire:navigate class="text-lg font-bold text-gray-800 hover:text-pink-500 transition-colors">{{ $cart->product->name }}</a>
                            <div class="text-sm text-gray-500 mb-4">{{ $cart->product->formatted_price }}</div>
                            
                            @if($cart->greeting_card_text)
                                <div class="bg-pink-50 text-pink-600 text-xs px-3 py-2 rounded-lg mb-4 inline-block">
                                    <span class="font-bold">Kartu:</span> "{{ \Illuminate\Support\Str::limit($cart->greeting_card_text, 30) }}"
                                </div>
                            @endif

                            <div class="flex items-center justify-between sm:justify-start gap-8">
                                <!-- Quantity Control -->
                                <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden">
                                    <button wire:click="decrement({{ $cart->id }})" class="w-8 h-8 flex items-center justify-center bg-gray-50 hover:bg-gray-100 text-gray-600 focus:outline-none transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                    </button>
                                    <div class="w-10 h-8 flex items-center justify-center font-semibold text-gray-800 border-x border-gray-200">
                                        {{ $cart->quantity }}
                                    </div>
                                    <button wire:click="increment({{ $cart->id }})" class="w-8 h-8 flex items-center justify-center bg-gray-50 hover:bg-gray-100 text-gray-600 focus:outline-none transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    </button>
                                </div>

                                <!-- Subtotal per item -->
                                <div class="font-bold text-gray-900 text-right ms-auto">
                                    Rp {{ number_format($cart->subtotal, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Order Summary Sidebar -->
            <div class="w-full lg:w-1/3">
                <div class="bg-white rounded-2xl shadow-sm border border-pink-100 p-6 sticky top-24">
                    <h3 class="text-xl font-bold text-gray-800 mb-6 pb-4 border-b border-gray-100">Ringkasan Belanja</h3>
                    
                    <div class="space-y-4 text-gray-600 mb-6">
                        <div class="flex justify-between items-center">
                            <span>Total Harga ({{ $carts->sum('quantity') }} barang)</span>
                            <span class="font-semibold text-gray-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                            <span>Estimasi Ongkir</span>
                            <span class="font-semibold text-gray-900">Rp {{ number_format($shipping, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center text-lg">
                            <span class="font-bold text-gray-900">Total Tagihan</span>
                            <span class="font-extrabold text-pink-500">Rp {{ number_format($subtotal + $shipping, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <a href="{{ route('checkout') }}" wire:navigate class="btn-pink w-full justify-center">
                        Lanjut ke Pembayaran
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
