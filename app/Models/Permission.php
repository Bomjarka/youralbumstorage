<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public const BLOCK_USER = 'block_user';
    public const UNBLOCK_USER = 'unblock_user';
    public const ADD_ROLE_TO_USER = 'add_role_to_user';
    public const REMOVE_ROLE_FROM_USER = 'remove_role_from_user';
    public const DELETE_USER = 'delete_user';
    public const CREATE_ROLE = 'create_role';
    public const EDIT_ROLE = 'edit_role';
    public const EDIT_USER = 'edit_user_data';
}
