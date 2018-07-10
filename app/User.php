<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{
    protected $fillable = ['user_name', 'user_handle'];

    public function lists()
    {
        return $this->hasMany(Lists::class);
    }

    public function remove($handle)
    {
        if (User::where('user_handle', $handle)->exists())
        {
            $id = $this->getId($handle);
            $user = User::where('id', $id);

            $status = $user->delete();

            if($status === 0)
            {
                $message = "Failed to delete user";
                return [['message' => $message], 500];
            }

            else
            {
                $message = "User deleted successfully";
                return [['message' => $message], 200];
            }
        }

        else
        {
            $message = "No such user";
            return [['message' => $message], 404];
        }
    }

    public function getId($handle)
    {
        $user_id = User::where('user_handle', $handle)->pluck('id');

        return $user_id;
    }

    public function createNew($name, $handle)
    {
        if (User::where('user_handle', $handle)->exists())
        {
            $message = "Handle already taken by another user";
            return [['message' => $message], 409];
        }

        else
        {
            User::create(['user_name' => $name , 'user_handle' => $handle]);

            $message = "User creation successful";
            return [['message' => $message], 200];
        }
    }

    public function updateHandle($old_handle, $new_handle)
    {
        if($old_handle == $new_handle)
        {
            $message = "Old and new handles are same. Please try again";
            return [['message' => $message], 409];
        }

        elseif(User::where('user_handle', $new_handle)->exists())
        {
            $message = "Handle already taken by another user";
            return [['message' => $message], 409];
        }

        else
        {
            if (User::where('user_handle', $old_handle)->exists())
            {
                User::where('user_handle', $old_handle)->update(['user_handle'=>$new_handle]);

                $message = "Handle updated successfully";
                return [['message' => $message], 200];
            }

            else
            {
                $message = "No such user exists with the given handle";
                return [['message' => $message], 404];
            }
        }
    }
}
