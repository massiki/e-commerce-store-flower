<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        
        <!-- Sidebar Profile -->
        <div class="md:col-span-1">
            <div class="bg-white rounded-3xl shadow-sm border border-pink-50 overflow-hidden sticky top-24">
                <div class="p-6 text-center border-b border-gray-100">
                    <div class="w-24 h-24 mx-auto bg-pink-100 rounded-full flex items-center justify-center text-pink-500 mb-4 overflow-hidden border-4 border-white shadow-md">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=fdf2f8&color=ec4899&size=128" alt="{{ $user->name }}">
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">{{ $user->name }}</h2>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                    
                    <div class="mt-4 flex flex-wrap justify-center gap-2">
                        <span class="bg-pink-50 text-pink-600 text-xs font-semibold px-3 py-1 rounded-full border border-pink-100">
                            {{ $totalOrders }} Pesanan
                        </span>
                        @if($pendingOrders > 0)
                            <span class="bg-yellow-50 text-yellow-600 text-xs font-semibold px-3 py-1 rounded-full border border-yellow-100">
                                {{ $pendingOrders }} Pending
                            </span>
                        @endif
                    </div>
                </div>

                <div class="p-4 space-y-1">
                    <button class="w-full flex items-center px-4 py-3 bg-pink-50 text-pink-600 font-semibold rounded-xl">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        Pesanan Saya
                    </button>
                    <a href="{{ route('wishlist') }}" wire:navigate class="w-full flex items-center px-4 py-3 text-gray-600 hover:text-pink-600 hover:bg-pink-50/50 rounded-xl transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        Wishlist
                    </a>
                    <a href="{{ route('profile') }}" wire:navigate class="w-full flex items-center px-4 py-3 text-gray-600 hover:text-pink-600 hover:bg-pink-50/50 rounded-xl transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Pengaturan Profil
                    </a>
                </div>
            </div>
        </div>

        <!-- Orders Area -->
        <div class="md:col-span-3">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-6">Riwayat <span class="text-pink-500">Pesanan</span></h1>

            <!-- Filters -->
            <div class="flex overflow-x-auto gap-2 mb-6 pb-2 no-scrollbar">
                <button wire:click="setFilter('all')" class="px-5 py-2 rounded-full font-medium whitespace-nowrap transition-colors border {{ $filterStatus === 'all' ? 'bg-gray-800 text-white border-gray-800' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">
                    Semua
                </button>
                <button wire:click="setFilter('pending')" class="px-5 py-2 rounded-full font-medium whitespace-nowrap transition-colors border {{ $filterStatus === 'pending' ? 'bg-yellow-500 text-white border-yellow-500' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">
                    Menunggu Pembayaran
                </button>
                <button wire:click="setFilter('processing')" class="px-5 py-2 rounded-full font-medium whitespace-nowrap transition-colors border {{ $filterStatus === 'processing' ? 'bg-blue-500 text-white border-blue-500' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">
                    Diproses
                </button>
                <button wire:click="setFilter('completed')" class="px-5 py-2 rounded-full font-medium whitespace-nowrap transition-colors border {{ $filterStatus === 'completed' ? 'bg-green-500 text-white border-green-500' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">
                    Selesai
                </button>
                <button wire:click="setFilter('cancelled')" class="px-5 py-2 rounded-full font-medium whitespace-nowrap transition-colors border {{ $filterStatus === 'cancelled' ? 'bg-red-500 text-white border-red-500' : 'bg-white text-gray-600 border-gray-200 hover:bg-gray-50' }}">
                    Dibatalkan
                </button>
            </div>

            <!-- Orders List -->
            <div class="space-y-6">
                @forelse($orders as $order)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="bg-gray-50 px-6 py-4 flex flex-col sm:flex-row justify-between items-start sm:items-center border-b border-gray-100 gap-4">
                            <div>
                                <div class="text-sm font-bold text-gray-700">{{ $order->order_number }}</div>
                                <div class="text-xs text-gray-500">{{ $order->created_at->format('d M Y, H:i') }}</div>
                            </div>
                            <div class="flex flex-col sm:items-end gap-1">
                                {!! $order->status_badge !!}
                                <div class="text-xl font-extrabold text-pink-500">{{ $order->formatted_total }}</div>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 pb-6 border-b border-gray-50">
                                <div>
                                    <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Produk Dibeli:</h4>
                                    @foreach($order->items as $item)
                                        <div class="flex justify-between items-center mb-2">
                                            <div class="text-sm font-medium text-gray-800">{{ $item->quantity }}x {{ $item->product_name }}</div>
                                            <div class="text-sm text-gray-500">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="bg-pink-50/50 p-4 rounded-xl">
                                    <h4 class="text-xs font-bold text-pink-500 uppercase tracking-wider mb-2">Info Pengiriman:</h4>
                                    <p class="text-sm text-gray-800 font-medium">{{ $order->name }} ({{ $order->phone }})</p>
                                    <p class="text-sm text-gray-600">{{ $order->address }}</p>
                                    @if($order->notes)
                                        <p class="text-xs text-gray-500 mt-2 bg-white px-3 py-2 rounded-lg border border-pink-100">📝 "{{ $order->notes }}"</p>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Action Buttons based on status -->
                            <div class="flex justify-end gap-3">
                                <button class="btn-pink-outline px-4 py-2 text-sm shadow-sm">
                                    Detail Invoice
                                </button>
                                
                                @if($order->status === 'pending')
                                    <!-- Using inline Midtrans handler here or redirecting to payment page -->
                                    <button wire:click="cancelOrder({{ $order->id }})" wire:confirm="Yakin ingin membatalkan pesanan ini?" class="px-4 py-2 bg-red-50 text-red-600 font-bold rounded-xl border border-red-100 hover:bg-red-500 hover:text-white hover:border-red-500 transition-colors text-sm shadow-sm">
                                        Batalkan
                                    </button>
                                    <!-- In a real world app, this would trigger midtrans again. For simplicity, we just provide the instruction to check email or use the previous popup -->
                                @endif

                                @if($order->status === 'completed' || $order->status === 'cancelled')
                                    <a href="{{ route('products.index') }}" wire:navigate class="btn-pink px-4 py-2 text-sm shadow-sm">
                                        Pesan Lagi
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-3xl p-16 text-center shadow-sm border border-gray-100">
                        <div class="w-24 h-24 mx-auto bg-gray-50 rounded-full flex items-center justify-center mb-6 text-gray-300">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Pesanan</h3>
                        <p class="text-gray-500 mb-6">Anda belum memiliki riwayat pesanan dengan status "{{ $filterStatus }}".</p>
                        <a href="{{ route('products.index') }}" wire:navigate class="btn-pink-outline px-6 py-2">
                            Mulai Belanja
                        </a>
                    </div>
                @endforelse

                <div class="mt-8">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
