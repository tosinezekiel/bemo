<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Card;
use App\Models\Column;
use App\Constants\HttpStatus;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CardTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public $baseUrl;
    public $column;

    public function setUp() : void
    {
        parent::setUp();

        $this->baseUrl = config('app.url') . '/api';
        $this->column = Column::factory()->create();
    }

    public function test_that_card_title_is_required()
    {
        $column = Card::factory()->make([
            "title" => "",
            "description" => $this->faker->sentence($nbWords = 6, $variableNbWords = true)
        ]);

        $response = $this->json('POST', "{$this->baseUrl}/columns/{$this->column->id}/cards", $column->toArray(), ['Accept' => 'application/json'])
            ->assertStatus(HttpStatus::UNPROCESSABLE_ENTITY);
    }

    public function test_that_card_description_is_required()
    {
        $column = Card::factory()->make([
            "title" => $this->faker->text,
            "description" => ""
        ]);

        $response = $this->json('POST', "{$this->baseUrl}/columns/{$this->column->id}/cards", $column->toArray(), ['Accept' => 'application/json'])
            ->assertStatus(HttpStatus::UNPROCESSABLE_ENTITY);
    }


    public function test_that_card_can_be_created()
    {
        $column = Card::factory()->make();

        $response = $this->json('POST', "{$this->baseUrl}/columns/{$this->column->id}/cards", $column->toArray(), ['Accept' => 'application/json'])
            ->assertStatus(HttpStatus::OK);
    }

    public function test_that_card_to_be_updated_is_owned_by_the_authorized_column()
    {
        $data = Card::factory()->make();

        $card = Card::factory()->make();

        $testColumn = Column::factory()->create();
        
        $freshCard = $this->column->cards()->create($card->toArray());

        $response = $this->json('PUT', "{$this->baseUrl}/columns/{$testColumn->id}/cards/{$freshCard->id}", 
        $data->toArray(), 
        ['Accept' => 'application/json'])
            ->assertStatus(HttpStatus::UNAUTHORIZED);
    }

    public function test_that_column_can_be_updated()
    {
        $data = Card::factory()->make();

        $card = Card::factory()->make();

        $freshCard = $this->column->cards()->create($card->toArray());

        $response = $this->json('PUT', "{$this->baseUrl}/columns/{$this->column->id}/cards/{$freshCard->id}", $data->toArray(), ['Accept' => 'application/json'])
            ->assertStatus(HttpStatus::OK);
    }
}