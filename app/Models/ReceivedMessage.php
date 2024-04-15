<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivedMessage extends Model

{
    protected $fillable = [
        'idSmartContact',
        'start_date',
        'end_date',
        'count'
    ];
    protected $table = 'received_messages';
    use HasFactory;
}
