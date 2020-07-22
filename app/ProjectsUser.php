<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectsUser extends Model
{

    protected $table = 'projects_user';

    protected $fillable = [
        'project_id', 'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function project() {
        return $this->belongsTo(Projects::class, 'id');
    }

    public function tasks() {
        return $this->hasMany(Tasks::class, 'projects_id');
    }

}
