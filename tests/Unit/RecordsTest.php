<?php

namespace Tests\Unit;

use Tests\BrowserKitTest;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Record;

class RecordsTest extends BrowserKitTest
{
	use DatabaseMigrations;

	/** @test **/
	function can_create_new_record()
	{
		$record = factory(Record::class)->create([
    		'title' => 'Test Record',
    		'artist' => 'Test Artist', 
    		'year' => 1999,
    		'label' => 'Third Man Records',
		]);

		$this->seeInDatabase('records', ['title' => 'Test Record']);
	}
}
