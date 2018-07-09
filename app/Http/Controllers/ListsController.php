<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Lists;

class ListsController extends Controller
{
    public function createNew(Request $request)
    {
        $name = $request->input('name');
        $handle = $request->input('handle');
        //echo "Hello";
        $lists = new Lists;
        return response() -> json($lists->create($name, $handle));
    }

    public function getAll($handle)
    {
        $lists = new Lists;
        return response() -> json($lists->getAll($handle));
    }

    public function delete($list_id)
    {
        $list = new Lists;
        //$id = $user->getUserId($handle);
        $message = $list->deleteList($list_id);
        return ['message' => $message];
    }

    public function update(Request $request)
    {
        $list_id = $request->input('list_id');
        $list_name = $request->input('list_name');
        //echo $task_name;
        //echo $task_id;

        $list = new Lists;
        return response() -> json($list->updateList($list_id, $list_name));
    }
}
