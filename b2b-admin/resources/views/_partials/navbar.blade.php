<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="{{ route('dashboard') }}" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link nav-link-user-dropdown" data-toggle="dropdown" href="{{ route('account') }}">
        <span class="image">
          <img src="{{ ImageHelper::Thumb($application->user->avatar, 50, 50) }}" class="img-circle elevation-2" alt="{{ $application->user->name }}">
        </span>
        <span class="info">{{ $application->user->name }}</span>
      </a>
      <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
        <a href="{{ route('account') }}" class="dropdown-item dropdown-footer">{{ __('common.menu_account') }}</a>
        <div class="dropdown-divider"></div>
        <a href="{{ route('logout') }}" class="dropdown-item dropdown-footer">{{ __('common.button_logout') }}</a>
      </div>
    </li>
  </ul>
</nav>