<?php

namespace App\Models;

use App\Models\Application\ApplicationBreadcrumb;
use App\Models\Application\ApplicationButtons;
use App\Models\Application\ApplicationFilters;
use App\Models\Application\ApplicationMeta;
use App\Models\Application\ApplicationUser;
use Illuminate\Support\Facades\Session;

class Application 
{
    private string $name;
    private ?string $title;
    private ?string $prefix;
    private string $success;
    public string $uploadSourceDir;
    public string $uploadThumbsDir;
    private int $minimum_password_length = 6;
    private int $paginate = 20;
    public ApplicationBreadcrumb $breadcrumb;
    public ApplicationButtons $buttons;
    public ApplicationMeta $meta;
    public ApplicationUser $user;
    public ApplicationFilters $filters;

    public function __construct(?string $prefix = null, ?User $user = null)
    {
        $this->meta = new ApplicationMeta();
        $this->buttons = new ApplicationButtons();
        $this->filters = new ApplicationFilters();
        $this->prefix = $prefix;

        $this->initPaths();
        $this->initLocalizer();
        $this->initBreadcrumb();
    }

    private function initPaths()
    {
        $this->uploadSourceDir = public_path('uploads/') . $this->prefix;
        $this->uploadThumbsDir = public_path('thumbs/uploads/') . $this->prefix;
    }

    private function initLocalizer()
    {
        $this->name = __('view.application.name');
        $this->meta->title = __('view.application.default.title');
    }

    private function initBreadcrumb()
    {
        $this->breadcrumb = new ApplicationBreadcrumb();
        $this->breadcrumb->add(__('view.sidebar.link.dashboard'), 'dashboard', []);

        if(!empty($this->prefix))
        {
            $this->breadcrumb->add(__('view.sidebar.link.' . $this->prefix), $this->prefix, []);
        }
    }
    
    public function initSessionMessages()
    {
        $this->success = !empty(Session::get('success')) ? Session::get('success') : '';
    }

    public function initUser(?User $user)
    {
        $this->user = new ApplicationUser($user);
    }

    public function initCollapseCards($cardsToHide)
    {
        foreach($cardsToHide as $key => $value)
        {
            if(!$this->existsFilter($key))
            {
                $this->setFilter($key, $value);
            }
        }
    }

    public function minimumPasswordLength()
    {
        return $this->minimum_password_length;
    }

    public function paginate()
    {
        return $this->paginate;
    }

    public function getPrefix()
    {
        return $this->prefix;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setTitle(?string $title)
    {
        return $this->title = $title;
    }

    public function getTitle()
    {
        if(!empty($this->title))
        {
            return $this->title;
        }

        $breadcrumb = $this->breadcrumb->get();
        return count($breadcrumb) == 1 ? $breadcrumb[0]->name : $breadcrumb[1]->name;
    }

    public function getFilter(string $key)
    {
        return $this->filters->get($this->prefix, $key, 'filters');
    }

    public function getAttributes()
    {
        return $this->filters->getArray($this->prefix, 'attributes');
    }

    public function existsFilter(string $key)
    {
        return $this->filters->exists($this->prefix, $key, 'filters');
    }

    public function setFilter(string $key, ?string $value)
    {
        return $this->filters->set($this->prefix, $key, $value, 'filters');
    }

    public function setOrderBy($prefix, ?string $value, ?string $key = 'orderBy')
    {
        $this->filters->add($prefix, $key, $value);
    }

    public function setOrderDir($prefix, ?string $value, ?string $key = 'orderDir')
    {
        $this->filters->add($prefix, $key, $value);
    }

    public function getOrderBy(string $key = 'orderBy')
    {
        return $this->filters->get($this->prefix, $key);
    }

    public function getOrderDir(string $key = 'orderDir')
    {
        return $this->filters->get($this->prefix, $key);
    }

    public function getSuccess()
    {
        return $this->success;
    }
}