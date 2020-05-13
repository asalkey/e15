<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testProfile()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Laravel');
        });
    }
    
    public function testCreatePolls
    {
		
	}
	
	public function testDeletePoll{
		
	}
	
	public function testViewPolls{
		
		
	}
	
	public function testUpdateProfile{
		
	}
	
	public function testAnswerPoll{
		
		
	}
}
