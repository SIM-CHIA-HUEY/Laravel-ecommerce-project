<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
      'title', 'description','price','image','category_id','location_id','users_id','active'
    ];

    public function category_rel(){
        return $this->belongsTo(Category::class, 'id','name');
    }

    public function user_rel(){
        return $this->belongsTo(User::class, 'id','name');
    }

    public function location_rel(){
        return $this->belongsTo(Location::class, 'id','name');
    }



}
