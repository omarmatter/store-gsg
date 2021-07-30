<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 'active';
    const STATUS_DRAFT  = 'draft';

}
