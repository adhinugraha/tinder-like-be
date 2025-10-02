<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'person_id',
        'user_id',
        'is_like',
    ];
    
    public function person()
    {
        return $this->belongsTo(User::class, 'person_id');
    }
}
