@if($application->getOrderBy() == $name && $application->getOrderDir() == 'asc')
    <a href="{{ route('orderBy', ['prefix' => $application->prefix, 'orderBy' => $name, 'orderDir' => 'desc']) }}">
        <span class="margin-right-5">{{ __('labels.' . $name) }}</span>
        <i class="fas fa-arrow-up"></i>
    </a>
@elseif($application->getOrderBy() == $name && $application->getOrderDir() == 'desc')
    <a href="{{ route('orderBy', ['prefix' => $application->prefix, 'orderBy' => '', 'orderDir' => '']) }}">
        <span class="margin-right-5">{{ __('labels.' . $name) }}</span>
        <i class="fas fa-arrow-down"></i>
    </a>
@else
    <a href="{{ route('orderBy', ['prefix' => $application->prefix, 'orderBy' => $name, 'orderDir' => 'asc']) }}">
        <span class="margin-right-5">{{ __('labels.' . $name) }}</span>
        <i class="fas fa-arrows-alt-v"></i>
    </a>
@endif