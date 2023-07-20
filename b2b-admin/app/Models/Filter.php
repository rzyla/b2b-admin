<?php

namespace App\Models;

use Illuminate\Support\Facades\Session;

class Filter
{
    public FilterPage $index;
    public FilterPage $edit;
    private ?string $prefix;
    private ?string $action;

    public function init(?string $prefix = null, ?string $action = null)
    {
        $this->prefix = $prefix;
        $this->action = $action;

        $session = session()->all();

        if(!array_key_exists($this->sessionKey(), $session))
        {
            $this->index = new FilterPage();
            $this->edit = new FilterPage();
            $this->save();
        }
        else
        {
            $session = session($this->sessionKey());
            $json = json_decode($session);

            $this->index = new FilterPage
            (
                (array)$json->index->attributes, 
                (array)$json->index->filters, 
                (array)$json->index->show,
                $json->index->orderBy,
                $json->index->orderDir
            );

            $this->edit = new FilterPage
            (
                (array)$json->edit->attributes, 
                (array)$json->edit->filters, 
                (array)$json->edit->show,
                $json->edit->orderBy,
                $json->edit->orderDir
            );
        }
    }

    public function getPrefix()
    {
        return $this->prefix;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getAttribute(string $key)
    {
        $action = $this->action;

        return array_key_exists($key, $this->$action->attributes) 
            ? $this->$action->attributes[$key]
            : null ;
    }

    public function getAttributes() : array
    {
        $action = $this->action;
        return $this->$action->attributes;
    }

    public function setAttribute(string $key, ?string $value = null)
    {
        $action = $this->action;
        $this->$action->attributes[$key] = $value;
        $this->save();
    }

    public function getFilter(string $key)
    {
        $action = $this->action;

        return array_key_exists($key, $this->$action->filters) 
            ? $this->$action->filters[$key]
            : null ;
    }

    public function setFilter(string $key, ?string $value = null)
    {
        $action = $this->action;
        $this->$action->filters[$key] = $value;
        $this->save();
    }

    public function initShow(?array $array = [])
    {
        $action = $this->action;

        if(!empty($array))
        {
            foreach($array as $key => $value)
            {
                if(!array_key_exists($key, $this->$action->show))
                {
                    $this->setShow($key, $value);
                }
            }
        }
    }

    public function getShow(string $key)
    {
        $action = $this->action;

        return array_key_exists($key, $this->$action->show) 
            ? $this->$action->show[$key]
            : null ;
    }

    public function setShow(string $key, ?bool $value = null)
    {
        $action = $this->action;
        $this->$action->show[$key] = $value;
        $this->save();
    }

    public function getOrderBy()
    {
        $action = $this->action;
        return $this->$action->orderBy;
    }

    public function setOrderBy(?string $value = null)
    {
        $action = $this->action;
        $this->$action->orderBy = $value;
        $this->save();
    }

    public function getOrderDir()
    {
        $action = $this->action;
        return $this->$action->orderDir;
    }

    public function setOrderDir(?string $value = null)
    {
        $action = $this->action;
        $this->$action->orderDir = $value;
        $this->save();
    }

    private function sessionKey() : string
    {
        return 'filter_' . $this->prefix;
    }

    private function save()
    {
        session([$this->sessionKey() => json_encode($this)]);
    }
}

class FilterPage
{
    public array $attributes;
    public array $filters;
    public array $show;
    public ?string $orderBy;
    public ?string $orderDir;

    public function __construct(?array $attributes = [], ?array $filters = [], ?array $show = [], 
        ?string $orderBy = null, ?string $orderDir = null)
    {
        $this->attributes = $attributes;
        $this->filters = $filters;
        $this->show = $show;
        $this->orderBy = $orderBy;
        $this->orderDir = $orderDir;
    }
}