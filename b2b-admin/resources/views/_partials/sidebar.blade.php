<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="{{ route('dashboard') }}" class="brand-link text-center">
    <span class="brand-text font-weight-light">{{ $application->getName() }}</span>
  </a>
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">{{ __('view.sidebar.section.edit.header') }}</li>
        <li class="nav-item">
          <a href="{{ route('products.index') }}" class="nav-link {{ $application->getPrefix() == 'products' ? 'active' : '' }}">
            <i class="nav-icon fas fa-store"></i>
            <p>{{ __('view.sidebar.link.products') }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('names.index') }}" class="nav-link {{ $application->getPrefix() == 'names' ? 'active' : '' }}">
            <i class="nav-icon fas fa-comment"></i>
            <p>{{ __('view.sidebar.link.names') }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('packages.index') }}" class="nav-link {{ $application->getPrefix() == 'packages' ? 'active' : '' }}">
            <i class="nav-icon fas fa-box"></i>
            <p>{{ __('view.sidebar.link.packages') }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('categories.index') }}" class="nav-link {{ $application->getPrefix() == 'categories' ? 'active' : '' }}">
            <i class="nav-icon fas fa-folder"></i>
            <p>{{ __('view.sidebar.link.categories') }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('types.index') }}" class="nav-link {{ $application->getPrefix() == 'types' ? 'active' : '' }}">
            <i class="nav-icon fas fa-inbox"></i>
            <p>{{ __('view.sidebar.link.types') }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('groups.index') }}" class="nav-link {{ $application->getPrefix() == 'groups' ? 'active' : '' }}">
            <i class="nav-icon fas fa-layer-group"></i>
            <p>{{ __('view.sidebar.link.groups') }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('exchanges.index') }}" class="nav-link {{ $application->getPrefix() == 'exchanges' ? 'active' : '' }}">
            <i class="nav-icon fas fa-coins"></i>
            <p>{{ __('view.sidebar.link.exchanges') }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('attributs.index') }}" class="nav-link {{ $application->getPrefix() == 'attributs' ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>{{ __('view.sidebar.link.attributs') }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('banners.index') }}" class="nav-link {{ $application->getPrefix() == 'banners' ? 'active' : '' }}">
            <i class="nav-icon fas fa-image"></i>
            <p>{{ __('view.sidebar.link.banners') }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pages.index') }}" class="nav-link {{ $application->getPrefix() == 'pages' ? 'active' : '' }}">
            <i class="nav-icon fas fa-copy"></i>
            <p>{{ __('view.sidebar.link.pages') }}</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('messages.index') }}" class="nav-link {{ $application->getPrefix() == 'messages' ? 'active' : '' }}">
            <i class="nav-icon far fa-envelope"></i>
            <p>{{ __('view.sidebar.link.messages') }}</p>
          </a>
        </li>
        <li class="nav-header">{{ __('view.sidebar.section.manage.header') }}</li>
        <li class="nav-item">
          <a href="{{ route('users.index') }}" class="nav-link {{ $application->getPrefix() == 'users' ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>{{ __('view.sidebar.link.users') }}</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>