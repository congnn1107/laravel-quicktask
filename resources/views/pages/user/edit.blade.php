@extends('layouts.app')
@section('title', 'Quicktask - Edit User')
@section('content')
    <div class="container">
        <div class="row bg-white">
            <div class="col col-12-md">
                <div class="card card-plain">
                    <div class="card-header">
                        <h1 class="h4 card-title text-success">{{ __('pages.update_user') }}</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.store') }}" method="POST" class="form">
                            @csrf
                            <div class="form-group @error('first_name') is-invalid @enderror">
                                <label for="">{{ __('authview.firstname') }}</label>
                                <input type="text" name="first_name" id="first_name" class="form-control">
                                @error('first_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group @error('last_name') is-invalid @enderror">
                                <label for="">{{ __('authview.lastname') }}</label>
                                <input type="text" name="last_name" id="last_name" class="form-control">
                                @error('last_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group @error('email') is-invalid @enderror">
                                <label for="">{{ __('authview.email') }}</label>
                                <input type="text" name="email" id="email" class="form-control">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group @error('username') is-invalid @enderror">
                                <label for="">{{ __('authview.username') }}</label>
                                <input type="text" name="username" id="username" class="form-control">
                                @error('username')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">{{ __('pages.save') }}</button>
                                <a href="#" class="btn pull-left btn-danger"
                                    title="{{ __('pages.user-tooltips.delete') }}"
                                    onclick="event.preventDefault;document.getElementById('delete-id').submit()">{{ __('pages.delete') }}</a>
                                <form class="" id="delete-id" action="{{ route('user.destroy', 1000) }}"
                                    method="post">
                                    @csrf
                                    @method('delete')
                                </form>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
