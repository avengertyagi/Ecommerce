@extends('admin.layouts.app')
@section('title')
    {{ 'Add Product' }}
@endsection
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body mt-2">
                        <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
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
                                    @error('category_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="inputNanme4" class="form-label">SubCategory Name</label>
                                    <select class="form-select" name="subcategory_name">
                                        <option value=""selected disabled>Select an option</option>
                                        @foreach ($sub_category as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('subcategory_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <label for="inputNanme4" class="form-label">Product Name</label>
                                    <input type="text" name="product_name" class="form-control" id="inputNanme4">
                                    @error('product_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="inputNanme4" class="form-label">Image</label>
                                    <input type="file" name="images" class="form-control" id="inputNanme4">
                                    @error('images')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="sizes mt-5">
                                        <h6 class="text-uppercase">Size</h6>
                                        <label class="radio">
                                            <input type="radio" name="size" value="S" checked>
                                            <span>S</span>
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="size" value="M">
                                            <span>M</span>
                                        </label>
                                        <label class="radio"> <input type="radio" name="size" value="L">
                                            <span>L</span>
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="size" value="XL">
                                            <span>XL</span>
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="size" value="XXL">
                                            <span>XXL</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="inputNanme4" class="form-label mt-2">Description</label>
                                    <textarea name="description" class="form-control" id="inputNanme4"></textarea>
                                    @error('description')
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
