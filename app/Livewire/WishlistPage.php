<?php

namespace App\Livewire;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistPage extends Component
{
    public function remove($wishlistId)
    {
        $item = Wishlist::where('id', $wishlistId)->where('user_id', Auth::id())->first();
        if ($item) {
            $item->delete();
            $this->dispatch('toast', [
                'type' => 'success',
                'message' => 'Dihapus dari wishlist'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.wishlist-page', [
            'wishlists' => Wishlist::where('user_id', Auth::id())->with('product')->latest()->get(),
            'user' => Auth::user(),
        ])->layout('layouts.app');
    }
}
