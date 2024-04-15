<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SentMessage extends Model
{
    protected $fillable = [
        'idSmartContact',
        'start_date',
        'end_date',
        'count'
    ];
    protected $table = 'sentMessage';
    use HasFactory;
}
