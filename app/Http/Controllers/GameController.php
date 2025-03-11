<?php

namespace App\Http\Controllers;

use App\Http\Requests\Game\StoreGameRequest;
use App\Http\Requests\Game\UpdateGameRequest;
use App\Services\Game\EndGameService;
use App\Services\Game\GetGameService;
use App\Services\Game\StoreGameService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function show(int $id): ?JsonResponse
    {
        return response()->json((new GetGameService())->get($id));
    }

    public function store(StoreGameRequest $request): ?JsonResponse
    {
        return response()->json([
            'letters' => (new StoreGameService())->store()
        ]);
    }

    public function update(int $id, UpdateGameRequest $request): ?JsonResponse
    {
        return response()->json((new EndGameService())->update($id));
    }
}
