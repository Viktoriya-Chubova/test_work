<?php

namespace App\Services;

use App\Models\github_project;
use App\Models\search;

interface IGitService
{
    public function getProjects($query, $perPage, $page);

    public function delete($query);
}

class GitService implements IGitService
{
    public $gitWrapper;
    public function __construct(IGitWrapper $gitWrapper)
    {
        $this->gitWrapper = $gitWrapper;
    }


    public function getProjects($query, $perPage, $page)
    {
        $page -= 1;


        if (isset($query)) {
            $search_data = search::where('search_text', $query)->first();

            if (isset($search_data->id)) {
                $response = github_project::where('search_id',  $search_data->id)->skip($perPage * $page)->take($perPage)->get();
                search::where('id', $search_data->id)
                    ->update([
                        'updated_at' => date('Y-m-d H:i:s', time())
                    ]);
                return $response;
            } else {
                $result = $this->gitWrapper->getProjects($query, $perPage, $page);
                $projectItems = json_decode($result)->items;

                search::insert([
                    'search_text' => $query,
                    'created_at' => date('Y-m-d H:i:s', time()),
                    'updated_at' => date('Y-m-d H:i:s', time())
                ]);
                $search = search::where('search_text', $query)->first();
                foreach ($projectItems as $item) {
                    github_project::insert([
                        'search_id' => $search->id,
                        'name' => $item->name,
                        'author' => $item->owner->login,
                        'stargazers' => $item->stargazers_count,
                        'watchers' => $item->watchers_count,
                        'html_url' => $item->html_url,
                        'created_at' => date('Y-m-d H:i:s', time()),
                        'updated_at' => date('Y-m-d H:i:s', time())
                    ]);
                }

                $response = github_project::where('search_id',  $search->id)->get();
                return $response;
            }
        }
    }

    public function delete($query)
    {
        $search_data = search::where('id', $query['id'])->first();
        if (isset($search_data->id)) {
            github_project::where('search_id',  $search_data->id)->delete();
            search::where('id',  $search_data->id)->delete();
        }
    }
}
