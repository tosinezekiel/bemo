<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Card;
use App\Models\Column;
use App\Constants\HttpStatus;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ColumnTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public $baseUrl;

    public function setUp() : void
    {
        parent::setUp();

        $this->baseUrl = config('app.url') . '/api';
    }

    public function test_that_column_title_is_required()
    {
        $column = Column::factory()->make([
            "title" => ""
        ]);
        $response = $this->json('POST', $this->baseUrl . '/columns', $column->toArray(), ['Accept' => 'application/json'])
            ->assertStatus(HttpStatus::UNPROCESSABLE_ENTITY);
    }


    public function test_that_column_can_be_created()
    {
        $column = Column::factory()->make();

        $response = $this->json('POST', $this->baseUrl . '/columns', $column->toArray(), ['Accept' => 'application/json'])
            ->assertStatus(HttpStatus::OK);
    }


    public function test_that_columns_can_be_fetched()
    {
        $columns = Column::factory()->count(5)->create();
        $response = $this->json('GET', $this->baseUrl . '/columns', ['Accept' => 'application/json'])
            ->assertStatus(HttpStatus::OK)
            ->assertJsonStructure([
                'message',
                'status',
                "data"
            ]);
    }

    public function test_that_column_can_be_deleted()
    {
        $column = Column::factory()->create();    
        $response = $this->json('DELETE', "api/columns/{$column->id}", ['Accept' => 'application/json'])
            ->assertStatus(HttpStatus::OK);
    }

    public function test_that_cards_belonging_to_column_gets_deleted_when_column_is_deleted()
    {
        $column = Column::factory()->create();
        $card = Card::factory()->make();

        $freshCard = $column->cards()->create($card->toArray());

        $response = $this->json('DELETE', "api/columns/{$column->id}", ['Accept' => 'application/json'])
            ->assertStatus(HttpStatus::OK);

        $this->assertNotNull($column->cards->fresh()); 
    }
}