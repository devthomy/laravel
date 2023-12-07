<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $primaryKey = 'client_id';

    // Les attributs que vous pouvez assigner massivement.
    protected $fillable = [
        'last_name',
        'first_name',
        'email',
        'phone',
        'address',
    ];

}
