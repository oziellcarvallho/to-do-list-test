<?php

namespace App\Models\Permissions;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_roles', 'role_id' ,'permission_id');
    }

    public function users()
    {
   	    return $this->belongsToMany(User::class, 'role_users', 'role_id', 'user_id');
    }
}
