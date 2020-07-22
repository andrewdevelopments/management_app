<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'projects_id', 'user_id', 'owner', 'important', 'name', 'description', 'status', 'due_date'
    ];

    public function users() {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public function owners() {
        return $this->hasMany(User::class, 'id', 'owner');
    }

}
