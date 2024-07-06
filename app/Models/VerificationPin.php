<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationPin extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'expired_at',
        'pin',
    ];

    protected $table = 'verification_pins';
}
