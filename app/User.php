<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;


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
        $id = $this->getUserId($handle);

//        if($id == NULL)
//        {
//            $message = "No such user";
//        }
//
//        //echo "id is ".$id;
//
//        else
        {
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

        return $message;
    }

    public function getUserId($handle)
    {
        //echo "$handle <br>";

        $user_id = DB::table('users')->where('user_handle', $handle)->pluck('id');

        return $user_id;
    }

    public function createUser($name, $handle)
    {
        DB::table('users')->insert(
            ['user_name' => $name, 'user_handle' => $handle]
        );

        return "User creation successful";
    }
}
