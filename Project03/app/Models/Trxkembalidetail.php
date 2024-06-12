<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trxkembalidetail extends Model
{
    use HasFactory;

    protected $table = 'trxkembalidetail';
    protected $fillable = [
        'idtrx', 'codeb', 'jmlkembali'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'codeb');
    }
}
