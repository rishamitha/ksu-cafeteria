@extends('user.layout')

@section('content')
    <div class="row">
        <div class="col-md-3 mx-auto">
            <img class="img-fluid m-1" src="{{ $stall->imageUrl }}" alt="{{ $stall->name }}" />
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <p>{{ $stall->description }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <h3 class="text-center">Our Menu</h3>
        </div>
    </div>

    <div class="row m-1">
        <div class="col-md-8 mx-auto">
            @forelse ($stall->menus as $menu)
                <div class="row mb-2">
                    <div class="col-md-3">
                        <img src="{{ $menu->imageUrl }}" alt="{{ $menu->name }}" class="img-fluid">
                    </div>

                    <div class="col-md-8">
                        <p>{{ $menu->description }}</p>
                        <div class="float-left">
                            NTD <strong>{{ $menu->price }}</strong>
                        </div>

                        @if ($menu->is_recommended)
                            <div class="float-right">
                                Recommended <i class="fas fa-star" style="color: #F4AB39"></i>
                            </div>
                        @endif
                    </div>
                </div>

            @empty
                <div class="row">
                    <div class="col-md-12">No Data Found</div>
                </div>
            @endforelse

            <hr>
        </div>
    </div>

    <div class="row">
        @foreach ($stall->galleries as $gallery)
            <div class="col-md-1">
                <a href="{{ $gallery->imageUrl }}" data-lightbox="set-gallery" data-title="{{ $gallery->caption }}">
                    <img class="img-fluid m-1" src="{{ $gallery->imageUrl }}" alt="{{ $stall->name }}" />
                </a>
            </div>
        @endforeach
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/lightbox-plus-jquery.js') }}"></script>
    <script>
        lightbox.option({
          'resizeDuration': 200,
          'wrapAround': true
        })
    </script>
@endsection
