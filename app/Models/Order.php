<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'order_number', 'name', 'email', 'phone',
        'address', 'notes', 'greeting_card', 'subtotal',
        'shipping_cost', 'discount', 'total', 'status',
        'snap_token', 'transaction_id', 'payment_type',
    ];

    protected function casts(): array
    {
        return [
            'subtotal' => 'decimal:2',
            'shipping_cost' => 'decimal:2',
            'discount' => 'decimal:2',
            'total' => 'decimal:2',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format($this->total, 0, ',', '.');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'paid', 'settlement' => 'bg-green-100 text-green-800',
            'processing' => 'bg-blue-100 text-blue-800',
            'shipped' => 'bg-indigo-100 text-indigo-800',
            'delivered' => 'bg-emerald-100 text-emerald-800',
            'cancelled', 'cancel' => 'bg-red-100 text-red-800',
            'expired', 'expire' => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Menunggu Pembayaran',
            'paid', 'settlement' => 'Sudah Dibayar',
            'processing' => 'Diproses',
            'shipped' => 'Dikirim',
            'delivered' => 'Diterima',
            'cancelled', 'cancel' => 'Dibatalkan',
            'expired', 'expire' => 'Kadaluarsa',
            default => ucfirst($this->status),
        };
    }
}
