<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Controllers\BaseController;
use App\Helpers\ImageHelper;
use App\Models\User;
use App\Services\ConfigurationService;
use App\Services\UsersService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsersController extends BaseController
{
    function __construct()
    {
        parent::__construct('users');
    }

    public function index(ConfigurationService $configurationService, UsersService $usersService)
    {
        $this->init('index');
        $this->filter->initShow($usersService->indexInitShow());
        $this->application->buttons->add(__('view.button.add'), 'users.create', $this->buttonTypesEnum->outlinePrimary, $this->buttonsEnum->plus);

        $grid = $usersService->grid($this->filter, $configurationService->getpaginationSize());
        
        return view('users.index')
            ->with('application', $this->application)
            ->with('filter', $this->filter)
            ->with('grid', $grid);
    }

    public function create(ConfigurationService $configurationService, UsersService $usersService)
    {
        $this->init('edit');
        $this->filter->initShow($usersService->editInitShow());
        $this->application->breadcrumb->add(__('view.breadcrumb.user.create'), 'users.create', []);
        $this->application->setTitle(__('view.breadcrumb.user.create'));

        return view('users.create')
            ->with('application', $this->application)
            ->with('filter', $this->filter)
            ->with('minimum_password_length', $configurationService->getMinimumPasswordLength());
    }

    public function store(ConfigurationService $configurationService, Request $request, UsersService $usersService)
    {
        $input = $request->all();
        
        $validator = Validator::make($request->all(), 
        [
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique(app(User::class)->getTable())],
            'password' => 'required',
        ], 
        $usersService->validationMessages());
        $validator->sometimes('password', 'required|min:'.$configurationService->getMinimumPasswordLength(), function ($input) 
        {
            return !empty($input->password);
        });
        
        if ($validator->fails()) 
        {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($request->except(['password']));
        }

        $user = $usersService->createUser($input);

        return redirect()
            ->route('users.edit', [$user->id])
            ->with('success', __('view.message.success.add'));
    }

    public function edit(ConfigurationService $configurationService, UsersService $usersService, $id)
    {
        $user = $usersService->getUser($id);
        
        $this->init('edit');
        $this->filter->initShow($usersService->editInitShow());
        $this->application->breadcrumb->add(__('view.breadcrumb.user.edit'), 'users.edit', [$user->id]);
        $this->application->setTitle(__('view.breadcrumb.user.edit') . ': '. $user->name);

        return view('users.edit')
            ->with('application', $this->application)
            ->with('filter', $this->filter)
            ->with('minimum_password_length', $configurationService->getMinimumPasswordLength())
            ->with('user', $user);
    }

    public function update(ConfigurationService $configurationService, Request $request, UsersService $usersService, $id)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), 
        [
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique(app(User::class)->getTable())->ignore($id)],
        ], 
        $usersService->validationMessages());
        $validator->sometimes('password', 'required|min:'.$configurationService->getMinimumPasswordLength(), function ($input) 
        {
            return !empty($input->password);
        });
        
        if ($validator->fails()) 
        {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput($request->except(['password']));
        }

        $user = $usersService->updateUser($input, $id);

        return redirect()
            ->route('users.edit', [$user->id])
            ->with('success', __('view.message.success.edit'));
    }

    public function destroy(UsersService $usersService, $id)
    {
        $usersService->deleteUser($id);

        return redirect()
            ->route('users.index')
            ->with('success', __('view.message.success.delete'));
    }
}