<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Village extends Model
{
    use HasFactory;

    protected $table = 'indonesia_villages';

    protected $fillable = [
        'code',
        'district_code',
        'name',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    protected $hidden = [
        // 'id',
        'created_at',
        'updated_at',
    ];
}
