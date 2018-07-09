<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class User extends Model
{
    //const TASK = 'task';
    protected $table = 'users';

    public function lists()
    {
        return $this->hasMany(Lists::class);
    }

    public function deleteUser($handle)
    {
        if (User::where('user_handle', '=', $handle)->exists())
        {
            $id = $this->getId($handle);
            $user = DB::table('users')->where('id', $id);

            //echo $user->pluck('user_name');

            $status = $user->delete();

            if($status === 0)
            {
                $message = "Failed to delete user";
            }

            else
            {
                $message = "User deleted successfully";
            }
        }

        else
        {
            $message = "No such user";
        }

        return $message;
    }

    public function getId($handle)
    {
        //echo "$handle <br>";

        $user_id = DB::table('users')->where('user_handle', $handle)->pluck('id');

        return $user_id;
    }

    public function create($name, $handle)
    {
        if (User::where('user_handle', '=', $handle)->exists())
        {
            return "Handle already taken by another user.";
        }

        else
        {
            DB::table('users')->insert(
                ['user_name' => $name, 'user_handle' => $handle]
            );

            return "User creation successful";
        }
    }

    public function updateHandle($old_handle, $new_handle)
    {
        if($old_handle == $new_handle)
        {
            return "Old and new handles are same. Please try again.";
        }

        elseif(User::where('user_handle', '=', $new_handle)->exists())
        {
            return "Handle already taken by another user.";
        }

        else
        {
            if (User::where('user_handle', '=', $old_handle)->exists())
            {
                DB::table('users')
                    ->where('user_handle', $old_handle)
                    ->update(['user_handle'=>$new_handle]);

                return "Handle updated successfully.";
            }

            else
            {
                return "No such user exists with the given handle.";
            }
        }
    }
}
