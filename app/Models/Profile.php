<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];
    
    public function profileImage()
    {
        $imagePath = ($this->image) ? $this->image : 'profile/tBQZvpk9mr9sjIuljwiiGS4DGDONNqiJWwLio3YC.png';
       return '/storage/' .$imagePath; 
    }

    public function user()
    {
       return $this->belongsTo(User::class);
    }

    public function followers()
    {  
        return $this->belongsToMany(User::class);
    }
}
