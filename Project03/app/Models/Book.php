<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $primaryKey = 'codeb';
    protected $table = 'book';
    public $incrementing = false;  // Disable auto-incrementing
    protected $keyType = 'string'; // Set the primary key type to string
    protected $fillable = [
        'codeb', 'title', 'author', 'stock'
    ];
}
