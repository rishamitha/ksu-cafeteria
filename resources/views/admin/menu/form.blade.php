@extends('admin.layout')

@section('title')
    Menu - Add
@endsection

@section('content')
    <div class="row">

        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Add New Menu</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="col-md-12">
                        @include('admin.common.error')
                        <form action="{{ ($menu) ? route('admin.menu.update', [$menu]) : route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            @if ($menu)
                                @method('PATCH')
                            @endif

                            <div class="form-group">
                                @if ($menu)
                                    <img src="{{ $menu->imageUrl }}" alt="">
                                    <br>
                                    <br>
                                @endif
                                <label for="image">Image</label>
                                <input type="file" name="image" id="image">
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', optional($menu)->name) }}">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" rows="5" class="form-control">{{ old('description', optional($menu)->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input name="price" type="number" id="price" class="form-control" value="{{ old('price', optional($menu)->price) }}">
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="recommended" id="recommended" {{ (old('recommended', optional($menu)->is_recommended)) ? 'checked' : '' }}>
                                <label for="recommended">Set As Recommended</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection