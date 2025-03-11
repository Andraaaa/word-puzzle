<?php

namespace App\Http\Controllers;

use App\Services\Game\GameResultService;
use Illuminate\Http\Request;

class GameResultsController extends Controller
{
    public function __invoke(int $id)
    {
        return response()->json((new GameResultService())->get($id));
    }
}
