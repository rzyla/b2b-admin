@if($filter->getOrderBy() == $field && $filter->getOrderDir() == 'asc')
    <a href="{{ route('setOrderBy', ['prefix' => $filter->getPrefix(), 'action' => $filter->getAction(), 'orderBy' => $field, 'orderDir' => 'desc']) }}">
        <span class="margin-right-5">{{ $label }}</span>
        <i class="fas fa-arrow-up"></i>
    </a>
@elseif($filter->getOrderBy() == $field && $filter->getOrderDir() == 'desc')
    <a href="{{ route('setOrderBy', ['prefix' => $filter->getPrefix(), 'action' => $filter->getAction(),'orderBy' => '', 'orderDir' => '']) }}">
        <span class="margin-right-5">{{ $label }}</span>
        <i class="fas fa-arrow-down"></i>
    </a>
@else
    <a href="{{ route('setOrderBy', ['prefix' => $filter->getPrefix(), 'action' => $filter->getAction(),'orderBy' => $field, 'orderDir' => 'asc']) }}">
        <span class="margin-right-5">{{ $label }}</span>
        <i class="fas fa-arrows-alt-v"></i>
    </a>
@endif