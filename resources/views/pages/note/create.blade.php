@extends('layouts.app')
@section('title', 'Quicktask - Create Note')
@section('content')
    <div class="container">
        <div class="row bg-white">
            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="card-header">
                        <h1 class="h4 card-title text-success">{{ __('pages.create_new_note') }}</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <span class="text-muted">{{ Auth::user()->full_name }}</span>
                            </div>
                            <br>
                        </div>
                        <form action="{{ route('note.store') }}" method="post" class="form">
                            @csrf
                            <div class="form-group @error('title') is-invalid @enderror">
                                <label for="">{{ __('pages.title') }}</label>
                                <input type="text" name="title" id="title" class="form-control">
                                @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="content">{{ __('pages.content') }}</label>
                                <textarea class="form-control" name="content" id="content" cols="30" rows="10"></textarea>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">{{ __('pages.save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
