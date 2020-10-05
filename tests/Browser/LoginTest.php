<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $user = User::find(random_int(1,5));
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
            ->type("username", $user->username)
            ->type)("password", $user->password);
            
        });
    }
}
