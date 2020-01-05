@extends('user.layout')

@section('content')
    <div class="row">
        @forelse ($stalls as $stall)
            <div class="col-md-4">
                <div class="card mb-4 box-shadow">
                    <img class="card-img-top" src="{{ $stall->imageUrl }}" alt="Card image cap">
                    <div class="card-body">
                        <h3 class="text-center">{{ $stall->name }}</h3>
                        <p class="card-text">{{ $stall->description }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="{{ route('user.stall.show', [$stall]) }}" class="btn btn-sm btn-outline-secondary">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{ $stalls->links() }}
        @empty
            <div class="col-md-12">
                No Data Found
            </div>
        @endforelse
    </div>
    
@endsection