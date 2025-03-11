<?php

namespace App\Http\Controllers;

use App\Services\Submission\StoreSubmissionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function store(Request $request): ?JsonResponse
    {
        return response()->json((new StoreSubmissionService())->store($request->all()));
    }
}
