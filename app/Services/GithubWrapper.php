<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class GithubWrapper implements Interfaces\IGitWrapper
{

    /**
     * @param $query
     * @param $perPage
     * @param $page
     * @return Response
     */
    public function getProjects($query, $perPage, $page): Response
    {
        $url = 'https://api.github.com/search/repositories?q=' . $query;

        if (isset($perPage)) {
            $url .= '&per_page=' . $perPage;
        }
        if (isset($page)) {
            $url .= '&page=' . $page;
        }

        return Http::get($url);
    }
}
