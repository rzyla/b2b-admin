<?php

namespace App\Models\Dto;

use Illuminate\Database\Eloquent\Casts\Attribute;

class GridDto 
{
    private ?string $search = '';
    private array $filters;
    private GridOrderByDto $orderBy;

    public function __construct()
    {
        $this->filters = [];
        $this->orderBy = new GridOrderByDto();
    }

    public function search()
    {
        return $this->search;
    }

    public function setSearch(?string $search)
    {
        $this->search = $search;
    }

    public function addFilter(string $key, string $value)
    {
        if(!empty($key))
        {
            $this->filters[$key] = $value;
        }
    }

    public function orderBy(?string $by = null, ?string $dir = null)
    {
        return $this->orderBy;
    }

    public function setOrderBy(?string $by = null, ?string $dir = null)
    {
        $this->orderBy = new GridOrderByDto($by, $dir);
    }
}

class GridOrderByDto
{
    public ?string $by;
    public ?string $dir;

    public function __construct(?string $by = null, ?string $dir = null)
    {
        $this->by = $by;
        $this->dir = $dir;
    }
}