@extends('admin.layouts.app')
@section('title')
    {{ 'Category' }}
@endsection
@section('content')
<div class="card-header py-3">
  <a href="{{ route('category.create') }}" class="btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i>
      @lang('Add Category')</a>
</div>
<div class="card-body">
  <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
              <tr>
                  <th>@lang('S.No')</th>
                  <th>@lang('Name')</th>
                  <th>@lang('Date')</th>
                  <th>@lang('Status')</th>
                  <th>@lang('Action')</th>
              </tr>
          </thead>
      </table>
  </div>
</div>
@endsection
