@if($application->getOrderBy() == $field && $application->getOrderDir() == 'asc')
    <a href="{{ route('orderBy', ['prefix' => $application->getPrefix(), 'orderBy' => $field, 'orderDir' => 'desc']) }}">
        <span class="margin-right-5">{{ $label }}</span>
        <i class="fas fa-arrow-up"></i>
    </a>
@elseif($application->getOrderBy() == $field && $application->getOrderDir() == 'desc')
    <a href="{{ route('orderBy', ['prefix' => $application->getPrefix(), 'orderBy' => '', 'orderDir' => '']) }}">
        <span class="margin-right-5">{{ $label }}</span>
        <i class="fas fa-arrow-down"></i>
    </a>
@else
    <a href="{{ route('orderBy', ['prefix' => $application->getPrefix(), 'orderBy' => $field, 'orderDir' => 'asc']) }}">
        <span class="margin-right-5">{{ $label }}</span>
        <i class="fas fa-arrows-alt-v"></i>
    </a>
@endif