<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Card;
use App\Traits\HasResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    use HasResponse;

    public function clientToken(Request $request){

        $query = Card::query();

        $request->whenFilled('date', function ($input) use ($query){
            $query->whereBetween('created_at', [Carbon::parse($input), now()]);
        });

        $request->whenFilled('status', function ($input) use ($query) {
            $query->when($input === '1', fn($query, $input) => $query->whereNull('deleted_at'))
            ->when($input === '0', fn($query, $input) => $query->onlyTrashed());
        }, function() use ($query) {
            $query->withTrashed();
        });


        return $this->success("Card retrieved successfully.", $query->get());
    }
}
