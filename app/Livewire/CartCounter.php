<?php

namespace App\Livewire;

use Livewire\Component;

class CartCounter extends Component
{
    public $count = 0;

    protected $listeners = ['cartUpdated' => 'updateCount'];

    public function mount()
    {
        $this->updateCount();
    }

    public function updateCount()
    {
        if (auth()->check()) {
            $this->count = auth()->user()->carts()->sum('quantity');
        } else {
            $this->count = 0;
        }
    }

    public function render()
    {
        return view('livewire.cart-counter');
    }
}
