<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengawasan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function ppiu()
    {
        return $this->belongsTo(Ppiu::class, 'id_ppiu');
    }
}
