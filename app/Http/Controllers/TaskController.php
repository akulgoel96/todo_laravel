<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function createNew(Request $request)
    {
        $list_id = $request->input('list_id');
        $task_name = $request->input('task_name');
        //echo "Hello";
        $task = new Task;
        return response() -> json($task->add($list_id, $task_name));
    }

    public function getAll($list_id)
    {
        $tasks = new Task;
        //echo $user_id;
        return response() -> json($tasks->getAll($list_id));
    }

    public function delete($task_id)
    {
        $task = new Task;
        //$id = $user->getUserId($handle);
        $message = $task->deleteTask($task_id);
        return ['message' => $message];
    }

    public function update(Request $request)
    {
        $task_id = $request->input('task_id');
        $task_name = $request->input('task_name');
        //echo $task_name;
        //echo $task_id;

        $task = new Task;
        return response() -> json($task->updateTask($task_id, $task_name));
    }
}
