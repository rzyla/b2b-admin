<?php

namespace App\Models\Application;

class Breadcrumb
{
    private array $breadcrumb;

    public function __construct()
    {
        $this->breadcrumb = [];
    }

    public function add(string $name, string $route, array $params)
    {
        foreach($this->breadcrumb as $value)
        {
            $value->active = false;
        }

        array_push($this->breadcrumb, new BreadcrumbItem($name, $route, true, $params));
    }

    public function get()
    {
        return $this->breadcrumb;
    }
}

class BreadcrumbItem
{
    public string $name;
    public string $route;
    public bool $active;
    public array $params;

    public function __construct(string $name, string $route, bool $active, array $params)
    {
        $this->name = $name;
        $this->route = $route;
        $this->active = $active;
        $this->params = $params;
    }
}