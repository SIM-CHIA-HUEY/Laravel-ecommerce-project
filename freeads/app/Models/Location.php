<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    // location has many ads
    public function ads(){
        return $this->hasMany(Ad::class,'id','name');
    }


}
