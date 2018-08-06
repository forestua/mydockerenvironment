<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class RegisterTest extends DuskTestCase
{
    /**
     * 
     *
     * @return void
     */
    public function testregisterShortPassword()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', 'test')
                    ->type('email', 'britov333@gmail.com')
                    ->type('password', 'sc')
                    ->type('password_confirmation', 'sc')
                    ->press('Register')
                    ->assertSee('The password must be at least 6 characters.');
        });
    }

    public function testregisterOK()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', 'test')
                    ->type('email', 'britov333@gmail.com')
                    ->type('password', 'secret')
                    ->type('password_confirmation', 'secret')
                    ->press('Register')
                    ->assertPathIs('/home');
        });
    }

    public function testregisterConfirmPassword()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                    ->type('name', 'test')
                    ->type('email', 'britov333@gmail.com')
                    ->type('password', 'secret_1')
                    ->type('password_confirmation', 'secret_2')
                    ->press('Register')
                    ->assertSee('The password confirmation does not match.');
        });
    }

    public function testregisterDuplicateEmail()
    {
        $user = factory(User::class)->create([
            'email' => 'testing1@example.com',
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/register')
                    ->type('name', 'test')
                    ->type('email', $user->email)
                    ->type('password', 'sc')
                    ->type('password_confirmation', 'sc')
                    ->press('Register')
                    ->assertNotNull($browser->element('strong'));
        });
        User::where('email' => $user->email)->delete();
    }

    /*public function registerDuplicatePassword()
    {
        $user = User::create([
            'name' => 'testinguser1',
            'email' => 'testing2@example.com',
            'password' => 'duplicatepassword'
        ]);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/register')
                    ->type('name', 'testinguser2')
                    ->type('email', 'testing3@example.com')
                    ->type('password', 'duplicatepassword')
                    ->type('password-confirm', 'duplicatepassword')
                    ->press('Login')
                    ->assertSee('The email has already been taken.');
        });
    }*/
}
