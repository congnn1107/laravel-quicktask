@extends('layouts.app')
@section('title', 'Quicktask - Edit Note')
@section('content')
    <div class="container">
        <div class="row bg-white">
            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="card-header">
                        <h1 class="h4 card-title text-success">{{ __('pages.update_note') }}</h1>
                    </div>
                    <div class="card-body">
                        @include('layouts.message')
                        <div class="row">
                            <div class="col-md-7">
                                <span class="text-muted">{{ Auth::user()->full_name }}</span>
                            </div>
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="text-muted"> {{ __('pages.created_at') }}: {{ $note->created_at }}</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="text-muted"> {{ __('pages.updated_at') }}: {{ $note->updated_at }}</span>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                        <form action="{{ route('note.update',$note->id) }}" method="post" class="form">
                            @csrf
                            @method('put')
                            <div class="form-group @error('title') is-invalid @enderror">
                                <label for="">{{ __('pages.title') }}</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') ?? $note->title }}">
                                @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="content">{{ __('pages.content') }}</label>
                                <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{ old('content') ?? $note->content }}</textarea>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">{{ __('pages.save') }}</button>
                                <a href="#" class="btn pull-left btn-danger"
                                    title="{{ __('pages.user-tooltips.delete') }}"
                                    onclick="event.preventDefault;document.getElementById('delete-id').submit()">{{ __('pages.delete') }}</a>
                            </div>
                        </form>
                        <form class="" id="delete-id" action="{{ route('note.destroy', $note->id) }}"
                            method="post">
                            @csrf
                            @method('delete')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection