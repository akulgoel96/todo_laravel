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
        return ['message' => $message];
    }

    public function getId($handle)
    {
        $user = new User;
        return response() -> json($user->getUserId($handle));
    }

    public function createNew(Request $request)
    {
        $name = $request->input('name');
        $handle = $request->input('handle');
        //echo "Hello";
        $user = new User;
        return response() -> json($user->createUser($name, $handle));
    }

}
