<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Lists;

class ListsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAddListSuccessful()
    {
        $list = new Lists;
        $result = response()->json($list->createNew('Hello World', 'akul.goel')[0]);
        $this->assertSame(json_encode(['message' => 'List creation successful']),
            $result->getContent());
    }

    public function testAddListExistsAlready()
    {
        $list = new Lists;
        $result = response()->json($list->createNew('Important', 'akul.goel')[0]);
        $this->assertSame(json_encode(['message' => 'A list of the same name exists']),
            $result->getContent());
    }

    public function testGetAllHandleDoesNotExist()
    {
        $list = new Lists;
        $result = response()->json($list->getAll('blabla')[0]);
        $this->assertSame(json_encode(['message' => 'No such user exists']),
            $result->getContent());
    }

    public function testGetAllNoListExists()
    {
        $list = new Lists;
        $result = response()->json($list->getAll('user5')[0]);
        $this->assertSame(json_encode(['message' => 'No lists exists for the given user']),
            $result->getContent());
    }

    public function testGetAllListsSuccessful()
    {
        $list = new Lists;
        $result = response()->json($list->getAll('user1')[0]);

        $expected_lists = '{"5":"daily","29":"test_random"}';

        $this->assertSame($expected_lists,
            $result->getContent());
    }

    public function testRenameListDoesNotExist()
    {
        $list = new Lists;
        $result = response()->json($list->rename('blabla', 'akulgoel06')[0]);
        $this->assertSame(json_encode(['message' => 'No such list exists with the given name']),
            $result->getContent());
    }

    public function testRenameListSuccessful()
    {
        $list = new Lists;
        $result = response()->json($list->rename('Hello World', 'Hello')[0]);
        $this->assertSame(json_encode(['message' => 'List name updated successfully']),
            $result->getContent());
    }

    public function testRemoveListSuccessful()
    {
        $list = new Lists;
        $result = response()->json($list->remove('Hello')[0]);
        $this->assertSame(json_encode(['message' => 'List deleted successfully']),
            $result->getContent());
    }

    public function testRemoveListDoesNotExist()
    {
        $list = new Lists;
        $result = response()->json($list->remove('Hello')[0]);
        $this->assertSame(json_encode(['message' => 'No such list exists with the given name']),
            $result->getContent());
    }
}
