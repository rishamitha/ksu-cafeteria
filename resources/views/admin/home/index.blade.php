@extends('admin.layout')

@section('title')
    Home
@endsection

@section('content')
    <div class="row">

        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Update Profile</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            @if ($stall->image)
                                <img src="{{ $stall->imageUrl }}" alt="" class="img-fluid">
                            @else
                                <img src="https://via.placeholder.com/500x500" alt="" class="img-fluid">
                            @endif
                        </div>
                        <div class="col-md-8">
                            @include('admin.common.error')
                            <form action="{{ route('admin.stall.update', Auth::id()) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="stall">Stall Name</label>
                                    <input name="name" type="text" class="form-control" id="stall" value="{{ old('name', optional($stall)->name) }}">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', optional($stall)->description) }}</textarea>
                                </div>
                                <input type="file" name="image" id="image" class="form-control-file">
                                <button type="submit" class="btn btn-primary float-right">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection