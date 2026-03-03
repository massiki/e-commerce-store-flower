<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
  <h1 class="text-3xl font-extrabold text-gray-900 mb-8">Checkout <span class="text-pink-500">Pesanan</span></h1>

  <form wire:submit="placeOrder" class="flex flex-col lg:flex-row gap-8 relative">

    <!-- Loading overlay when placing order -->
    <div wire:loading wire:target="placeOrder"
      class="absolute inset-0 bg-white/50 backdrop-blur-sm z-50 flex items-center justify-center rounded-3xl">
      <div class="bg-white px-8 py-6 rounded-2xl shadow-xl flex flex-col items-center">
        <div class="animate-spin rounded-full h-12 w-12 border-b-4 border-pink-500 mb-4"></div>
        <p class="font-bold text-gray-800">Memproses Pesanan...</p>
        <p class="text-sm text-gray-500 mt-1">Jangan tutup halaman ini.</p>
      </div>
    </div>

    <!-- Form Details -->
    <div class="w-full lg:w-2/3">
      <div class="bg-white rounded-2xl shadow-sm border border-pink-50 p-6 sm:p-8 mb-6">
        <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2 border-b border-gray-100 pb-4">
          <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z">
            </path>
          </svg>
          Informasi Pengiriman
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
          <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Penerima</label>
            <input type="text" id="name" wire:model.defer="name" class="input-pink" required>
            @error('name')
              <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
          </div>
          <div>
            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon/WhatsApp</label>
            <input type="tel" id="phone" wire:model.defer="phone" class="input-pink" required>
            @error('phone')
              <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
            @enderror
          </div>
        </div>

        <div class="mb-6">
          <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Pemesan</label>
          <input type="email" id="email" wire:model.defer="email" class="input-pink" required>
          @error('email')
            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
          @enderror
        </div>

        <div class="mb-6">
          <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap Pengiriman</label>
          <textarea id="address" wire:model.defer="address" rows="3" class="input-pink" required
            placeholder="Sertakan patokan untuk memudahkan kurir..."></textarea>
          @error('address')
            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
          @enderror
        </div>

        <div>
          <label for="notes" class="block text-sm font-semibold text-gray-700 mb-2">Catatan Tambahan
            (Opsional)</label>
          <textarea id="notes" wire:model.defer="notes" rows="2" class="input-pink"
            placeholder="Contoh: Tolong kirim jam 10 pagi, titip di sekuriti."></textarea>
        </div>
      </div>

      <!-- Items summary for mobile -->
      <div class="bg-white rounded-2xl shadow-sm border border-pink-50 p-6 sm:p-8 block lg:hidden mb-6">
        <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2 border-b border-gray-100 pb-4">
          <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
          </svg>
          Pesanan Anda
        </h3>

        <div class="space-y-4">
          @foreach ($carts as $cart)
            <div class="flex gap-4">
              <div class="w-16 h-16 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0">
                <img
                  src="https://ui-avatars.com/api/?name={{ urlencode($cart->product->name) }}&background=fdf2f8&color=ec4899"
                  class="w-full h-full object-cover">
              </div>
              <div class="flex-grow">
                <h4 class="font-bold text-gray-800 text-sm">{{ $cart->product->name }}</h4>
                <div class="text-gray-500 text-sm">{{ $cart->quantity }} x {{ $cart->product->formatted_price }}</div>
                @if ($cart->greeting_card_text)
                  <div class="text-xs text-pink-500 mt-1 truncate">Kartu: Yes</div>
                @endif
              </div>
              <div class="font-bold text-sm">
                Rp {{ number_format($cart->subtotal, 0, ',', '.') }}
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <!-- Order Summary Sidebar -->
    <div class="w-full lg:w-1/3">
      <div class="bg-white rounded-2xl shadow-sm border border-pink-100 p-6 sticky top-24">

        <!-- Desktop Items Summary -->
        <div class="hidden lg:block mb-8">
          <h3 class="text-lg font-bold text-gray-800 mb-4 pb-4 border-b border-gray-100">Pesanan Anda</h3>
          <div class="space-y-4 max-h-60 overflow-y-auto pr-2">
            @foreach ($carts as $cart)
              <div class="flex gap-4 items-center">
                <div class="w-12 h-12 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0">
                  <img
                    src="https://ui-avatars.com/api/?name={{ urlencode($cart->product->name) }}&background=fdf2f8&color=ec4899"
                    class="w-full h-full object-cover">
                </div>
                <div class="flex-grow">
                  <h4 class="font-bold text-gray-800 text-xs line-clamp-1">{{ $cart->product->name }}</h4>
                  <div class="text-gray-500 text-xs">{{ $cart->quantity }} x Rp
                    {{ number_format($cart->product->price, 0, ',', '.') }}</div>
                </div>
              </div>
            @endforeach
          </div>
        </div>

        <!-- Voucher Code -->
        <div class="mb-6 pb-6 border-b border-gray-100">
          <label class="block text-sm font-semibold text-gray-700 mb-2">Kode Voucher</label>

          @if ($appliedVoucher)
            <div
              class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center justify-between">
              <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                  <div class="font-bold text-sm">{{ $appliedVoucher->code }}</div>
                  <div class="text-xs">Berhasil diterapkan!</div>
                </div>
              </div>
              <button type="button" wire:click="removeVoucher"
                class="text-green-700 hover:text-red-500 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                  </path>
                </svg>
              </button>
            </div>
          @else
            <div class="flex gap-2">
              <input type="text" wire:model.defer="voucherCode" class="input-pink uppercase"
                placeholder="Masukkan kode">
              <button type="button" wire:click="applyVoucher"
                class="bg-gray-800 text-white px-4 py-2 rounded-xlhover:bg-gray-700 focus:outline-none transition-colors font-semibold text-sm">
                Terapkan
              </button>
            </div>
            @error('voucherCode')
              <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span>
            @enderror
          @endif
        </div>

        <!-- Totals -->
        <div class="space-y-4 text-gray-600 mb-8">
          <div class="flex justify-between items-center text-sm">
            <span>Total Harga ({{ $carts->sum('quantity') }} barang)</span>
            <span class="font-semibold text-gray-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
          </div>
          <div class="flex justify-between items-center text-sm pb-4 border-b border-gray-100">
            <span>Ongkos Kirim</span>
            <span class="font-semibold text-gray-900">Rp {{ number_format($shippingCost, 0, ',', '.') }}</span>
          </div>

          @if ($discountAmount > 0)
            <div class="flex justify-between items-center text-sm pb-4 border-b border-gray-100 text-green-600">
              <span>Diskon Voucher</span>
              <span class="font-bold">-Rp {{ number_format($discountAmount, 0, ',', '.') }}</span>
            </div>
          @endif

          <div class="flex justify-between items-center text-lg pt-2">
            <span class="font-bold text-gray-900">Total Tagihan</span>
            <span class="font-extrabold text-pink-500">Rp {{ number_format($total, 0, ',', '.') }}</span>
          </div>
        </div>

        <button type="submit" class="btn-pink w-full justify-center group relative overflow-hidden">
          <span class="relative z-10 flex items-center justify-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
              </path>
            </svg>
            Lanjut Pembayaran
          </span>
          <div
            class="absolute inset-0 bg-white/20 transform -translate-x-full transition-transform duration-500 group-hover:translate-x-0">
          </div>
        </button>

        <div class="mt-4 text-center flex items-center justify-center gap-2 text-xs text-gray-500">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
            </path>
          </svg>
          Pembayaran aman by Midtrans
        </div>
      </div>
    </div>
  </form>

  <script>
    document.addEventListener('livewire:init', () => {
      Livewire.on('startPayment', (data) => {
        const orderId = data[0].orderId;

        // Fetch snap token from our backend using fetch api
        fetch(`/payment/pay/${orderId}`, {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
              'Content-Type': 'application/json',
              'Accept': 'application/json'
            }
          })
          .then(response => response.json())
          .then(data => {
            if (data.snap_token) {
              snap.pay(data.snap_token, {
                onSuccess: function(result) {
                  window.location.href = '/payment/success?order_id=' + orderId;
                },
                onPending: function(result) {
                  window.location.href = '/dashboard';
                },
                onError: function(result) {
                  window.location.href = '/payment/failed';
                },
                onClose: function() {
                  Swal.fire('Pembayaran Dibatalkan',
                      'Silakan selesaikan pembayaran di menu Dashboard kami.', 'warning')
                    .then(() => {
                      window.location.href = '/dashboard';
                    });
                }
              });
            } else {
              Swal.fire('Error', 'Gagal mendapatkan token pembayaran', 'error');
            }
          })
          .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error', 'Terjadi kesalahan sistem, silakan coba lagi.', 'error');
          });
      });
    });
  </script>
</div>
