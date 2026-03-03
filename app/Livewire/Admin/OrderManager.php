<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class OrderManager extends Component
{
    use WithPagination;

    public $statusFilter = 'all';
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function updateStatus($orderId, $newStatus)
    {
        $order = Order::findOrFail($orderId);
        $order->update(['status' => $newStatus]);
        
        $this->dispatch('toast', [
            'type' => 'success',
            'message' => 'Status pesanan ' . $order->order_number . ' berhasil diperbarui jadi ' . $newStatus
        ]);
    }

    public function render()
    {
        $query = Order::with('user')->latest();

        if ($this->statusFilter !== 'all') {
            $query->where('status', $this->statusFilter);
        }

        if ($this->search) {
            $query->where('order_number', 'like', '%' . $this->search . '%')
                  ->orWhere('name', 'like', '%' . $this->search . '%');
        }

        return view('livewire.admin.order-manager', [
            'orders' => $query->paginate(15),
            'countPending' => Order::where('status', 'pending')->count(),
            'countProcessing' => Order::where('status', 'processing')->count(),
        ])->layout('layouts.admin');
    }
}
