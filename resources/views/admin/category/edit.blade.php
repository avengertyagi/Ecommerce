@extends('admin.layouts.app')
@section('title')
    {{ 'Edit Category' }}
@endsection
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body mt-2">
                        <form method="POST" action="{{ route('category.update', $data->id) }}">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <label for="inputNanme4" class="form-label">Name</label>
                                    <input type="text" name="name" value="{{ old('name', $data->name ?? '') }}"
                                        class="form-control" id="inputNanme4">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row justify-content-center mt-2">
                                <div class="col-md-6">
                                    <label for="inputNanme4" class="form-label">parent category</label>
                                    <select class="form-select" name="parent_id">
                                        <option value=""selected disabled>Select an option</option>
                                        @foreach ($categories as $value)
                                        <option
                                        value="{{ $value->id }}"{{ $value->parent_id == $data->parent_id ? 'selected' : '' }}>
                                        {{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-center mt-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
