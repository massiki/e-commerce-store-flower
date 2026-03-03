<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'code', 'discount_type', 'discount_value',
        'min_order', 'max_discount', 'usage_limit',
        'used_count', 'valid_from', 'valid_until', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'discount_value' => 'decimal:2',
            'min_order' => 'decimal:2',
            'max_discount' => 'decimal:2',
            'valid_from' => 'datetime',
            'valid_until' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    public function isValid(): bool
    {
        return $this->is_active
            && now()->between($this->valid_from, $this->valid_until)
            && ($this->usage_limit === 0 || $this->used_count < $this->usage_limit);
    }

    public function calculateDiscount(float $subtotal): float
    {
        if ($subtotal < $this->min_order) {
            return 0;
        }

        $discount = $this->discount_type === 'percent'
            ? $subtotal * ($this->discount_value / 100)
            : $this->discount_value;

        if ($this->max_discount && $discount > $this->max_discount) {
            $discount = $this->max_discount;
        }

        return $discount;
    }
}
