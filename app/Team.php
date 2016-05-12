<?php

namespace App;

use Laravel\Spark\Team as SparkTeam;

class Team extends SparkTeam
{
    /**
     * Get all of the tasks belonging to the team.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
