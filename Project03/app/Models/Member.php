<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $primaryKey = 'codem';
    protected $table = 'member';
    public $incrementing = false;  // Disable auto-incrementing
    protected $keyType = 'string'; // Set the primary key type to string
    protected $fillable = [
        'codem', 'name', 'stts'
    ];
}
