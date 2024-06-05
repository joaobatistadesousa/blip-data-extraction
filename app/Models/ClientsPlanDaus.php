<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientsPlanDaus extends Model
{
    protected $table = 'clients_plan_daus';
    protected $fillable=[
        'idSmartContact',
        'start_date',
        'end_date',
        'count'
    ];
    

    use HasFactory;
}
