<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
  <div class="mb-8 text-center max-w-3xl mx-auto">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Katalog <span class="text-pink-500">Bunga</span></h1>
    <p class="text-gray-500 text-lg">Temukan karangan bunga buket terbaik untuk setiap momen spesial Anda.</p>
  </div>

  <div class="flex flex-col lg:flex-row gap-8">
    <!-- Sidebar Filter -->
    <div class="w-full lg:w-1/4">
      <div class="bg-white rounded-2xl shadow-sm border border-pink-100 p-6 sticky top-24">
        <h3 class="text-lg font-bold text-gray-800 mb-4 pb-4 border-b border-gray-100">Cari Bunga</h3>

        <!-- Search -->
        <div class="mb-6">
          <div class="relative">
            <input type="text" wire:model.live.debounce.500ms="search" class="input-pink pl-10"
              placeholder="Cari nama bunga...">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
            </div>
          </div>
        </div>

        <h3 class="text-lg font-bold text-gray-800 mb-4 pb-4 border-b border-gray-100">Kategori</h3>
        <div class="space-y-2 mb-6">
          <button wire:click="setCategory('')"
            class="w-full text-left px-3 py-2 rounded-lg transition-colors {{ $category === '' ? 'bg-pink-50 text-pink-600 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
            Semua Kategori
          </button>
          @foreach ($categories as $cat)
            <button wire:click="setCategory('{{ $cat->slug }}')"
              class="w-full text-left px-3 py-2 rounded-lg transition-colors {{ $category === $cat->slug ? 'bg-pink-50 text-pink-600 font-semibold' : 'text-gray-600 hover:bg-gray-50' }}">
              {{ $cat->name }}
            </button>
          @endforeach
        </div>

        <h3 class="text-lg font-bold text-gray-800 mb-4 pb-4 border-b border-gray-100">Urutkan</h3>
        <select wire:model.live="sort" class="input-pink cursor-pointer">
          <option value="latest">Terbaru</option>
          <option value="price_asc">Harga Terendah</option>
          <option value="price_desc">Harga Tertinggi</option>
        </select>

        <!-- Loading indicator overlay -->
        <div wire:loading
          class="absolute inset-0 bg-white/50 backdrop-blur-sm z-10 flex items-center justify-center rounded-2xl">
          <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-pink-500"></div>
        </div>
      </div>
    </div>

    <!-- Product Grid -->
    <div class="w-full lg:w-3/4 relative min-h-[500px]">
      <!-- Loading Grid indicator -->
      <div wire:loading.delay.longer
        class="absolute inset-0 z-10 bg-gray-50/50 backdrop-blur-sm flex items-center justify-center">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-pink-500"></div>
      </div>

      @if ($products->isEmpty())
        <div
          class="bg-white rounded-2xl p-12 text-center shadow-sm border border-gray-100 h-full flex flex-col items-center justify-center">
          <div class="w-24 h-24 bg-pink-50 rounded-full flex items-center justify-center mb-6">
            <svg class="w-12 h-12 text-pink-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
              </path>
            </svg>
          </div>
          <h3 class="text-xl font-bold text-gray-800 mb-2">Bunga Tidak Ditemukan</h3>
          <p class="text-gray-500 mb-6">Maaf, tidak ada produk bunga yang sesuai dengan kriteria pencarian Anda.</p>
          <button wire:click="$set('search', ''); $set('category', '')" class="btn-pink-outline px-6 py-2">
            Reset Filter
          </button>
        </div>
      @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
          @foreach ($products as $product)
            <div class="card-product group relative flex flex-col h-full bg-white">
              <a href="{{ route('products.show', $product->slug) }}" wire:navigate
                class="block relative aspect-[4/3] overflow-hidden bg-gray-100">
                <img
                  src="{{ $product->image ? asset('storage/' . $product->image) : 'https://ui-avatars.com/api/?name=' . urlencode($product->name) . '&background=fdf2f8&color=ec4899&size=400' }}"
                  alt="{{ $product->name }}"
                  class="w-full h-full object-cover rounded-t-2xl transition-transform duration-700 group-hover:scale-110" />

                @if ($product->badge === 'best_seller')
                  <span class="badge-bestseller">Best Seller</span>
                @elseif($product->badge === 'new')
                  <span class="badge-new">New</span>
                @endif
              </a>

              <div class="p-5 flex flex-col flex-grow">
                <div class="text-xs text-pink-500 font-semibold uppercase tracking-wider mb-1">
                  {{ $product->category->name }}</div>
                <h3
                  class="text-lg font-bold text-gray-800 mb-2 group-hover:text-pink-600 transition-colors line-clamp-1">
                  <a href="{{ route('products.show', $product->slug) }}" wire:navigate>{{ $product->name }}</a>
                </h3>

                <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-50">
                  <span class="text-xl font-extrabold text-gray-900">{{ $product->formatted_price }}</span>
                  <a href="{{ route('products.show', $product->slug) }}" wire:navigate
                    class="w-10 h-10 rounded-full bg-pink-50 text-pink-500 flex items-center justify-center hover:bg-pink-500 hover:text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                  </a>
                </div>
              </div>
            </div>
          @endforeach
        </div>

        <div class="mt-8">
          {{ $products->links() }}
        </div>
      @endif
    </div>
  </div>
</div>
