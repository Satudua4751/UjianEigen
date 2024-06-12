<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trxpinjamdetail extends Model
{
    use HasFactory;

    protected $table = 'trxpinjamdetail';
    protected $fillable = [
        'idtrx', 'codeb', 'jmlpinjam'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'codeb');
    }
}
