<?php

namespace Tests\Feature\Admin;

class RestoreUsersTest extends \Monolog\Test\TestCase
{
    public function restore_user()
    {
        $user = factory(User::class)->create([
            'email' => 'miguelmartinez@gmail.com',
            'deleted_at' => now(),
        ]);

        $user->profile()->update([
            'deleted_at' => now(),
        ]);


        $user->profile()->restore($user->id);
        $user->restore($user->id);
        $this->assertDatabaseHas('users', [
            'email' => 'miguelmartinez@gmail.com',
            'deleted_at' => null,

        ])->assertDatabaseHas('user_profiles', [
            'deleted_at' => null,
        ]);
    }
}