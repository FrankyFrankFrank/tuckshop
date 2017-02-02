<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Record;

class ManagingRecordsTest extends TestCase
{
    public function test_can_create_new_record()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user);

        $this->post('/records', [
            'title' => 'Tester Record',
            'artist' => 'John Doe',
            'year' => '1987',
            'label' => 'Tested Records',
            'user_id' => $user->id,
        ]);

        $this->seeInDatabase('records', ['title' => 'Tester Record']);
    }
}
