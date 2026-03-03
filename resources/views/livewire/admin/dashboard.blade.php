<div>
    <h1 class="text-3xl font-extrabold text-gray-900 mb-8">Ikhtisar <span class="text-pink-500">Toko</span></h1>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Revenue -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-pink-50 relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-pink-50 rounded-full group-hover:bg-pink-100 transition-colors z-0"></div>
            <div class="relative z-10">
                <div class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Total Pendapatan</div>
                <div class="text-2xl font-extrabold text-gray-900 mb-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                <div class="text-sm text-green-500 font-medium flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    Pendapatan Hari Ini: Rp {{ number_format($todayRevenue, 0, ',', '.') }}
                </div>
            </div>
        </div>

        <!-- Orders -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-pink-50 relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-50 rounded-full group-hover:bg-blue-100 transition-colors z-0"></div>
            <div class="relative z-10">
                <div class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Total Pesanan</div>
                <div class="text-3xl font-extrabold text-gray-900 mb-1">{{ number_format($totalOrders) }}</div>
                <div class="text-sm text-yellow-500 font-medium flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ $pendingOrders }} Pesanan perlu diproses
                </div>
            </div>
        </div>

        <!-- Products -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-pink-50 relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-green-50 rounded-full group-hover:bg-green-100 transition-colors z-0"></div>
            <div class="relative z-10">
                <div class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Produk Aktif</div>
                <div class="text-3xl font-extrabold text-gray-900 mb-1">{{ number_format($totalProducts) }}</div>
                <div class="text-sm text-gray-500 font-medium">Bunga dalam katalog</div>
            </div>
        </div>

        <!-- Users -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-pink-50 relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-purple-50 rounded-full group-hover:bg-purple-100 transition-colors z-0"></div>
            <div class="relative z-10">
                <div class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Pelanggan</div>
                <div class="text-3xl font-extrabold text-gray-900 mb-1">{{ number_format($totalUsers) }}</div>
                <div class="text-sm text-gray-500 font-medium">Pengguna terdaftar</div>
            </div>
        </div>
    </div>

    <!-- Recent Orders & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Recent Orders Table -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-pink-50 overflow-hidden">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                <h2 class="text-lg font-bold text-gray-800">Pesanan Masuk Terbaru</h2>
                <a href="{{ route('admin.orders') }}" wire:navigate class="text-sm font-semibold text-pink-500 hover:text-pink-600">Lihat Semua</a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b border-gray-100">
                            <th class="p-4 font-semibold">Order ID</th>
                            <th class="p-4 font-semibold">Pelanggan</th>
                            <th class="p-4 font-semibold">Total</th>
                            <th class="p-4 font-semibold">Status</th>
                            <th class="p-4 font-semibold text-right">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @forelse($recentOrders as $order)
                            <tr class="hover:bg-pink-50/30 transition-colors">
                                <td class="p-4 font-bold text-gray-800">{{ $order->order_number }}</td>
                                <td class="p-4">
                                    <div class="font-semibold text-gray-800">{{ $order->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $order->email }}</div>
                                </td>
                                <td class="p-4 font-bold text-pink-500 text-nowrap whitespace-nowrap">{{ $order->formatted_total }}</td>
                                <td class="p-4 whitespace-nowrap">
                                    {!! $order->status_badge !!}
                                </td>
                                <td class="p-4 text-right text-gray-500 text-xs">{{ $order->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-gray-500">Belum ada pesanan yang masuk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quick Actions & Alerts -->
        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-pink-50 p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100">Aksi Cepat</h2>
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('admin.products') }}" wire:navigate class="flex flex-col items-center justify-center p-4 bg-pink-50 rounded-xl hover:bg-pink-100 transition-colors group">
                        <div class="w-10 h-10 rounded-full bg-white text-pink-500 flex items-center justify-center mb-2 shadow-sm group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-gray-700">Tambah Produk</span>
                    </a>
                    
                    <a href="{{ route('admin.orders') }}" wire:navigate class="flex flex-col items-center justify-center p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition-colors group">
                        <div class="w-10 h-10 rounded-full bg-white text-blue-500 flex items-center justify-center mb-2 shadow-sm group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-gray-700 text-center">Proses Pesanan</span>
                    </a>
                </div>
            </div>

            @if($pendingOrders > 0)
                <div class="bg-yellow-50 rounded-2xl border border-yellow-200 p-5 flex items-start gap-4">
                    <div class="flex-shrink-0 mt-1">
                        <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-yellow-800">Perhatian!</h4>
                        <p class="text-xs text-yellow-700 mt-1">Ada <strong>{{ $pendingOrders }} pesanan</strong> yang perlu segera diproses pengirimannya. Segera periksa menu Pesanan Masuk.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
