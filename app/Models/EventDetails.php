<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventDetails extends Model

{
    protected $fillable = ['idSmartContact', 'category', 'action', 'storageDate', 'count'];
    protected $table = 'event_details';
    use HasFactory;
}
