<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\InitialiseDatabaseTrait;

class ChatTest extends DuskTestCase
{
    use DatabaseMigrations, InitialiseDatabaseTrait;

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testChat()
    {
        $appUrl = env("APP_URL", "http://localhost");
        $this->browse(function ($first, $second) {
            $user1 = factory(User::class)->create([
                'name' => 'John Johnson',
                'email' => 'john@gmail.com',
                'password' => bcrypt('password1')
            ]);
            $user2 = factory(User::class)->create([
                'name' => 'Timmy Morgan',
                'email' => 'timmy@yahoo.com',
                'password' => bcrypt('password2')
            ]);
            $first->loginAs($user1)
                ->visit($appUrl . '/chat')
                ->waitFor('.chat-composer')
                ->type('#message', 'Hey!')
                ->press('Send');

            $second->loginAs($user2)
                ->visit($appUrl . '/chat')
                ->waitFor('.chat-composer')
                ->type('#message', 'Hey Test U1')
                ->press('Send');

            $second->assertSee('Active users: 2');

            $second->waitForText('Hey!')
                ->assertSee($user1->name);

            $first->waitForText('Hey Test U1')
                ->assertSee($user2->name);
        });
    }

    public function setUpTraits()
    {
        $this->backupDatabase();
        parent::setUpTraits();
    }
}
