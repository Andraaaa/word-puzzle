<?php

namespace App\Http\Controllers;

use App\Services\Submission\GetLeaderboardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index(Request $request) :?JsonResponse
    {
        return response()->json((new GetLeaderboardService())->get());
    }
}
