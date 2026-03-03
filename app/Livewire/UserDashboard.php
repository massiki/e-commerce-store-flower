<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class UserDashboard extends Component
{
    use WithPagination;

    public $filterStatus = 'all';

    public function setFilter($status)
    {
        $this->filterStatus = $status;
        $this->resetPage();
    }

    public function cancelOrder($orderId)
    {
        $order = Order::where('id', $orderId)->where('user_id', Auth::id())->first();
        
        if ($order && $order->status === 'pending') {
            $order->update(['status' => 'cancelled']);
            $this->dispatch('toast', [
                'type' => 'success',
                'message' => 'Pesanan berhasil dibatalkan.'
            ]);
        }
    }

    public function render()
    {
        $query = Order::where('user_id', Auth::id())->latest();

        if ($this->filterStatus !== 'all') {
            $query->where('status', $this->filterStatus);
        }

        return view('livewire.user-dashboard', [
            'orders' => $query->paginate(10),
            'user' => Auth::user(),
            'totalOrders' => Order::where('user_id', Auth::id())->count(),
            'pendingOrders' => Order::where('user_id', Auth::id())->whereIn('status', ['pending', 'processing'])->count(),
        ])->layout('layouts.app');
    }
}
