<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    protected $fillable = ['list_name', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function getAll($handle)
    {
        if (User::where('user_handle', $handle)->exists())
        {
            $user = new User;
            $user_id = $user->getId($handle);

            $lists = Lists::where('user_id', $user_id)->pluck('list_name', 'id');

            if(count($lists) == 0)
            {
                $message = "No lists exists for the given user.";
                return [['message' => $message], 404];
            }

            return  [$lists, 200];
        }

        else
        {
            $message =  "No such user exists.";
            return [['message' => $message], 404];
        }
    }

    public function createNew($list_name, $handle)
    {
        $user = new User;

        if (User::where('user_handle', $handle)->exists())
        {
            $user_id = $user->getId($handle);

            if(Lists::where('user_id', $user_id)->where('list_name', $list_name)->exists())
            {
                $message = "A list of the same name exists.";
                return [['message' => $message], 409];
            }

            else
            {
                Lists::create(['user_id' => $user_id[0] , 'list_name' => $list_name]);

                $message = "List creation successful";
                return [['message' => $message], 200];
            }
        }

        else
        {
            $message = "No such user exists.";
            return [['message' => $message], 404];
        }
    }

    public function deleteList($list_id)
    {
        if (Lists::where('id', $list_id)->exists())
        {
            $list = Lists::where('id', $list_id);

            $status = $list->delete();

            if($status === 0)
            {
                $message = "Failed to delete list";
                return [['message' => $message], 500];
            }

            else
            {
                $message = "List deleted successfully";
                return [['message' => $message], 200];
            }
        }

        else
        {
            $message = "No such list exists with the given id.";
            return [['message' => $message], 404];
        }

    }

    public function updateList($list_id, $list_name)
    {
        if (Lists::where('id', $list_id)->exists())
        {
            Lists::where('id', $list_id)->update(['list_name'=>$list_name]);

            $message = "List name updated successfully.";
            return [['message' => $message], 200];
        }

        else
        {
            $message = "No such list exists with the given id.";
            return [['message' => $message], 404];
        }
    }
}
