@extends('layouts.app')

@section('title', 'Quicktask - User Information')

@section('content')
    <div class="container">
        <div class="row bg-white">
            <div class="col-md-4">
                <h1 class="h4 text-info">{{ __('pages.info') }}</h1>
                <p>
                    <span>ID</span>: <span>1</span>
                </p>
                <p>
                    <span>{{ __('authview.firstname') }}</span>: <span>{{ $user->first_name }}</span>
                </p>
                <p>
                    <span>{{ __('authview.lastname') }}</span>: <span>{{ $user->last_name }}</span>
                </p>
                <p>
                    <span>{{ __('authview.email') }}</span>: <span>{{ $user->email }}</span>
                </p>
                <p>
                    <span>{{ __('authview.username') }}</span>: <span>{{ $user->username }}</span>
                </p>
                <p>
                    <span>{{ __('pages.role') }}</span>: <span>{{ $user->is_admin ? 'Admin' : 'User' }}</span>
                </p>
                <p>
                    <span>{{ __('pages.status') }}</span>:
                    <span>{{ $user->is_active ? __('pages.active') : __('pages.inactive') }}</span>
                </p>

                <p>
                    <span>{{ __('pages.created_at') }}</span>: <span> {{ $user->created_at }}</span>

                </p>
                <p>
                    <span>{{ __('pages.updated_at') }}</span>: <span>{{ $user->updated_at }}</span>
                </p>
                <p>
                    <a href="{{ route('user.edit', $user->id) }}" class="btn pull-right btn-primary"
                        title="{{ __('pages.user-tooltips.edit') }}">{{ __('pages.update') }}</a>
                    @if (Auth::user()->is_admin && !$user->is_admin)
                        <a href="#" class="btn pull-left btn-danger" title="{{ __('pages.user-tooltips.delete') }}"
                            onclick="event.preventDefault;document.getElementById('delete-id').submit()">{{ __('pages.delete') }}</a>
                        <form class="" id="delete-id" action="{{ route('user.destroy', $user->id) }}"
                            method="post">
                            @csrf
                            @method('delete')
                        </form>
                    @endif
                </p>
            </div>

            {{-- Note list of user --}}
            <div class="col-md-8">
                <h2 class="h4 text-success">{{ __('pages.note_list') }}</h2>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>{{ __('pages.title') }}</th>
                            <th>{{ __('pages.created_at') }}</th>
                            <th>{{ __('pages.updated_at') }}</th>
                            <th>{{ __('pages.options') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notes as $note)
                            <tr>
                                <td>{{ $note->title }}</td>
                                <td>{{ $note->created_at }}</td>
                                <td>{{ $note->updated_at }}</td>
                                <td>
                                    <a href="{{ route('note.show', $note->id) }}" class="btn no-border text-info"
                                        title="{{ __('pages.user-tooltips.show') }}"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
