<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurposeSection extends Model
{
    protected $fillable = [
        'image',
        'image_alt',
        'experience_value',
        'experience_label',
    ];
}