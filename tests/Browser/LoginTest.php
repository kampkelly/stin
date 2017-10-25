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
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $user = User::find(1);
            $browser->loginAs(User::find(1))
                 //   ->assertSee('Pitch')
                    ->visit('/'.$user->username.'/connections')
                    ->clickLink('Edit Profile')
                    ->assertSee('Country');
                   // ->assertPathIs('/startups'); 
        });
    }
}
