<?php

namespace App\Models\Permissions;

use App\Models\Permissions\Group;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'display_name', 'group_id'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function roles()
   {
      return $this->belongsToMany(Role::class, 'permission_roles', 'permission_id', 'role_id');
   }
}
