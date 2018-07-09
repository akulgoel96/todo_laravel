<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lists extends Model
{
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
        if (User::where('user_handle', '=', $handle)->exists())
        {
            $user = new User;
            $user_id = $user->getId($handle);

            $lists = DB::table('lists')
                    ->where('user_id', $user_id)
                    ->pluck('list_name', 'id');

            if(count($lists) == 0)
            {
                return "No lists exists for the given user.";
            }

            return  $lists;
        }

        else
        {
            return "No such user exists.";
        }
    }

    public function create($list_name, $handle)
    {
        $user = new User;

        if (User::where('user_handle', '=', $handle)->exists())
        {
            $user_id = $user->getId($handle);

            DB::table('lists')->insert(
                ['list_name' => $list_name, 'user_id' => $user_id[0]]
            );

            return "List creation successful";
        }

        else
        {
            return "No such user exists.";
        }
    }

    public function deleteList($list_id)
    {
        $list = DB::table('lists')->where('id', $list_id);

        //echo $user->pluck('user_name');

        $status = $list->delete();

        if($status === 0)
        {
            $message = "Failed to delete list";
        }

        else
        {
            $message = "List deleted successfully";
        }

        return $message;
    }

    public function updateList($list_id, $list_name)
    {
        if (Lists::where('id', '=', $list_id)->exists())
        {
            DB::table('lists')
                ->where('id', $list_id)
                ->update(['list_name'=>$list_name]);

            return "List name updated successfully.";
        }

        else
        {
            return "No such list exists with the given id.";
        }
    }
}
