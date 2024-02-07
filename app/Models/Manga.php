<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manga extends Model
{
    use HasFactory;
    protected $table = 'manga';
    protected $guarded = [];

    // Relasi ke pengarang
    public function pengarang()
    {
        return $this->belongsTo(Pengarang::class, 'pengarang_id', 'id');
    }

}
