<div>
  <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
    <h1 class="text-3xl font-extrabold text-gray-900">Manajemen <span class="text-pink-500">Produk</span></h1>

    <div class="flex items-center gap-4 w-full sm:w-auto">
      <div class="relative flex-grow sm:flex-grow-0">
        <input type="text" wire:model.live.debounce.500ms="search" class="input-pink pl-10 w-full sm:w-64"
          placeholder="Cari nama produk...">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </div>
      </div>
      <button wire:click="confirmCreate" class="btn-pink px-6 py-2.5 shadow-sm text-sm whitespace-nowrap">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Tambah Produk
      </button>
    </div>
  </div>

  <!-- Products Table -->
  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden relative">
    <div wire:loading.delay class="absolute inset-0 bg-white/50 backdrop-blur-sm z-10 flex items-center justify-center">
      <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-pink-500"></div>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b border-gray-100">
            <th class="p-4 font-semibold w-16 text-center">No</th>
            <th class="p-4 font-semibold">Info Produk</th>
            <th class="p-4 font-semibold">Kategori</th>
            <th class="p-4 font-semibold">Harga</th>
            <th class="p-4 font-semibold text-center">Stok</th>
            <th class="p-4 font-semibold text-center">Status</th>
            <th class="p-4 font-semibold text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-sm">
          @forelse($products as $index => $prod)
            <tr class="hover:bg-pink-50/30 transition-colors">
              <td class="p-4 text-center text-gray-500">{{ $products->firstItem() + $index }}</td>
              <td class="p-4">
                <div class="flex items-center gap-4">
                  <div class="w-12 h-12 bg-gray-100 rounded-lg overflow-hidden shrink-0 relative">
                    <!-- For demo, we just use UI avatars if real image not setup properly yet -->
                    @if ($prod->image)
                      <img src="{{ asset('storage/' . $prod->image) }}" class="w-full h-full object-cover">
                    @else
                      <img src="https://ui-avatars.com/api/?name=product&amp;background=fdf2f8&amp;color=ec4899"
                        class="w-full h-full object-cover">
                    @endif
                  </div>
                  <div class="max-w-[200px]">
                    <div class="font-bold text-gray-800 line-clamp-1">{{ $prod->name }}</div>
                    <div class="text-xs text-gray-500 flex items-center gap-1 mt-1">
                      @if ($prod->badge === 'best_seller')
                        <span
                          class="text-pink-500 font-semibold px-1.5 py-0.5 bg-pink-50 rounded text-[10px] uppercase">Best
                          Seller</span>
                      @elseif($prod->badge === 'new')
                        <span
                          class="text-green-500 font-semibold px-1.5 py-0.5 bg-green-50 rounded text-[10px] uppercase">New</span>
                      @endif

                      @if ($prod->is_featured)
                        <span class="text-yellow-500">★ Featured</span>
                      @endif
                    </div>
                  </div>
                </div>
              </td>
              <td class="p-4 text-gray-600">{{ $prod->category->name }}</td>
              <td class="p-4 font-bold text-pink-500">{{ $prod->formatted_price }}</td>
              <td class="p-4 text-center">
                <span
                  class="px-2.5 py-1 rounded-full text-xs font-bold {{ $prod->stock > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                  {{ $prod->stock }}
                </span>
              </td>
              <td class="p-4 text-center">
                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-600">Aktif</span>
              </td>
              <td class="p-4 text-right">
                <div class="flex items-center justify-end gap-2">
                  <a href="{{ route('products.show', $prod->slug) }}" target="_blank"
                    class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-50 rounded-lg transition-colors"
                    title="Lihat di Toko">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                      </path>
                    </svg>
                  </a>
                  <button wire:click="confirmEdit({{ $prod->id }})"
                    class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                      </path>
                    </svg>
                  </button>
                  <button wire:click="confirmDelete({{ $prod->id }})"
                    wire:confirm="Yakin ingin menghapus produk ini?"
                    class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                      </path>
                    </svg>
                  </button>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="p-12 text-center text-gray-500">
                <div
                  class="w-16 h-16 mx-auto bg-gray-50 rounded-full flex items-center justify-center mb-4 text-gray-400">
                  <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                    </path>
                  </svg>
                </div>
                <p class="text-lg font-bold text-gray-800 mb-1">Tidak Ada Produk</p>
                <p class="text-sm">Silakan tambah produk baru ke katalog sistem Anda.</p>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="p-4 border-t border-gray-100">
      {{ $products->links() }}
    </div>
  </div>

  <!-- Modal Form -->
  @if ($showModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden p-4 sm:p-0">
      <!-- Backdrop -->
      <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity"
        wire:click="$set('showModal', false)"></div>

      <!-- Modal Panel -->
      <div
        class="relative bg-white rounded-2xl shadow-xl w-full max-w-3xl mx-auto overflow-hidden max-h-[90vh] flex flex-col">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50 flex-shrink-0">
          <h3 class="text-lg font-bold text-gray-800">{{ $isEditing ? 'Edit Produk' : 'Tambah Produk Baru' }}</h3>
          <button wire:click="$set('showModal', false)" class="text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>

        <form wire:submit="save" class="flex-grow overflow-y-auto p-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Column -->
            <div class="space-y-4">
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Produk</label>
                <input type="text" wire:model.defer="name" class="input-pink"
                  placeholder="Contoh: Buket Mawar Merah">
                @error('name')
                  <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
              </div>

              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                <select wire:model.defer="category_id" class="input-pink">
                  <option value="">-- Pilih Kategori --</option>
                  @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                  @endforeach
                </select>
                @error('category_id')
                  <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
              </div>

              <div class="grid grid-cols-2 gap-4">
                <div>
                  <label class="block text-sm font-semibold text-gray-700 mb-2">Harga (Rp)</label>
                  <input type="number" wire:model.defer="price" class="input-pink" placeholder="0">
                  @error('price')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                  @enderror
                </div>
                <div>
                  <label class="block text-sm font-semibold text-gray-700 mb-2">Stok</label>
                  <input type="number" wire:model.defer="stock" class="input-pink" placeholder="0">
                  @error('stock')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Label / Badge</label>
                <select wire:model.defer="badge" class="input-pink">
                  <option value="none">Tidak ada label</option>
                  <option value="new">🆕 New</option>
                  <option value="best_seller">🔥 Best Seller</option>
                </select>
                @error('badge')
                  <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
              </div>

              <div>
                <label
                  class="flex items-center gap-2 p-3 border border-pink-100 rounded-xl cursor-pointer hover:bg-pink-50 transition-colors">
                  <input type="checkbox" wire:model.defer="is_featured"
                    class="rounded text-pink-500 focus:ring-pink-500 focus:ring-offset-0">
                  <span class="text-sm font-semibold text-gray-700">Tampilkan di Beranda (Featured)</span>
                </label>
              </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-4">


              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Produk</label>
                <textarea wire:model.defer="description" rows="4" class="input-pink"
                  placeholder="Tuliskan detail produk secara lengkap..."></textarea>
                @error('description')
                  <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror
              </div>

              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Product</label>

                <input type="file" wire:model="image" accept="image/jpeg,image/png,image/jpg"
                  class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100 transition-colors">
                <div wire:loading wire:target="image" class="text-pink-500 text-xs mt-2 font-medium animate-pulse">
                  Mengunggah foto...</div>
                @error('image')
                  <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror

                <!-- Preview -->
                @if ($image)
                  <div class="mt-4 border border-gray-200 rounded-lg p-2 max-w-xs">
                    <img src="{{ $image->temporaryUrl() }}" class="w-full h-auto rounded">
                  </div>
                @elseif ($imagePath)
                  <div class="mt-4 border border-gray-200 rounded-lg p-2 max-w-xs">
                    <img src="{{ Storage::url($imagePath) }}" class="w-full h-auto rounded">
                    <div class="text-xs text-gray-500 text-center mt-1">Foto saat ini</div>
                  </div>
                @endif

              </div>
            </div>
          </div>

          <div class="mt-8 flex justify-end gap-3 pt-4 border-t border-gray-100">
            <button type="button" wire:click="$set('showModal', false)"
              class="px-5 py-2.5 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded-xl font-semibold transition-colors">
              Batal
            </button>
            <button type="submit" class="btn-pink px-6 py-2.5">
              <span wire:loading.remove wire:target="save">Simpan Data Produk</span>
              <span wire:loading wire:target="save" class="flex items-center">
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                    stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                  </path>
                </svg>
                Menyimpan...
              </span>
            </button>
          </div>
        </form>
      </div>
    </div>
  @endif
</div>
