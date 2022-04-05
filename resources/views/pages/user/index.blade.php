@extends('layouts.app')
@section('title', 'Quicktask - User Management')
@section('content')
    <div class="container">
        <div class="row bg-white">
            <div class="col-md-12">
                <div class="card card-plain table-plain-bg">
                    <div class="card-header ">
                        <h1 class="h4 text-success card-title">{{ __('pages.user_list') }}</h1>
                    </div>
                    <div class="card-body table-full-width table-responsive">

                        <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm pull-right"><i
                                class="fa fa-plus"></i> {{ __('pages.create_new_user') }}</a>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('pages.full_name') }}</th>
                                    <th>{{ __('authview.email') }}</th>
                                    <th>{{ __('authview.username') }}</th>
                                    <th>{{ __('pages.created_at') }}</th>
                                    <th>{{ __('pages.status') }}</th>
                                    <th>{{ __('pages.role') }}</th>
                                    <th>{{ __('pages.options') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->full_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->is_active ? __('pages.active') : __('pages.inactive') }}</td>
                                        <td>{{ $user->is_admin ? 'Admin' : 'User' }}</td>
                                        <td>
                                            <a href="{{ route('user.show', $user->id) }}" class="btn no-border text-info"
                                                title="{{ __('pages.user-tooltips.show') }}"><i
                                                    class="fa fa-list"></i></a>
                                            <a href="{{ route('user.edit', $user->id) }}"
                                                class="btn no-border text-primary"
                                                title="{{ __('pages.user-tooltips.edit') }}"><i
                                                    class="fa fa-pencil"></i></a>
                                            <a href="#" class="btn no-border text-danger"
                                                title="{{ __('pages.user-tooltips.delete') }}"
                                                onclick="event.preventDefault;document.getElementById('delete-{{ $user->id }}').submit()"><i
                                                    class="fa fa-trash"></i></a>
                                            <form class="" id="delete-{{ $user->id }}"
                                                action="{{ route('user.destroy', $user->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
