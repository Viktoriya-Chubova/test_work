<?php

namespace App\Services\Interfaces;

interface IGitService
{
    public function getProjects($query, $perPage, $page);

    public function delete($query);
}
