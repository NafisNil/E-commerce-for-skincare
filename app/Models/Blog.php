<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //
    protected $guarded = [];
    public function skintype(){
        return $this->belongsTo(Skintype::class, 'skintype_id');
    }
}
