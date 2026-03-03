<?php

namespace App\Livewire\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $today = Carbon::today();
        
        // Stats
        $totalRevenue = Order::where('status', 'completed')->sum('total');
        $todayRevenue = Order::where('status', 'completed')
                             ->whereDate('created_at', $today)
                             ->sum('total');
                             
        $totalOrders = Order::count();
        $pendingOrders = Order::whereIn('status', ['pending', 'processing'])->count();
        
        $totalProducts = Product::count();
        $totalUsers = User::where('role', 'user')->count();
        
        // Recent Orders
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('livewire.admin.dashboard', compact(
            'totalRevenue', 
            'todayRevenue', 
            'totalOrders', 
            'pendingOrders', 
            'totalProducts', 
            'totalUsers',
            'recentOrders'
        ))->layout('layouts.admin');
    }
}
