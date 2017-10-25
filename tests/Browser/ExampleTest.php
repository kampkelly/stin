<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $first, $second) {
         //   $browser->loginAs(User::find(1))
            $first->visit('/home')
                    ->assertSee('Signin')
                    ->clickLink('Signin')
                    ->assertSee('Login')
                    ->assertPathIs('/login')
                  //  ->loginAs(User::find(1))
                    ->type('email', 'kampkelly')
                    ->type('password', 'password')
                    ->press('Login')
                    ->assertSee('Pitch')
                    ->pause(500)
                    ->assertPathIs('/dashboard'); 
          //  $second->loginAs(User::find(1))
            $second->visit('/home')
                    ->assertSee('Signin')
                    ->clickLink('Signin')
                    ->assertSee('Login')
                    ->assertPathIs('/login')
                  //  ->loginAs(User::find(1))
                    ->type('email', 'johndoe')
                    ->type('password', 'password')
                    ->press('Login')
                    ->assertSee('Pitch')
                    ->pause(500)
                    ->assertPathIs('/dashboard'); 
        });
    }
}
