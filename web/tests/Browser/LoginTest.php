<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testloginFailEmail()
    {
        $user = factory(User::class)->create([
            'email' => 'testing2asdf@ex.com'
        ]);
        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', 'other@asdf.com')
                    ->type('password', 'secret')
                    ->press('Login')
                    ->assertSee('These credentials do not match our records.');
        });
    }

    public function testloginFailPass()
    {
        $user = factory(User::class)->create([
            'email' => 'testing2@ex.com'
        ]);
        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', 'testing2@ex.com')
                    ->type('password', 'qfewqefqfqef')
                    ->press('Login')
                    ->assertSee('These credentials do not match our records.');
        });
    }
}
