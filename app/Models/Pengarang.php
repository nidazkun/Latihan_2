<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengarang extends Model
{
    use HasFactory;

    protected $table = 'pengarang';
    protected $guarded = [];

    // Relasi ke manga
    public function manga()
    {
        return $this->hasOne(Manga::class, 'pengarang_id', 'id');
    }
}
