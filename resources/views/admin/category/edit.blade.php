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
                        <form method="PUT" action="{{ route('category.update',$data->id) }}">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <label for="inputNanme4" class="form-label">Name</label>
                                    <input type="text" name="name" value="{{old('name',$data->name ?? '')}}" class="form-control" id="inputNanme4">
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
