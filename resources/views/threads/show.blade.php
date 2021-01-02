@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-md-8 col-md-offset-2">
                <div class="card">
                    <div class="card-header">
                        <a href="#">
                            {{ $thread->creator->name }}
                        </a>
                        posted:
                        {{ $thread->title }}
                    </div>

                    <div class="card-body">
                        <div class="body">
                            {{ $thread->body }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8 col-md-offset-2">
                <div class="card">
                    @foreach ($thread->replies as $reply)
                        @include('partials.replies')

                    @endforeach
                </div>
            </div>
        </div>
        <hr>

        @if (auth()->check())
            <div class="row justify-content-center">
                <div class="col-md-8 col-md-offset-2">
                    <div class="card">
                        <form method="POST" action="{{ $thread->path() . '/replies' }}">
                            @csrf
                            <div class="form-group">
                                <textarea name="body" id="body" rows="5" class="form-control"
                                    placeholder="Have some things to say?"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Post</button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <p class="text-center"> please<a href="{{ route('login') }}"> SingIn </a> to Participates in this discussion</p>
        @endif
    </div>

@endsection
