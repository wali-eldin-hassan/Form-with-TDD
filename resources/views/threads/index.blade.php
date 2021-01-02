@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Form For Threads</div>

                    <div class="card-body">

                        @foreach ($threads as $thread)
                            <article>
                                <a href="{{ $thread->path() }}">
                                    <h4>{{ $thread->title }}</h4>
                                </a>
                            </article>
                            <div class="body">
                                {{ $thread->body }}
                            </div>
                            <hr>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
