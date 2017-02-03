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

    public function test_can_create_new_record()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->post('/records', [
            'title' => 'Tester Record',
            'artist' => 'John Doe',
            'year' => '1987',
            'label' => 'Tested Records',
        ]);

        $this->seeInDatabase('records', ['title' => 'Tester Record']);
    }
}
