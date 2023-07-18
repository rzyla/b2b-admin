<?php

namespace App\Models\Application;

class ApplicationButtons
{
    private array $buttons;

    public function __construct()
    {
        $this->buttons = [];
    }

    public function add(string $name, string $route, string $class, string $ico)
    {
        $this->buttons[$name] = new ApplicationButtonsItem($name, $route, $class, $ico);
    }

    public function get()
    {
        return $this->buttons;
    }
}

class ApplicationButtonsItem
{
    public string $name;
    public string $route;
    public string $class;
    public string $ico;

    public function __construct(string $name, string $route, string $class, string $ico)
    {
        $this->name = $name;
        $this->route = $route;
        $this->class = $class;
        $this->ico = $ico;
    }
}