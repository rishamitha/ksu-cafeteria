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
                    <h6 class="m-0 font-weight-bold text-primary">Your Gallery</h6>

                    <div class="float-right">
                        <a href="#" class="btn btn-primary btn-add">Add New Picture</a>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9 mx-auto">
                            <div id="no-more-tables">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Image</th>
                                            <th>Caption</th>
                                            <th width="150">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($galleries as $gallery)
                                            <tr>
                                                <td data-title="No">{{ $galleries->perPage() * ($galleries->currentPage() - 1) + $loop->iteration }}</td>
                                                <td data-title="Image"><img src="{{ $gallery->imageUrl }}" class="img-fluid"></td>
                                                <td data-title="Caption">{{ ($gallery->caption) ?: 'No Caption Found' }}</td>
                                                <td data-title="Action">
                                                    <a href="#" class="btn btn-success btn-edit" data-item="{{ $gallery }}"><i class="fas fa-pencil-alt"></i></a>
                                                    <a href="#" class="btn btn-danger btn-delete" data-id="{{ $gallery->id }}"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>

                                        @empty
                                            <tr>
                                                <td colspan="2">No Image Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{ $galleries->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="modal fade" id="modal-gallery" role="dialog" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gallery-title">Add An Image</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" id="form-gallery">
                    <div class="modal-body">
                        <img src="" class="mx-auto d-block" id="edit-image" style="display: none">
                        <div id="response" class="alert alert-danger" style="display: none;"></div>
                        <input type="hidden" name="_method" id="method">
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control-file">
                        </div>
                        <div class="form-group">
                            <label for="caption">Caption</label>
                            <input type="text" name="caption" id="caption" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete An Image</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to delete the image?</div>
                <div class="modal-footer">
                    <form action="" id="form-delete" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    {{-- SUBMIT PICTURE --}}
    <script>
        $('#form-gallery').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success : function (message) {
                    location.reload();
                },
                error   : function (error) {
                    var message = error.responseJSON.errors;
                    var html    = [];

                    $.each(message, function (index, value) {
                        html.push('<li>' + value[0] + '</li>');
                    });

                    var final = '<ul class="mb-0">' + html.join('') + '</ul>';

                    $('#response').css('display', 'block');
                    $('#response').html(final);
                }
            });
        });
    </script>

    <script>
        $('.btn-add').on('click', function () {
            $('#response').css('display', 'none');

            var url = "{{ route('admin.gallery.store') }}";

            $('#caption').val('');
            $('#form-gallery').attr('action', url);
            $('#gallery-title').text('Add An Image');
            $('#method').val('POST');

            $('#modal-gallery').modal('show');
        });

        $('.btn-edit').on('click', function () {
            $('#response').css('display', 'none');
            $('#edit-image').css('display', 'block');

            var data  = $(this).data('item');
            var url   = "{{ route('admin.gallery.update') }}/" + data.id;
            var image = window.location.origin + '/uploads/gallery/' + data.image;

            $('#edit-image').attr('src', image);
            $('#caption').val(data.caption);
            $('#form-gallery').attr('action', url);
            $('#gallery-title').text('Edit A Picture');
            $('#method').val('PATCH');

            $('#modal-gallery').modal('show');
        });

        $('.btn-delete').on('click', function () {
            var id  = $(this).data('id');
            var url = "{{ route('admin.gallery.destroy') }}/" + id;

            $('#form-delete').attr('action', url);
            $('#modal-delete').modal('show');
        });
    </script>
@endsection