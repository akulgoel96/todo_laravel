<?php

namespace Tests\Unit;

use App\Task;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAddSuccessful()
    {
        $task = new Task;
        $result = response()->json($task->add('1', 'test_task')[0]);
        $this->assertSame(json_encode(['message' => 'Added task to the list']),
            $result->getContent());
    }

    public function testAddTaskExistsAlready()
    {
        $task = new Task;
        $result = response()->json($task->add('1', 'test_task')[0]);
        $this->assertSame(json_encode(['message' => 'A task of the same name exists']),
            $result->getContent());
    }

    public function testGetAllListDoesNotExist()
    {
        $task = new Task;
        $result = response()->json($task->getAll('blabla')[0]);
        $this->assertSame(json_encode(['message' => 'No such list exists']),
            $result->getContent());
    }

    public function testGetAllNoTaskExists()
    {
        $task = new Task;
        $result = response()->json($task->getAll('29')[0]);
        $this->assertSame(json_encode(['message' => 'No task exists in this list']),
            $result->getContent());
    }

    public function testGetAllListsSuccessful()
    {
        $task = new Task;
        $result = response()->json($task->getAll('5')[0]);
        $expected_lists = '["brush","read magazine"]';
        $this->assertSame($expected_lists, $result->getContent());
    }

    public function testRenameTaskDoesNotExist()
    {
        $task = new Task;
        $result = response()->json($task->rename('test_blabla', 'test_random')[0]);
        $this->assertSame(json_encode(['message' => 'No such task exists with the given name']),
            $result->getContent());
    }

    public function testRenameTaskSuccessful()
    {
        $task = new Task;
        $result = response()->json($task->rename('test_task', 'test_task1')[0]);
        $this->assertSame(json_encode(['message' => 'Task name updated successfully']),
            $result->getContent());
    }

    public function testRemoveTaskSuccessful()
    {
        $task = new Task;
        $result = response()->json($task->remove('test_task1')[0]);
        $this->assertSame(json_encode(['message' => 'Task deleted successfully']),
            $result->getContent());
    }

    public function testRemoveTaskDoesNotExist()
    {
        $task = new Task;
        $result = response()->json($task->remove('test_task1')[0]);
        $this->assertSame(json_encode(['message' => 'No such task exists with the given name']),
            $result->getContent());
    }
}
