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
        "description",
        "position"
    ];

    public function cards() {
        return $this->hasMany(Card::class);
    }
}
