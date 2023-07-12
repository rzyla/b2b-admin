<a class="btn btn-sm btn-primary" href="{{ route($application->getPrefix() . '.edit', [$item->id]) }}" title="{{ __('view.button.edit') }}"><i class="fas fa-pencil-alt"></i></a>
<a class="btn btn-sm btn-danger jq-popup-congrim" data-submit-class="jq-delete-items-form-{{ $item->id }}" href="#" title="{{ __('view.button.delete') }}"><i class="fas fa-trash-alt"></i></a>
<form method="POST" action="{{ route( $application->getPrefix() . '.destroy',  [$item->id]) }}" class="jq-delete-items-form-{{ $item->id }}">
    <input name="_method" type="hidden" value="DELETE">
    @csrf
</form>