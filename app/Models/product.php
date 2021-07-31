<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class product extends Model
{
    use HasFactory;
    use SoftDeletes;
    const STATUS_ACTIVE = 'active';
    const STATUS_DRAFT  = 'draft';

}
