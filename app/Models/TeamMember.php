<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_team');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }
}
