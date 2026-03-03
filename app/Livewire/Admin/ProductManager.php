<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ProductManager extends Component
{
    use WithPagination, WithFileUploads;

    public $name;
    public $category_id;
    public $price;
    public $stock;
    public $description;
    public $badge = 'none';
    public $is_featured = false;
    
    // Simplification for this demo: handling a single image upload instead of array to save time
    public $image; 
    
    public $productId;
    public $isEditing = false;
    public $showModal = false;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'badge' => 'nullable|in:none,new,best_seller',
            'is_featured' => 'boolean',
            'image' => 'nullable|image|max:2048', // Allow null for edit
        ];
    }

    public function confirmCreate()
    {
        $this->reset(['name', 'category_id', 'price', 'stock', 'description', 'badge', 'is_featured', 'image', 'productId']);
        $this->isEditing = false;
        $this->showModal = true;
    }

    public function confirmEdit($id)
    {
        $this->resetValidation();
        $product = Product::findOrFail($id);
        
        $this->productId = $product->id;
        $this->name = $product->name;
        $this->category_id = $product->category_id;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->description = $product->description;
        $this->badge = $product->badge ?: 'none';
        $this->is_featured = $product->is_featured;
        
        $this->image = null; 
        
        $this->isEditing = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => Str::slug($this->name) . '-' . time(), // append time to ensure unique slug for demo
            'category_id' => $this->category_id,
            'price' => $this->price,
            'stock' => $this->stock,
            'description' => $this->description,
            'badge' => $this->badge === 'none' ? null : $this->badge,
            'is_featured' => $this->is_featured,
        ];

        // Hack for demo: we store string image path in the JSON column
        $imagesArray = [];
        if ($this->image) {
            $path = $this->image->store('products', 'public');
            $imagesArray = [$path];
            $data['images'] = $imagesArray;
        }

        if ($this->isEditing) {
            // Only update images if a new one was uploaded
            if (empty($imagesArray)) {
                unset($data['images']);
            }
            Product::findOrFail($this->productId)->update($data);
            $msg = 'Produk berhasil diperbarui.';
        } else {
            // Use dummy images array if none provided
            if (empty($imagesArray)) {
                $data['images'] = ['dummy.jpg'];
            }
            Product::create($data);
            $msg = 'Produk baru berhasil ditambahkan.';
        }

        $this->showModal = false;
        $this->dispatch('toast', ['type' => 'success', 'message' => $msg]);
    }

    public function confirmDelete($id)
    {
        Product::findOrFail($id)->delete();
        $this->dispatch('toast', ['type' => 'success', 'message' => 'Produk berhasil dihapus.']);
    }

    public function render()
    {
        $query = Product::with('category')->latest();
        
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        return view('livewire.admin.product-manager', [
            'products' => $query->paginate(10),
            'categories' => Category::orderBy('name')->get(),
        ])->layout('layouts.admin');
    }
}
