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
        $validated = (object) $request->validated();
        $highest_order = Card::where('column_id', $column->id)->max('position');

        $card = new Card();
        $card->title = $validated->title;
        $card->description = $validated->description;
        $card->column_id = $column->id;
        $card->position = Card::where('column_id', $column->id)->count() > 0 ? $highest_order + 1 : 0;
        $card->save();
    }

    public function show(Card $card){
        $data = $card->refresh();
        return $this->success("Card retrieved successfully.", collect($data)->sortByDesc('updated_at'));
    }

    public function update(CardRequest $request, Column $column, Card $card){
        if(!$column->owned($card)){
            return $this->error("Unauthorized action.", [], HttpStatus::UNAUTHORIZED);
        }

        $card->update($request->validated());
        $data = $card->refresh();
        return $this->success("Card updated successfully.", collect($data)->sortByDesc('position'));
    }

    public function reorderCard(Request $request, Column $column, Card $card){
        if($column->id !== $card->column_id){
            $this->moveCard($column, $card);
            return $this->success("Card moved successfully.");
        }

        $cards = Card::where('column_id', $column->id)->orderBy('position')->get();

        $i = 0;
        foreach($cards as $columnCard){
            if($columnCard->id == $card->id){
                $columnCard->position = $request->position; 
            }else{
                $i = ($i === $request->position) ? $request->position + 1 : $i;
                $columnCard->position = $i;
                $i++;
            }
            $columnCard->save();
        }
        

        return $this->success("Card reordered successfully");
    }

    public function moveCard(Column $column, Card $card)
    {
        $highest_order = Card::where('column_id', $column->id)->max('position');
        $card->column_id = $column->id;
        $card->position = $highest_order + 1;
        $card->save();
    }
}
