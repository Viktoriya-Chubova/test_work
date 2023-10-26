<?php

namespace App\Services\Interfaces;

interface IGitWrapper
{
    public function getProjects($query, $perPage, $page);
}
