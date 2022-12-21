<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain',
        'status',
        'char_counts',
    ];

    public const DOMAIN_STATUSES = [
        1 => 'Taken',
        0 => 'Available',
        -1 => 'Expired',
    ];
}
