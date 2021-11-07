<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;

    protected $fillable = [
        'ads_id', 'main_picture','url'
    ];

    public function ad_rel(){
        return $this->belongsTo(Ad::class, 'id','name');
    }
}
