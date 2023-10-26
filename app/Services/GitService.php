<?php

namespace App\Services;

use App\Models\GithubProject;
use App\Models\search;
use App\Services\Interfaces\IGitWrapper;

class GitService implements Interfaces\IGitService
{
    public IGitWrapper $gitWrapper;

    /**
     * @param IGitWrapper $gitWrapper
     */
    public function __construct(IGitWrapper $gitWrapper)
    {
        $this->gitWrapper = $gitWrapper;
    }


    /**
     * @param $query
     * @param $perPage
     * @param $page
     * @return void
     */
    public function getProjects($query, $perPage, $page)
    {
        $response = null;
        $page -= 1;
        if (isset($query)) {
            $search_data = search::where('search_text', $query)->first();

            if (isset($search_data->id)) {
                $response = GithubProject::where('search_id', $search_data->id)->skip($perPage * $page)->take($perPage)->get();
                search::where('id', $search_data->id)
                    ->update([
                        'updated_at' => date('Y-m-d H:i:s', time())
                    ]);

            } else {
                $projectItems = json_decode($this->gitWrapper->getProjects($query, $perPage, $page))->items;

                search::insert([
                    'search_text' => $query,
                    'created_at' => date('Y-m-d H:i:s', time()),
                    'updated_at' => date('Y-m-d H:i:s', time())
                ]);
                $search = search::where('search_text', $query)->first();
                foreach ($projectItems as $item) {
                    GithubProject::insert([
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

                $response = GithubProject::where('search_id', $search->id)->get();

            }
        }
        return $response;
    }

    /**
     * @param $query
     * @return void
     */
    public function delete($query): void
    {
        $search_data = search::where('id', $query['id'])->first();
        if (isset($search_data->id)) {
            GithubProject::where('search_id',  $search_data->id)->delete();
            search::where('id',  $search_data->id)->delete();
        }
    }
}
