<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    public function list()
    {
        return $this->belongsTo(Lists::class);
    }

    public function add($list_id, $task_name)
    {
        if (Lists::where('id', '=', $list_id)->exists())
        {
            DB::table('tasks')->insert(
                ['task_desc' => $task_name, 'list_id' => $list_id]
            );

            return "Added task to the list.";
        }

        else
        {
            return "No such list exists";
        }
    }

    public function deleteTask($task_id)
    {
        if (Task::where('id', '=', $task_id)->exists())
        {
            $task = DB::table('tasks')->where('id', $task_id);

            //echo $user->pluck('user_name');

            $status = $task->delete();

            if($status === 0)
            {
                $message = "Failed to delete task";
            }

            else
            {
                $message = "Task deleted successfully";
            }

            return $message;
        }

        else
        {
            return "No such task exists with the given id.";
        }
    }

    public function getAll($list_id)
    {
        if (Lists::where('id', '=', $list_id)->exists())
        {
            $tasks = DB::table('tasks')
                    ->where('list_id', $list_id)
                    ->pluck('task_desc', 'id');

            if(count($tasks) == 0)
            {
                return "No task exists in this list.";
            }

            return $tasks;
        }

        else
        {
            return "No such list exists.";
        }
    }

    public function updateTask($task_id, $task_name)
    {
        if (Task::where('id', '=', $task_id)->exists())
        {
            DB::table('tasks')
                ->where('id', $task_id)
                ->update(['task_desc'=>$task_name]);

            return "Task updated successfully.";
        }

        else
        {
            return "No such task exists with the given id.";
        }
    }
}
