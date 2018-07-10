<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lists;

class ListsController extends Controller
{
    public function createNew(Request $request)
    {
        $name = $request->input('name');
        $handle = $request->input('handle');
        //echo "Hello";
        $lists = new Lists;
        $message = $lists->createNew($name, $handle);
        return response() -> json($message[0], $message[1]);
    }

    public function getAll($handle)
    {
        $lists = new Lists;
        $message = $lists->getAll($handle);
        return response() -> json($message[0], $message[1]);
    }

    public function delete($list_id)
    {
        $list = new Lists;
        //$id = $user->getUserId($handle);
        $message = $list->deleteList($list_id);
        return response() -> json($message[0], $message[1]);
    }

    public function update(Request $request)
    {
        $list_id = $request->input('list_id');
        $list_name = $request->input('list_name');
        //echo $task_name;
        //echo $task_id;

        $list = new Lists;
        $message = $list->updateList($list_id, $list_name);
        return response() -> json($message[0], $message[1]);
    }
}
