<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="{{ route('dashboard') }}" class="brand-link text-center">
    <span class="brand-text font-weight-light">{{ $application->name }}</span>
  </a>
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">{{ __('common.menu_header_edit') }}</li>
        <li class="nav-item">
          <a href="{{ route('products.index') }}" class="nav-link {{ $application->prefix == 'products' ? 'active' : '' }}">
            <i class="nav-icon fas fa-store"></i>
            <p>{{ __('common.menu_products') }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('names.index') }}" class="nav-link {{ $application->prefix == 'names' ? 'active' : '' }}">
            <i class="nav-icon fas fa-comment"></i>
            <p>{{ __('common.menu_names') }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('packages.index') }}" class="nav-link {{ $application->prefix == 'packages' ? 'active' : '' }}">
            <i class="nav-icon fas fa-box"></i>
            <p>{{ __('common.menu_packages') }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('categories.index') }}" class="nav-link {{ $application->prefix == 'categories' ? 'active' : '' }}">
            <i class="nav-icon fas fa-folder"></i>
            <p>{{ __('common.menu_categories') }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('types.index') }}" class="nav-link {{ $application->prefix == 'types' ? 'active' : '' }}">
            <i class="nav-icon fas fa-inbox"></i>
            <p>{{ __('common.menu_types') }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('groups.index') }}" class="nav-link {{ $application->prefix == 'groups' ? 'active' : '' }}">
            <i class="nav-icon fas fa-layer-group"></i>
            <p>{{ __('common.menu_groups') }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('exchanges.index') }}" class="nav-link {{ $application->prefix == 'exchanges' ? 'active' : '' }}">
            <i class="nav-icon fas fa-coins"></i>
            <p>{{ __('common.menu_exchanges') }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('attributs.index') }}" class="nav-link {{ $application->prefix == 'attributs' ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>{{ __('common.menu_attributs') }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('banners.index') }}" class="nav-link {{ $application->prefix == 'banners' ? 'active' : '' }}">
            <i class="nav-icon fas fa-image"></i>
            <p>{{ __('common.menu_banners') }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pages.index') }}" class="nav-link {{ $application->prefix == 'pages' ? 'active' : '' }}">
            <i class="nav-icon fas fa-copy"></i>
            <p>{{ __('common.menu_pages') }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('messages.index') }}" class="nav-link {{ $application->prefix == 'messages' ? 'active' : '' }}">
            <i class="nav-icon far fa-envelope"></i>
            <p>{{ __('common.menu_messages') }}</p>
          </a>
        </li>
        <li class="nav-header">{{ __('common.menu_header_manage') }}</li>
        <li class="nav-item">
          <a href="{{ route('users.index') }}" class="nav-link {{ $application->prefix == 'users' ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>{{ __('common.menu_users') }}</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>