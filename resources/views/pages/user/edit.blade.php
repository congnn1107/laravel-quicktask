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
                        @include('layouts.message')
                        <form action="{{ route('user.update', $user->id) }}" method="POST" class="form">
                            @csrf
                            @method('put')
                            <div class="form-group @error('first_name') is-invalid @enderror">
                                <label for="">{{ __('authview.firstname') }}</label>
                                <input type="text" name="first_name" id="first_name" class="form-control"
                                    value="{{ old('first_name') ?? $user->first_name }}">
                                @error('first_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group @error('last_name') is-invalid @enderror">
                                <label for="">{{ __('authview.lastname') }}</label>
                                <input type="text" name="last_name" id="last_name" class="form-control"
                                    value="{{ old('last_name') ?? $user->last_name }}">
                                @error('last_name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group @error('email') is-invalid @enderror">
                                <label for="">{{ __('authview.email') }}</label>
                                <input type="text" name="email" id="email" class="form-control"
                                    value="{{ $user->email }}" disabled>
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group @error('username') is-invalid @enderror">
                                <label for="">{{ __('authview.username') }}</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    value="{{ $user->username }}" disabled>
                                @error('username')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <table>
                                    <tr>
                                        <td>
                                            <div class="form-group form-check">
                                                <label class="form-check-label" for="is_active">
                                                    <input class="form-check-input" type="checkbox" name="is_active"
                                                        id="is_active" @if ($user->is_active) checked @endif
                                                        @if ($user->id == Auth::user()->id) disabled @endif>
                                                    <span class="form-check-sign"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td><label for="is_active"
                                                class="form-check-label">{{ __('pages.active') }}</label></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">{{ __('pages.save') }}</button>
                                @if (Auth::user()->is_admin && !$user->is_admin)
                                    <a href="#" class="btn pull-left btn-danger"
                                        title="{{ __('pages.user-tooltips.delete') }}"
                                        onclick="event.preventDefault;document.getElementById('delete-id').submit()">{{ __('pages.delete') }}</a>
                                @endif
                            </div>
                        </form>
                        @if (Auth::user()->is_admin && !$user->is_admin)
                            <form class="" id="delete-id" action="{{ route('user.destroy', 1000) }}"
                                method="post">
                                @csrf
                                @method('delete')
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
