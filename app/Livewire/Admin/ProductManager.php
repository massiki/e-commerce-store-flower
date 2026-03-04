<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
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
    public $imagePath;

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
            'image' => ($this->isEditing ? 'nullable' : 'required') . '|image|max:2048',
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
        $this->imagePath = $product->image;

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

        if ($this->image) {
            $data['image'] = $this->image->store('products', 'public');
        }

        if ($this->isEditing) {
            if ($this->image) {
                if ($this->imagePath && Storage::disk('public')->exists($this->imagePath)) {
                    Storage::disk('public')->delete($this->imagePath);
                }
            } else {
                $data['image'] = $this->imagePath;
            }
            Product::findOrFail($this->productId)->update($data);
            $msg = 'Produk berhasil diperbarui.';
        } else {
            Product::create($data);
            $msg = 'Produk baru berhasil ditambahkan.';
        }

        $this->showModal = false;
        $this->dispatch('toast', ['type' => 'success', 'message' => $msg]);
    }

    public function confirmDelete($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
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
