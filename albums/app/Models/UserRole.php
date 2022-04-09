<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $user_id
 * @property int $role_id
 */

class UserRole extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['user_id', 'role_id'];
}
