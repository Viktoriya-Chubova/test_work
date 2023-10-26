<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

interface IGitWrapper
{
    public function getProjects($query, $perPage, $page);
}

class GitHubWrapper implements IGitWrapper
{
    public function getProjects($query, $perPage, $page)
    {
        $url = 'https://api.github.com/search/repositories?q=' . $query;

        if (isset($perPage)) {
            $url .= '&per_page=' . $perPage;
        }
        if (isset($page)) {
            $url .= '&page=' . $page;
        }

        $response = Http::get($url);
        return $response;
    }
}
