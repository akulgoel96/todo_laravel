<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function delete($handle)
    {
        $user = new User;
        //$id = $user->getUserId($handle);
        $message = $user->deleteUser($handle);
        return response() -> json($message[0], $message[1]);
    }

    public function getId($handle)
    {
        $user = new User;
        return response() -> json($user->getId($handle));
    }

    public function createNew(Request $request)
    {
        $name = $request->input('name');
        $handle = $request->input('handle');
        //echo "Hello";
        $user = new User;
        $message = $user->createUser($name, $handle);
        return response() -> json($message[0], $message[1]);
    }

    public function update(Request $request)
    {
        $old_handle = $request->input('old_handle');
        $new_handle = $request->input('new_handle');
        //echo $task_name;
        //echo $task_id;

        $user = new User;
        $message = $user->updateHandle($old_handle, $new_handle);
        return response() -> json($message[0], $message[1]);
    }

}
