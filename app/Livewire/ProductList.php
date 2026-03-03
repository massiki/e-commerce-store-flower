<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $sort = 'latest'; // latest, price_asc, price_desc

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
        'sort' => ['except' => 'latest'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function setCategory($slug)
    {
        $this->category = $slug;
        $this->resetPage();
    }

    public function render()
    {
        $query = Product::with('category');

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
        }

        if ($this->category) {
            $query->whereHas('category', function ($q) {
                $q->where('slug', $this->category);
            });
        }

        if ($this->sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($this->sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }

        return view('livewire.product-list', [
            'products' => $query->paginate(12),
            'categories' => Category::all(),
        ])->layout('layouts.app');
    }
}
