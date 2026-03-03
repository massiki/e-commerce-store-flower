<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.home', [
            'featuredProducts' => Product::where('is_featured', true)
                ->with('category')
                ->latest()
                ->take(8)
                ->get(),
        ])->layout('layouts.app');
    }
}
