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

    public function delete($list_name)
    {
        $list = new Lists;
        $message = $list->remove($list_name);
        return response() -> json($message[0], $message[1]);
    }

    public function update(Request $request)
    {
        $list_id = $request->input('old_list_name');
        $list_name = $request->input('new_list_name');

        $list = new Lists;
        $message = $list->rename($list_id, $list_name);
        return response() -> json($message[0], $message[1]);
    }
}
