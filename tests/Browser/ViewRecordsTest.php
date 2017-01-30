<?php

namespace Tests\Feature;

use Tests\DuskTestCase;
use Laravel\Dusk\Chrome;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Record;

class ViewRecordsTest extends DuskTestCase
{
	use DatabaseMigrations;
	
    /** @test **/
    function can_view_a_record()
    {
    	$record = factory(Record::class)->create([
    		'title' => 'Test Record',
    		'artist' => 'Test Artist', 
    		'year' => 1999,
    		'label' => 'Third Man Records',
		]);

        $this->assertDatabaseHas('records', ['title' => 'Test Record']);

        $this->browse( function ($browser) {
    		$browser->visit('/records');
    		$browser->assertSee('Test Record');
    		$browser->assertSee('Test Artist');
    		$browser->assertSee('1999');
    		$browser->assertSee('Third Man Records');
        });
    }
}
