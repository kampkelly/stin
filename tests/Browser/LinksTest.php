<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class LinksTest extends DuskTestCase
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
                    ->visit('/dashboard')
                    ->clickLink('Fashion Design')
                    ->assertSee('The latest on Fashion and Design')
                    ->clickLink('Pitch an Innovation')
                    ->assertSee('Aim')
                    ->clickLink('Innovations')
                    ->assertSee('All Recent Startups')
                    ->clickLink('My Feeds')
                    ->assertSee('See the latest from your connections below')
                    ->clickLink('My Connections')
                    ->assertSee('Connection Requests')
                    ->clickLink('My Profile')
                    ->assertSee($user->fullname)
                    ->clickLink('Edit Profile')
                    ->assertSee('Highest Education')
                    ->clickLink('View Messages')
                    ->assertSee('My Threads')
                    ->visit('/'.$user->username.'/connections')
                    ->clickLink('Signout')
                    ->assertSee('Hello, Have an Idea? Pitch it. Get Invested!');
        });
    }
}
