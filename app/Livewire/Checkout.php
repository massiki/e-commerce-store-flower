<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Voucher;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Checkout extends Component
{
    public $name;
    public $email;
    public $phone;
    public $address;
    public $notes;
    
    public $voucherCode = '';
    public $appliedVoucher = null;
    public $discountAmount = 0;
    
    public $shippingCost = 15000; // Flat rate shipping

    public function mount()
    {
        $user = Auth::user();
        if ($user->carts()->count() === 0) {
            return redirect()->route('cart');
        }

        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->address = $user->address;
    }

    public function getCartsProperty()
    {
        return Auth::user()->carts()->with('product')->get();
    }

    public function getSubtotalProperty()
    {
        return $this->carts->sum('subtotal');
    }

    public function getTotalProperty()
    {
        return $this->subtotal + $this->shippingCost - $this->discountAmount;
    }

    public function applyVoucher()
    {
        $this->resetErrorBag('voucherCode');
        
        if (empty($this->voucherCode)) {
            $this->removeVoucher();
            return;
        }

        $voucher = Voucher::where('code', strtoupper($this->voucherCode))->first();

        if (!$voucher) {
            $this->addError('voucherCode', 'Kode voucher tidak ditemukan.');
            return;
        }

        if (!$voucher->isValid()) {
            $this->addError('voucherCode', 'Voucher sudah tidak berlaku atau kuota habis.');
            return;
        }

        if ($this->subtotal < $voucher->min_order) {
            $this->addError('voucherCode', 'Minimal belanja untuk voucher ini adalah Rp ' . number_format($voucher->min_order, 0, ',', '.'));
            return;
        }

        $this->appliedVoucher = $voucher;
        $this->discountAmount = $voucher->calculateDiscount($this->subtotal);
        
        $this->dispatch('toast', [
            'type' => 'success',
            'message' => 'Voucher berhasil digunakan!'
        ]);
    }

    public function removeVoucher()
    {
        $this->appliedVoucher = null;
        $this->discountAmount = 0;
        $this->voucherCode = '';
    }

    public function placeOrder()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);

        if ($this->carts->count() === 0) {
            return redirect()->route('cart');
        }

        // Generate Order Number
        $orderNumber = 'ORD-' . strtoupper(Str::random(10)) . '-' . time();

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => $orderNumber,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'notes' => $this->notes,
            'subtotal' => $this->subtotal,
            'shipping_cost' => $this->shippingCost,
            'discount' => $this->discountAmount,
            'total' => $this->total,
            'status' => 'pending',
        ]);

        foreach ($this->carts as $cart) {
            $order->items()->create([
                'product_id' => $cart->product_id,
                'product_name' => $cart->product->name,
                'price' => $cart->product->price,
                'quantity' => $cart->quantity,
                'subtotal' => $cart->subtotal,
            ]);

            // Optional: reduce stock here, or wait until payment success
            // $cart->product->decrement('stock', $cart->quantity);
        }
        
        if ($this->appliedVoucher) {
            $this->appliedVoucher->increment('used_count');
        }

        // Clear cart
        Auth::user()->carts()->delete();
        $this->dispatch('cartUpdated');

        // Note: the actual Midtrans trigger will happen via an inline JS call
        // we'll emit an event containing the order id.
        $this->dispatch('startPayment', orderId: $order->id);
    }

    public function render()
    {
        return view('livewire.checkout', [
            'carts' => $this->carts,
            'subtotal' => $this->subtotal,
            'total' => $this->total,
        ])->layout('layouts.app', ['withMidtrans' => true]);
    }
}
