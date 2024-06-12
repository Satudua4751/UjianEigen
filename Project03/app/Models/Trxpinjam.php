<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trxpinjam extends Model
{
    use HasFactory;

    protected $table = 'trxpinjam';
    protected $primaryKey = 'idtrx';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'idtrx', 'tgltrx', 'codem'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'codem');
    }

    public function details()
    {
        return $this->hasMany(Trxpinjamdetail::class, 'idtrx');
    }
}

