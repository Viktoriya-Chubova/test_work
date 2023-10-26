<?php

namespace App\Http\Controllers;

use App\Models\github_project;
use App\Models\search;
use App\Services;
use App\Services\IGitService;
use App\Services\IGitWrapper;
use Illuminate\Http\Request;

class GitHubController extends Controller
{
    private $gitService;
    public function __construct(IGitService $gitService)
    {
        $this->gitService = $gitService;
    }


    public function show_search(Request $query)
    {
        $result = null;


        $result = $this->gitService->getProjects($query->search_text, $query->perPage, $query->page);

        return view('search_git.search')
            ->with('result', $result)
            ->with('query', $query->search_text);
    }
}
