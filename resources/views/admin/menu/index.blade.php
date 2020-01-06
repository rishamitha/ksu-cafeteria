@extends('admin.layout')

@section('title')
    Menu
@endsection

@section('content')
    <div class="row">

        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Your Menu</h6>
                    <div class="float-right">
                        <a href="{{ route('admin.menu.create') }}" class="btn btn-primary">Add New Menu</a>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="col-md-12">
                        <div id="no-more-tables">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th width="120">Name</th>
                                        <th width="400">Description</th>
                                        <th>Price</th>
                                        <th width="150">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($menus as $menu)
                                        <tr class="{{ ($menu->is_recommended) ? 'border-left-warning' : '' }}">
                                            <td data-title="No">{{ $menus->perPage() * ($menus->currentPage() - 1) + $loop->iteration }}</td>
                                            <td data-title="Image"><img src="{{ $menu->imageUrl }}" alt="{{ $menu->name }}" class="img-fluid"></td>
                                            <td data-title="Name">{{ $menu->name }}</td>
                                            <td data-title="Description">{{ ($menu->description) ?: 'No Description' }}</td>
                                            <td data-title="Price"> NTD {{ $menu->price }}</td>
                                            <td data-title="Action">
                                                <a href="{{ route('admin.menu.edit', $menu->id) }}" class="btn btn-success"><i class="fas fa-pencil-alt"></i></a>
                                                <a href="#" class="btn btn-danger btn-delete" data-id="{{ $menu->id }}"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">No Menu Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            {{ $menus->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Modal Delete Menu --}}
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete A Menu</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to delete the menu?</div>
                <div class="modal-footer">
                    <form action="#" id="form-delete" method="POST">
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
    <script>
        $('.btn-delete').on('click', function () {
            var id  = $(this).data('id');
            var url = "{{ route('admin.menu.destroy') }}/" + id;

            $('#form-delete').attr('action', url);
            $('#modal-delete').modal('show');
        });
    </script>
@endsection