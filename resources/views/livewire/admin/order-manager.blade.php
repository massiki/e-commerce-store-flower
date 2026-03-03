<div>
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900">Pesanan <span class="text-pink-500">Masuk</span></h1>
        
        <div class="flex items-center gap-4 w-full sm:w-auto">
            <div class="relative flex-grow sm:flex-grow-0">
                <input type="text" wire:model.live.debounce.500ms="search" class="input-pink pl-10 w-full sm:w-64" placeholder="Cari No. Order / Nama...">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </div>
            <select wire:model.live="statusFilter" class="input-pink w-full sm:w-auto font-semibold">
                <option value="all">Semua Status</option>
                <option value="pending">Menunggu Bayar @if($countPending > 0) ({{ $countPending }}) @endif</option>
                <option value="processing">Diproses @if($countProcessing > 0) ({{ $countProcessing }}) @endif</option>
                <option value="completed">Selesai</option>
                <option value="cancelled">Dibatalkan</option>
            </select>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden relative">
        <div wire:loading.delay class="absolute inset-0 bg-white/50 backdrop-blur-sm z-10 flex items-center justify-center">
            <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-pink-500"></div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b border-gray-100">
                        <th class="p-4 font-semibold w-24">No. Order</th>
                        <th class="p-4 font-semibold">Pemesan</th>
                        <th class="p-4 font-semibold">Informasi Produk</th>
                        <th class="p-4 font-semibold">Total Nilai</th>
                        <th class="p-4 font-semibold text-center">Status Pembayaran</th>
                        <th class="p-4 font-semibold text-center">Aksi Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($orders as $order)
                        <tr class="hover:bg-pink-50/30 transition-colors">
                            <td class="p-4">
                                <span class="font-bold text-gray-800 break-words">{{ $order->order_number }}</span>
                                <div class="text-xs text-gray-500 mt-1">{{ $order->created_at->format('d/m/Y H:i') }}</div>
                            </td>
                            <td class="p-4">
                                <div class="font-bold text-gray-800">{{ $order->name }}</div>
                                <div class="text-xs text-gray-500 flex items-center gap-1 mt-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    {{ $order->phone }}
                                </div>
                            </td>
                            <td class="p-4 text-xs">
                                <ul class="list-disc pl-4 space-y-1 text-gray-600">
                                    @foreach($order->items as $item)
                                        <li>{{ $item->quantity }}x <span class="font-medium text-gray-800">{{ $item->product_name }}</span></li>
                                    @endforeach
                                </ul>
                                @if($order->notes)
                                    <div class="mt-2 bg-yellow-50 text-yellow-800 p-2 rounded text-xs border border-yellow-100">
                                        <strong>Catatan:</strong> {{ Str::limit($order->notes, 50) }}
                                    </div>
                                @endif
                            </td>
                            <td class="p-4">
                                <div class="font-bold text-pink-500 whitespace-nowrap">{{ $order->formatted_total }}</div>
                                @if($order->payment_type)
                                    <div class="text-[10px] text-gray-400 uppercase mt-1">Via: {{ $order->payment_type }}</div>
                                @endif
                            </td>
                            <td class="p-4 text-center">
                                {!! $order->status_badge !!}
                            </td>
                            <td class="p-4">
                                <div class="flex justify-center flex-col gap-2">
                                    @if($order->status === 'pending')
                                        <button wire:click="updateStatus({{ $order->id }}, 'processing')" wire:confirm="Pesanan ini sudah dibayar dan siap diproses?" class="text-xs font-bold text-white bg-blue-500 shadow-sm shadow-blue-200 py-1.5 px-3 rounded-lg hover:bg-blue-600 transition-colors w-full">
                                            Proses (Manual)
                                        </button>
                                        <button wire:click="updateStatus({{ $order->id }}, 'cancelled')" wire:confirm="Batalkan pesanan ini karena melewati batas waktu?" class="text-xs font-bold text-red-600 bg-red-50 border border-red-100 py-1.5 px-3 rounded-lg hover:bg-red-100 transition-colors w-full mt-1">
                                            Batalkan
                                        </button>
                                    @elseif($order->status === 'processing')
                                        <button wire:click="updateStatus({{ $order->id }}, 'completed')" wire:confirm="Pesanan sudah dikirim dan diterima kurir/pelanggan?" class="text-xs font-bold text-white bg-green-500 shadow-sm shadow-green-200 py-1.5 px-3 rounded-lg hover:bg-green-600 transition-colors w-full">
                                            Tandai Selesai
                                        </button>
                                    @elseif($order->status === 'completed' || $order->status === 'cancelled')
                                        <div class="text-xs text-gray-400 font-medium text-center py-1">Tidak ada aksi</div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-12 text-center text-gray-500">
                                <div class="w-16 h-16 mx-auto bg-gray-50 rounded-full flex items-center justify-center mb-4 text-gray-400">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                </div>
                                <p class="text-lg font-bold text-gray-800 mb-1">Tidak Ada Transaksi</p>
                                <p class="text-sm">Belum ada pesanan yang sesuai dengan filter/pencarian.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-100">
            {{ $orders->links() }}
        </div>
    </div>
</div>
