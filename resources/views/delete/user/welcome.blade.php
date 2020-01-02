@extends('user.layouts.app')

@section('content')
    <div class="hero-body">
        <div class="container">
            <div class="columns is-vcentered">
                <div class="column is-5 is-offset-1 landing-caption">

                    <span>
                    A beautiful <a href="https://bulma.io/">Bulma CSS</a> App
                    </span>
                    <h1 class="title is-1 is-bold is-spaced">
                        BulmaPlay 
                    </h1>
                    <p class="subtitle is-muted">
                     Learn <a href="https://docs.appseed.us/apps/bulma-css/bulmaplay">how to use</a> this <a href="https://github.com/app-generator/bulmaplay">open-source</a> app
                    </p>
                    <p>
                        <a target="_blank" href="https://appseed.us/apps/bulma-css/bulmaplay" class="button rounded primary-btn">
                            App Info
                        </a>
                    </p>
                </div>
                <div class="column is-5 is-offset-1">
                    <figure class="image is-4by4">
                        <img  class="lazy"
                              src="{{ asset('img/a-plate.png') }}"
                              data-src="assets/images/absurd/08.png" 
                              alt="Absurd image, Man with a bulb head - BulmaPlay made with Bulma CSS.">
                    </figure>
                </div>

            </div>
        </div>
    </div>
@endsection
