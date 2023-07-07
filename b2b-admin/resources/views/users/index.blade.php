@extends('layout')

@section('content')
  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('filters', ['prefix' => $application->prefix]) }}">
        @csrf
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>{{ __('labels.search') }}</label>
              <input type="text" value="{{ $application->getFilter('search') }}" name="filters[search]" class="form-control">
            </div>
          </div>
        </div>
        @include('_partials.grid.search_buttons')
      </form>
    </div>
  </div>
  <div class="card">
    <table class="table table-grid radius-border margin-bottom-0">
      <tbody>
        <tr>
          <th>#</th>
          <th>@include('_partials.grid.sort_label', ['name' => 'name', 'application' => $application])</th>
          <th>@include('_partials.grid.sort_label', ['name' => 'email', 'application' => $application])</th>
          <th></th>
        </tr>
        @foreach ($grid as $key => $item)
          <tr>
            <td class="table-col-nb">{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->email }}</td>
            <td class="text-right">
              @include('_partials.grid.row_buttons')
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