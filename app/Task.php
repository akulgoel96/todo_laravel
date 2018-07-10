<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['task_desc', 'list_id'];

    public function list()
    {
        return $this->belongsTo(Lists::class);
    }

    public function add($list_id, $task_name)
    {
        if (Lists::where('id', $list_id)->exists())
        {
            if(Task::where('list_id', $list_id)->where('task_desc', $task_name)->exists())
            {
                $message = "A task of the same name exists";
                return [['message' => $message], 409];
            }

            else
            {
                Task::create(['list_id' => $list_id, 'task_desc' => $task_name]);

                $message = "Added task to the list";
                return [['message' => $message], 200];
            }
        }

        else
        {
            $message = "No such list exists";
            return [['message' => $message], 404];
        }
    }

    public function remove($task_id)
    {
        if (Task::where('id', $task_id)->exists())
        {
            $task = Task::where('id', $task_id);

            $status = $task->delete();

            if($status === 0)
            {
                $message = "Failed to delete task";
                return [['message' => $message], 500];
            }

            else
            {
                $message = "Task deleted successfully";
                return [['message' => $message], 200];
            }
        }

        else
        {
            $message = "No such task exists with the given id";
            return [['message' => $message], 404];
        }
    }

    public function getAll($list_id)
    {
        if (Lists::where('id', $list_id)->exists())
        {
            $tasks = Task::where('list_id', $list_id)->pluck('task_desc', 'id');

            if(count($tasks) == 0)
            {
                $message = "No task exists in this list";
                return [['message' => $message], 404];
            }

            return [$tasks, 200];
        }

        else
        {
            $message = "No such list exists";
            return [['message' => $message], 404];
        }
    }

    public function rename($task_id, $task_name)
    {
        if (Task::where('id', $task_id)->exists())
        {
            Task::where('id', $task_id)->update(['task_desc'=>$task_name]);

            $message = "Task updated successfully";
            return [['message' => $message], 200];
        }

        else
        {
            $message = "No such task exists with the given id";
            return [['message' => $message], 404];
        }
    }
}
