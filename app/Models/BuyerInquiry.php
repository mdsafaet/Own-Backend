<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyerInquiry extends Model
{
    protected $fillable = [
        'company_name',
        'contact_person',
        'email',
        'country',
        'product_code',
        'estimated_quantity',
        'target_price',
        'target_delivery_date',
        'attachment',
        'message',
        'status',
        'internal_notes',
        'contacted_at',
        'ip_address',
        'user_agent',
    ];

    protected function casts(): array
    {
        return [
            'estimated_quantity' => 'integer',
            'target_delivery_date' => 'date',
            'contacted_at' => 'datetime',
        ];
    }
}