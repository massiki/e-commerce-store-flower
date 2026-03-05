<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CategoryManager extends Component
{
    use WithPagination, WithFileUploads;

    public $name;

    public $categoryId;
    public $isEditing = false;
    public $showModal = false;

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }

    public function confirmCreate()
    {
        $this->reset(['name', 'categoryId']);
        $this->isEditing = false;
        $this->showModal = true;
    }

    public function confirmEdit($id)
    {
        $this->resetValidation();
        $category = Category::findOrFail($id);

        $this->categoryId = $category->id;
        $this->name = $category->name;

        $this->isEditing = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => Str::slug($this->name),
        ];

        if ($this->isEditing) {
            Category::findOrFail($this->categoryId)->update($data);
            $msg = 'Kategori berhasil diperbarui.';
        } else {
            Category::create($data);
            $msg = 'Kategori baru berhasil ditambahkan.';
        }

        $this->showModal = false;
        $this->dispatch('toast', ['type' => 'success', 'message' => $msg]);
    }

    public function confirmDelete($id)
    {
        // Simple delete for now. In real app, check if it has products first.
        if (Product::where('category_id', $id)->exists()) {
            $this->dispatch('toast', ['type' => 'error', 'message' => 'Kategori tidak dapat dihapus karena masih ada produk yang terkait.']);
            return;
        }
        Category::findOrFail($id)->delete();
        $this->dispatch('toast', ['type' => 'success', 'message' => 'Kategori berhasil dihapus.']);
    }

    public function render()
    {
        return view('livewire.admin.category-manager', [
            'categories' => Category::withCount('products')->latest()->paginate(10)
        ])->layout('layouts.admin');
    }
}
