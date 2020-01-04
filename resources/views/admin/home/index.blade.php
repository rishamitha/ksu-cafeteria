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
                            <img src="https://via.placeholder.com/500x500" alt="" class="img-fluid">
                        </div>
                        <div class="col-md-8">
                            <form action="">
                                <div class="form-group">
                                    <label for="">Stall Name</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="" id="" rows="4" class="form-control"></textarea>
                                </div>
                                <input type="file" name="photo" id="">
                                <button type="submit" class="btn btn-primary float-right">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection