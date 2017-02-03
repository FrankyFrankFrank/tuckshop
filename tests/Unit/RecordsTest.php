<?php

namespace Tests\Unit;

use Tests\BrowserKitTest;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Record;
use App\User;

class RecordsTest extends BrowserKitTest
{
	use DatabaseMigrations;

	/** @test **/
	public function can_create_new_record()
	{
		$record = factory(Record::class)->create([
    		'title' => 'Test Record',
    		'artist' => 'Test Artist', 
    		'year' => 1999,
    		'label' => 'Third Man Records',
		]);

		$this->seeInDatabase('records', ['title' => 'Test Record']);
	}

	/** @test **/
	public function records_belong_to_a_user()
	{
		$user = factory(User::class)->create();
		$record = factory(Record::class)->create();

		$user->records()->save($record);

		$this->assertEquals(1, count($user->records->all()));
	}

	public function test_can_delete_a_record_belonging_to_user()
    {
        $user = factory(User::class)->create();
        $this->assertEquals(0, count(Record::all()));

        $record = factory(Record::class)->create();
        $user->records()->save($record);
        $this->assertEquals(1, count(Record::all()));

        $this->actingAs($user);
        $this->call('DELETE', '/records/' . $record->id);
        $this->assertEquals(0, count(Record::all()));
    }

    public function test_can_only_delete_record_belonging_to_user()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $this->assertEquals(0, count(Record::all()));
        $record = factory(Record::class)->create();
        $this->assertEquals(1, count(Record::all()));

        $user1->records()->save($record);

        $this->actingAs($user2);
        $this->call('DELETE', '/records/' . $record->id);
        $this->assertEquals(1, count(Record::all()));
    }
}
