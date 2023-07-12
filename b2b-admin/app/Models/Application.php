<?php

namespace App\Models;

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

        $this->InitPaths();
        $this->InitLocalizer();
        $this->InitBreadcrumb();
    }

    private function InitPaths()
    {
        $this->uploadSourceDir = public_path('uploads/') . $this->prefix;
        $this->uploadThumbsDir = public_path('thumbs/uploads/') . $this->prefix;
    }

    private function InitLocalizer()
    {
        $this->name = __('view.application.name');
        $this->meta->title = __('view.application.default.title');
    }

    private function InitBreadcrumb()
    {
        $this->breadcrumb = new ApplicationBreadcrumb();
        $this->breadcrumb->add(__('view.sidebar.link.dashboard'), 'dashboard', []);

        if(!empty($this->prefix))
        {
            $this->breadcrumb->add(__('view.sidebar.link.' . $this->prefix), $this->prefix, []);
        }
    }
    
    public function InitSessionMessages()
    {
        $this->success = !empty(Session::get('success')) ? Session::get('success') : '';
    }

    public function InitUser(?User $user)
    {
        $this->user = new ApplicationUser($user);
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
        return $this->filters->get($this->prefix, $key);
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

class ApplicationMeta
{
    public string $title;
}

class ApplicationUser
{
    public ?string $avatar;
    public ?string $name;

    public function __construct(?User $user = null)
    {
        $this->avatar = $this->avatarUrl($user?->avatar);
        $this->name = $user?->name;
    }

    private function avatarUrl(?string $avatar)
    {
        return empty($avatar)
            ? "assets/images/avatar.png"
            : "uploads/account/".$avatar;
    }
}

class ApplicationBreadcrumb
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

        array_push($this->breadcrumb, new ApplicationBreadcrumbItem($name, $route, true, $params));
    }

    public function get()
    {
        return $this->breadcrumb;
    }
}

class ApplicationBreadcrumbItem
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

class ApplicationFilters
{
    public function add(string $prefix, string $key, ?string $value)
    {
        session([$this->sessionKey($prefix, $key) => $value]);
    }

    public function get(string $prefix, string $key)
    {
        return session($this->sessionKey($prefix, $key));
    }

    public function clear($prefix)
    {
        foreach(session()->all() as $key => $value)
        {
            $explode = explode('_', $key);

            if($explode[0] == $prefix && $explode[2] != 'orderBy' && $explode[2] != 'orderDir')
            {
                session([$key => null]);
            }
        }
    }

    private function sessionKey(string $prefix, string $key) : string
    {
        return $prefix . '_filters_' . $key;
    }
}