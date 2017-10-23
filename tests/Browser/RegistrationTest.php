<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Support\Facades\Hash;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\InitialiseDatabaseTrait;


class RegistrationTest extends DuskTestCase
{
    use InitialiseDatabaseTrait;

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testRegistration()
    {
        $this->browse(function ($first) {
            $appUrl = env("APP_URL", "http://localhost:8000");

            $first->visit($appUrl . '/register')
                ->waitFor('.panel-body')
                ->type('#name', 'John Johnson')
                ->type('#email', 'john@gmail.com')
                ->type('#password', 'password')
                ->type('#password-confirm', 'password')
                ->press('Register')
                ->pause(2000)
                ->assertPathIs('/home')
                ->logout();

            $user = factory(User::class)->create([
                'name' => 'Marylin Manson',
                'email' => 'personal.jesus@infernalhell.com',
                'password' => Hash::make('rocknroll')
            ]);

            $first->visit($appUrl . '/register')
                ->waitFor('.panel-body')
                ->type('#name', $user->name)
                ->type('#email', $user->email)
                ->type('#password', 'rocknroll')
                ->type('#password-confirm', 'rocknroll')
                ->press('Register')
                ->pause(2000)
                ->assertPathIs('/register')
                ->waitFor('.help-block')
                ->assertSee('The email has already been taken.');

            $first->visit($appUrl . '/register')
                ->waitFor('.panel-body')
                ->type('#name', 'John Gotti')
                ->type('#email', 'gangstaparadize@omerta.com')
                ->type('#password', 'shootemall')
                ->type('#password-confirm', 'dontshootemall')
                ->press('Register')
                ->pause(2000)
                ->assertPathIs('/register')
                ->waitFor('.help-block')
                ->assertSee('The password confirmation does not match.');
        });
    }

    public function setUpTraits()
    {
        $this->backupDatabase();
        parent::setUpTraits();
    }
}
