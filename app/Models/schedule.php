<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class schedule extends Model
{
    use HasFactory;
    protected $fillable = ['Dancer','Date','id_hours','Mail'];

    public function hours(){
        return $this->belongsTo(hour::class);
    }

}
