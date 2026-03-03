<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Cart extends Component
{
    public function getCartsProperty()
    {
        return Auth::user()->carts()->with('product')->get();
    }

    public function getSubtotalProperty()
    {
        return $this->carts->sum('subtotal');
    }

    public function increment($cartId)
    {
        $cart = Auth::user()->carts()->where('id', $cartId)->first();
        if ($cart && $cart->quantity < $cart->product->stock) {
            $cart->increment('quantity');
            $this->dispatch('cartUpdated');
        }
    }

    public function decrement($cartId)
    {
        $cart = Auth::user()->carts()->where('id', $cartId)->first();
        if ($cart && $cart->quantity > 1) {
            $cart->decrement('quantity');
            $this->dispatch('cartUpdated');
        }
    }

    public function remove($cartId)
    {
        $cart = Auth::user()->carts()->where('id', $cartId)->first();
        if ($cart) {
            $cart->delete();
            $this->dispatch('cartUpdated');
            $this->dispatch('toast', [
                'type' => 'success',
                'message' => 'Barang dihapus dari keranjang'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.cart', [
            'carts' => $this->carts,
            'subtotal' => $this->subtotal,
            'shipping' => 15000, // Simulasi ongkir flat
        ])->layout('layouts.app');
    }
}
