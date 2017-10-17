<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ChatTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testChat()
    {
        //$this->seed('TestsSeeder');

        $this->browse(function ($first, $second) {
            $first->loginAs(User::find(1))
                ->visit('http://localhost:8000/chat')
                ->waitFor('.chat-composer');

            $second->loginAs(User::find(2))
                ->visit('http://localhost:8000/chat')
                ->waitFor('.chat-composer')
                ->type('#message', 'Hey Test U1')
                ->press('Send');

            $first->waitForText('Hey Test U1')
                ->assertSee(User::find(2)->name);
        });
    }
}
