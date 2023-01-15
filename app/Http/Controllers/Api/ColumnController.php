<?php

namespace App\Http\Controllers\Api;

use App\Models\Column;
use App\Traits\HasResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ColumnRequest;

class ColumnController extends Controller
{
    use HasResponse;

    public function index(){
        $columns = Column::with('cards')->get();

        return $this->success("Columns retrieved successfully.", $columns);
    }

    public function store(ColumnRequest $request){
        $data = $request->validated();

        $column = Column::create($data);

        return $this->success("Column saved successfully.", $column);
    }

    public function show(Column $column){
        $column->load('cards');

        return $this->success("Column retrieved successfully.", $column);
    }

    public function update(Request $request, Column $column){
        $data = $request->validate([
            "title" => "required",
            "description" => "required",
        ]);

        $column = Column::update($data);

        return $this->success("Column updated successfully.", $column);
    }

    public function destroy(Column $column){
        $column->delete();

        return $this->success("Column deleted successfully.");
    }
}
