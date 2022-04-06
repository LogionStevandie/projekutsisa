<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaPengiriman extends Model
{
    use HasFactory;
     protected $table = 'notaPengiriman';
    protected $primaryKey='idnotaPengiriman';
}
