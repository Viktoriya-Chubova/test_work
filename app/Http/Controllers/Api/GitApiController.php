<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\IGitService;
use Illuminate\Http\Request;

class GitApiController extends Controller
{
    private $gitService;
    public function __construct(IGitService $gitService)
    {
        $this->gitService = $gitService;
        $this->middleware('auth:api');
    }

    public function show(Request $query)
    {
        $result = $this->gitService->getProjects($query->search_text, $query->perPage, $query->page);

        return response()->json([
            'status' => 'success',
            'todos' => $result,
        ]);
    }

    public function delete(Request $query)
    {
        $result = $this->gitService->delete($query);

        return $result;
    }
}
