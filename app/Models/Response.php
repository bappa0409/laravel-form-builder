<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    public function responseFields() {
        return $this->hasMany(FieldResponse::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
