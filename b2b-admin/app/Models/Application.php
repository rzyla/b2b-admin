<?php

namespace App\Models;

use App\Models\Application\Breadcrumb;
use App\Models\Application\Buttons;
use App\Models\Application\User;
use App\Models\User as Auth;
use Illuminate\Support\Facades\Session;

class Application 
{
    private ?string $title;
    private ?string $prefix;
    private string $success;
    public string $uploadSourceDir;
    public string $uploadThumbsDir;
    public Breadcrumb $breadcrumb;
    public Buttons $buttons;
    public User $user;

    public function __construct(?string $prefix = null, ?Auth $user = null)
    {
        $this->buttons = new Buttons();
        $this->prefix = $prefix;

        $this->initPaths();
        $this->initBreadcrumb();
    }

    private function initPaths()
    {
        $this->uploadSourceDir = public_path('uploads/') . $this->prefix;
        $this->uploadThumbsDir = public_path('thumbs/uploads/') . $this->prefix;
    }

    private function initBreadcrumb()
    {
        $this->breadcrumb = new Breadcrumb();
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

    public function initUser(?Auth $user)
    {
        $this->user = new User($user);
    }

    public function getPrefix()
    {
        return $this->prefix;
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

    public function getMetaTitle()
    {
       return __('view.application.default.title') . ' - '. $this->getTitle();
    }

    public function getSuccess()
    {
        return $this->success;
    }
}