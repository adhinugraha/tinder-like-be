<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'age',
        'location',
    ];

    public function images()
    {
        return $this->hasMany(Image::class, 'person_id');
    }
    
    public function likes()
    {
        return $this->hasMany(Like::class, 'person_id');
    }
    
    public function likedBy()
    {
        return $this->hasMany(Like::class, 'user_id');
    }
    
    public function likedPeople()
    {
        return $this->belongsToMany(Person::class, 'likes', 'person_id', 'user_id')
            ->withPivot('is_like')
            ->wherePivot('is_like', true);
    }
    
    public function dislikedPeople()
    {
        return $this->belongsToMany(Person::class, 'likes', 'person_id', 'user_id')
            ->withPivot('is_like')
            ->wherePivot('is_like', false);
    }
}
