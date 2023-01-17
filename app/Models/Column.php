<?php

namespace App\Models;

use App\Models\Card;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Column extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "title",
    ];

    public function cards() {
        return $this->hasMany(Card::class)->orderBy('position');
    }

    public function owned($card){
        return $card->column_id === $this->id;
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function($column) { 
            $column->cards()->delete();

        });
    }
}
