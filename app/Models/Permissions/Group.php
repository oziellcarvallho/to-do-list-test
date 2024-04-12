<?php

namespace App\Models\Permissions;

use App\Models\Permissions\Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
