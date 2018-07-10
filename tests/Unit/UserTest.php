<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    const MSG = 'message';

    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testAddUserSuccessful()
    {
        $user = new User;
        $result = response()->json($user->createNew('Hello World', 'akulgoel96')[0]);
        $this->assertSame(json_encode(['message' => 'User creation successful']),
            $result->getContent());
    }

    public function testAddUserExists()
    {
        $user = new User;
        $result = response()->json($user->createNew('HelloWorld', 'akul.goel')[0]);
        $this->assertSame(json_encode(['message' => 'Handle already taken by another user']),
            $result->getContent());
    }

    public function testUpdateUserSameHandle()
    {
        $user = new User;
        $result = response()->json($user->updateHandle('akulgoel96', 'akulgoel96')[0]);
        $this->assertSame(json_encode(['message' => 'Old and new handles are same. Please try again']),
            $result->getContent());
    }

    public function testUpdateUserNewHandleTaken()
    {
        $user = new User;
        $result = response()->json($user->updateHandle('akulgoel96',
            'akul.goel')[0]);
        $this->assertSame(json_encode(['message' => 'Handle already taken by another user']),
            $result->getContent());
    }

    public function testUpdateUserDoesNotExist()
    {
        $user = new User;
        $result = response()->json($user->updateHandle('blabla',
            'akulgoel06')[0]);
        $this->assertSame(json_encode(['message' => 'No such user exists with the given handle']),
            $result->getContent());
    }

    public function testUpdateUserSuccessfully()
    {
        $user = new User;
        $result = response()->json($user->updateHandle('akulgoel96',
            'akulgoel64')[0]);
        $this->assertSame(json_encode(['message' => 'Handle updated successfully']),
            $result->getContent());
    }

    public function testRemoveUserSuccessfully()
    {
        $user = new User;
        $result = response()->json($user->remove('akulgoel64')[0]);
        $this->assertSame(json_encode(['message' => 'User deleted successfully']),
            $result->getContent());
    }

    public function testRemoveUserDoesNotExist()
    {
        $user = new User;
        $result = response()->json($user->remove('akulgoel64')[0]);
        $this->assertSame(json_encode(['message' => 'No such user']),
            $result->getContent());
    }
}
