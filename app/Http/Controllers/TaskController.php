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

        $task = new Task;
        $message = $task->add($list_id, $task_name);
        return response() -> json($message[0], $message[1]);
    }

    public function getAll($list_id)
    {
        $tasks = new Task;
        $message = $tasks->getAll($list_id);
        return response() -> json($message[0], $message[1]);
    }

    public function delete($task_id)
    {
        $task = new Task;
        $message = $task->remove($task_id);
        return response() -> json($message[0], $message[1]);
    }

    public function update(Request $request)
    {
        $task_id = $request->input('task_id');
        $task_name = $request->input('task_name');

        $task = new Task;
        $message = $task->rename($task_id, $task_name);
        return response() -> json($message[0], $message[1]);
    }
}
