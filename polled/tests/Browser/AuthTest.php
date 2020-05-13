<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\User;

class AuthTest extends DuskTestCase
{
    use DatabaseMigrations;
    use withFaker;


    public function testRegister()
    {
        $this->browse(function (Browser $browser) {
            $name = $this->faker->name;

            $browser->visit('/')
                    ->click('@register-link')
                    ->assertVisible('@register-heading')
                    ->type('@name-input', $name)
                    ->type('@email-input', $this->faker->safeEmail())
                    ->type('@password-input', 'helloworld')
                    ->type('@password-confirm-input', 'helloworld')
                    ->click('@register-button')
                    ->assertSee($name);
        });
    }

    public function testExistingUser()
    {
        $this->browse(function (Browser $browser) {

            $user = factory(User::class)->create();

            $browser->logout()
                    ->visit('/register')
                    ->type('name', $user->name)
                    ->type('email', $user->email)
                    ->type('password', 'helloworld')
                    ->type('password_confirmation', 'helloworld')
                    ->click('@register-button')
                    ->assertPresent('@error-field-email')
                    ->assertSee('The email has already been taken.');
        });
    }

  
    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $user = factory(User::class)->create();

            $browser->logout()
                    ->visit('/login')
                    ->type('@email-input', $user->email)
                    ->type('@password-input', 'helloworld')
                    ->click('@login-button')
                    ->assertSee(strtoupper('logout '. $user->name));
        });
    }

    public function testValidation()
    {
        $this->browse(function (Browser $browser) {
            $user = factory(User::class)->create();

            $browser->logout()
                    ->visit('/login')
                    ->type('@email-input', $user->email)
                    ->type('@password-input', 'this-is-the-wrong-password')
                    ->click('@login-button')
                    ->assertSee('These credentials do not match our records.');
        });
    }
    
    public function testLogout(){
		
		
   }
}
