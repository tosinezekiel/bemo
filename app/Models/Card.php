<?php

namespace App\Models;

use App\Models\Column;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "title",
        "description",
        "position"
    ];

    public function column() {
        return $this->belongsTo(Column::class);
    }
}
