<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Support\Facades\Hash;
use Tests\InitialiseDatabaseTrait;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class LoginTest extends DuskTestCase
{
    use InitialiseDatabaseTrait;

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $this->browse(function ($first) {
            $appUrl = env("APP_URL", "http://localhost:8000");
            $user1 = factory(User::class)->create([
                'name' => 'John Johnson',
                'email' => 'john@gmail.com',
                'password' => Hash::make('password')
            ]);

            $first->visit($appUrl . '/login')
                ->waitFor('.panel-body')
                ->type('#email', $user1->email)
                ->type('#password', 'password')
                ->press('Login')
                ->pause(2000)
                ->assertPathIs('/home')
                ->logout();

            $first->visit($appUrl . '/login')
                ->waitFor('.panel-body')
                ->type('#email', $user1->email)
                ->type('#password', 'fakepassword')
                ->press('Login')
                ->pause(2000)
                ->assertPathIs('/login')
                ->waitFor('.help-block')
                ->assertSee('These credentials do not match our records.');
        });
    }


    public function setUpTraits()
    {
        $this->backupDatabase();
        parent::setUpTraits();
    }
}
