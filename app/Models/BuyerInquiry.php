<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyerInquiry extends Model
{
protected $fillable = [
    'inquiry_type',
    'company_name',
    'contact_person',
    'email',
    'country',
    'product_code',
    'product_category',
    'required_standard',
    'target_market',
    'estimated_quantity',
    'target_price',
    'target_delivery_date',
    'message',
    'attachment',
    'status',
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