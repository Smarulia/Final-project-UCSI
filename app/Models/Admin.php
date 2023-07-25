<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model implements Authenticatable
{
    use AuthenticableTrait;
    use HasFactory;
        protected $table = 'admins';

}
