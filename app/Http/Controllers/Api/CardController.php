<?php

namespace App\Http\Controllers\Api;

use App\Models\Card;
use App\Models\Column;
use App\Traits\HasResponse;
use Illuminate\Http\Request;
use App\Constants\HttpStatus;
use App\Http\Requests\CardRequest;
use App\Http\Controllers\Controller;

class CardController extends Controller
{
    use HasResponse;
    
    public function store(CardRequest $request, Column $column){
        $column->cards()->create($request->validated());
    }

    public function update(CardRequest $request, Column $column, Card $card){
        if(!$column->owned($card)){
            return $this->error("Unauthorized action.", [], HttpStatus::UNAUTHORIZED);
        }

        $card->update($request->validated());

        return $this->success("Card updated successfully.", $card->refresh());
    }
}
