<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'description', 'status', 'responsible_email', 'responsible_id'
    ];

    public function responsible()
    {
        return $this->hasOne(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'task_users', 'task_id', 'user_id');
    }
}
