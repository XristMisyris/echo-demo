<?php

namespace App\Http\Controllers;

use App\Task;
use App\Team;
use App\Http\Requests;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Show the task detail screen.
     *
     * @param  Request  $request
     * @param  Team  $team
     * @param  Task  $task
     * @return Response
     */
    public function show(Request $request, Team $team, Task $task)
    {
        abort_unless($request->user()->onTeam($team), 403);
        abort_unless($team->id === $task->team->id, 403);

        return view('tasks.show', ['task' => $task]);
    }
}
