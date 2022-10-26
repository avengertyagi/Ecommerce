@extends('admin.layouts.app')
@section('title')
    {{ 'Add SubCategory' }}
@endsection
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body mt-2">
                        <form method="POST" action="{{ route('subcategory.store') }}">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <label for="inputNanme4" class="form-label">Category Name</label>
                                    <select class="form-select" name="category_name">
                                        <option value=""selected disabled>Select an option</option>
                                        @foreach ($category as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputNanme4" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" id="inputNanme4">
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