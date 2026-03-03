<div>
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900">Manajemen <span class="text-pink-500">Kategori</span></h1>
        <button wire:click="confirmCreate" class="btn-pink px-6 py-2.5 shadow-sm text-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Kategori
        </button>
    </div>

    <!-- Category Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b border-gray-100">
                        <th class="p-4 font-semibold w-16 text-center">No</th>
                        <th class="p-4 font-semibold">Info Kategori</th>
                        <th class="p-4 font-semibold text-center">Jumlah Produk</th>
                        <th class="p-4 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($categories as $index => $cat)
                        <tr class="hover:bg-pink-50/30 transition-colors">
                            <td class="p-4 text-center text-gray-500">{{ $categories->firstItem() + $index }}</td>
                            <td class="p-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-pink-50 rounded-lg flex items-center justify-center text-pink-500 overflow-hidden shrink-0">
                                        @if($cat->image)
                                            <img src="{{ Storage::url($cat->image) }}" class="w-full h-full object-cover">
                                        @else
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-800">{{ $cat->name }}</div>
                                        <div class="text-xs text-gray-500 line-clamp-1 max-w-xs">{{ $cat->description ?: 'Tidak ada deskripsi' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 text-center">
                                <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-bold">{{ $cat->products_count }} item</span>
                            </td>
                            <td class="p-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button wire:click="confirmEdit({{ $cat->id }})" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>
                                    <button wire:click="confirmDelete({{ $cat->id }})" wire:confirm="Yakin ingin menghapus kategori ini?" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-8 text-center text-gray-500">Belum ada kategori yang ditambahkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-100">
            {{ $categories->links() }}
        </div>
    </div>

    <!-- Modal Form (Hidden by default, controlled by Livewire) -->
    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden p-4 sm:p-0">
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity" wire:click="$set('showModal', false)"></div>

            <!-- Modal Panel -->
            <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-lg mx-auto overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <h3 class="text-lg font-bold text-gray-800">{{ $isEditing ? 'Edit Kategori' : 'Tambah Kategori Baru' }}</h3>
                    <button wire:click="$set('showModal', false)" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                
                <form wire:submit="save" class="p-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Kategori</label>
                            <input type="text" wire:model.defer="name" class="input-pink" placeholder="Contoh: Buket Wisuda">
                            @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Kategori</label>
                            <textarea wire:model.defer="description" rows="3" class="input-pink" placeholder="Deskripsi opsional..."></textarea>
                            @error('description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Kategori (Opsional)</label>
                            
                            <input type="file" wire:model="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100 transition-colors">
                            <div wire:loading wire:target="image" class="text-pink-500 text-xs mt-2 font-medium animate-pulse">Mengunggah foto...</div>
                            @error('image') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror

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

                    <div class="mt-8 flex justify-end gap-3 pt-4 border-t border-gray-100">
                        <button type="button" wire:click="$set('showModal', false)" class="px-5 py-2.5 bg-gray-100 text-gray-600 hover:bg-gray-200 rounded-xl font-semibold transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="btn-pink px-6 py-2.5">
                            <span wire:loading.remove wire:target="save">Simpan</span>
                            <span wire:loading wire:target="save" class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                Menyimpan...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
