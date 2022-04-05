@extends('layouts.app')
@section('title', 'Quicktask - View Note')
@section('content')
    <div class="container">
        <div class="row bg-white">
            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="card-header">
                        <h1 class="h4 card-title text-success">{{ __('Note Title...') }}</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <span class="text-muted">{{ __('Author Name') }}</span>
                            </div>
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="text-muted"> {{ __('pages.created_at') }}: </span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="text-muted"> {{ __('pages.updated_at') }}: </span>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                        <p>{{ __('Note content') }}</p>

                        @if (!Auth::user()->is_admin)
                            <div class="text-right">
                                <a href="{{ route('note.edit') }}" class="btn btn-success">{{ __('pages.update') }}</a>
                                <a href="#" class="btn pull-left btn-danger"
                                    title="{{ __('pages.user-tooltips.delete') }}"
                                    onclick="event.preventDefault;document.getElementById('delete-id').submit()">{{ __('pages.delete') }}</a>
                                <form class="" id="delete-id" action="{{ route('note.destroy', 1000) }}"
                                    method="post">
                                    @csrf
                                    @method('delete')
                                </form>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
