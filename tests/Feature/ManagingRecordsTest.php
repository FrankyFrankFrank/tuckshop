<?php

namespace Tests\Feature;

use Tests\BrowserKitTest;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Record;
use App\User;

class ManagingRecordsTest extends BrowserKitTest
{
    use DatabaseMigrations;

    public function test_can_view_a_record()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $this->visit('/records');

        $this->click('Add New');

        $this->type('Tester Record', 'title');
        $this->type('John Doe', 'artist');
        $this->type('1987', 'year');
        $this->type('Tested Records', 'label');
        $this->press('Submit');

        $this->assertEquals(1, count(Record::all()));

        $this->visit('/records');

        $this->see('Tester Record');
        $this->see('John Doe');
        $this->see('1987');
        $this->see('Tested Records');
    }

}
