<?php

namespace App\Http\Controllers;

use App\Models\GithubProject;
use App\Models\search;
use App\Services;
use App\Services\Interfaces\IGitService;
use App\Services\Interfaces\IGitWrapper;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class GitHubController extends Controller
{
    private $gitService;
    public function __construct(IGitService $gitService)
    {
        $this->gitService = $gitService;
    }


    /**
     * @param Request $query
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function showSearch(Request $query)
    {
        $result = null;

        if(isset($query->search_text)){
            $result = $this->gitService->getProjects($query->search_text, $query->perPage, $query->page);
        }

        return view('search_git.search')
            ->with('result', $result)
            ->with('query', $query->search_text);
    }
}
