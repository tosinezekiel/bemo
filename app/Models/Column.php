<?php

namespace App\Models;

use App\Models\Card;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Column extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
    ];

    public function cards() {
        return $this->hasMany(Card::class);
    }

    public function owned($card){
        return $card->column_id === $this->id;
    }
}
