@extends('layout')

@section('content')
  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('filters', ['prefix' => $application->getPrefix()]) }}">
        @csrf
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>{{ __('view.form.search.labels.search') }}</label>
              <input type="text" value="{{ $application->getFilter('search') }}" name="filters[search]" class="form-control">
            </div>
          </div>
        </div>
        @include('_partials.grid.search.buttons')
      </form>
    </div>
  </div>
  <div class="card">
    <table class="table table-grid radius-border margin-bottom-0">
      <tbody>
        <tr>
          <th>#</th>
          <th>@include('_partials.grid.col.header', ['label' => __('view.users.label.name'), 'field' => 'name', 'application' => $application])</th>
          <th>@include('_partials.grid.col.header', ['label' => __('view.users.label.email'), 'field' => 'email', 'application' => $application])</th>
          <th></th>
        </tr>
        @foreach ($grid as $key => $item)
          <tr>
            <td class="table-col-nb">{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->email }}</td>
            <td class="text-right">
              @include('_partials.grid.row.buttons')
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="links">
    {{ $grid->links('pagination::bootstrap-5') }}
  </div>

@endsection