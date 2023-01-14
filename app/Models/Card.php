<?php

namespace App\Models;

use App\Models\Column;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
        "position"
    ];

    public function column() {
        return $this->belongsTo(Column::class);
    }
}
