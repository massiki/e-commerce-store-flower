<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProductDetail extends Component
{
    public Product $product;
    public $quantity = 1;
    public $greetingCardText = '';

    public function mount($slug)
    {
        $this->product = Product::with('category')->where('slug', $slug)->firstOrFail();
    }

    public function decrement()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function increment()
    {
        if ($this->quantity < $this->product->stock) {
            $this->quantity++;
        }
    }

    public function addToCart($redirect = false)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($this->product->stock < $this->quantity) {
            $this->dispatch('swal', [
                'type' => 'error',
                'title' => 'Stok tidak cukup!',
                'text' => 'Maaf, stok bunga saat ini hanya tersisa ' . $this->product->stock
            ]);
            return;
        }

        $cart = Cart::where('user_id', Auth::id())
                    ->where('product_id', $this->product->id)
                    ->first();

        if ($cart) {
            $cart->update([
                'quantity' => $cart->quantity + $this->quantity,
                'greeting_card_text' => $this->greetingCardText ?: $cart->greeting_card_text,
            ]);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $this->product->id,
                'quantity' => $this->quantity,
                'greeting_card_text' => $this->greetingCardText,
            ]);
        }

        $this->dispatch('cartUpdated');
        
        if ($redirect) {
            return $this->redirect('/cart', navigate: true);
        }

        $this->dispatch('toast', [
            'type' => 'success',
            'message' => 'Berhasil ditambahkan ke keranjang'
        ]);
        
        // Reset form
        $this->quantity = 1;
        $this->greetingCardText = '';
    }

    public function render()
    {
        return view('livewire.product-detail', [
            'relatedProducts' => Product::where('category_id', $this->product->category_id)
                                        ->where('id', '!=', $this->product->id)
                                        ->inRandomOrder()
                                        ->take(4)
                                        ->get()
        ])->layout('layouts.app');
    }
}
