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
                    <span>{{ __('authview.firstname') }}</span>: <span>A</span>
                </p>
                <p>
                    <span>{{ __('authview.lastname') }}</span>: <span>Nguyễn Văn</span>
                </p>
                <p>
                    <span>{{ __('authview.email') }}</span>: <span>nva@gmail.com</span>
                </p>
                <p>
                    <span>{{ __('authview.username') }}</span>: <span>nguyen-van-a</span>
                </p>
                <p>
                    <span>{{ __('pages.role') }}</span>: <span>User</span>
                </p>
                <p>
                    <span>{{ __('pages.status') }}</span>: <span>Active</span>
                </p>

                <p>
                    <span>{{ __('pages.created_at') }}</span>: <span>31/2/2020</span>

                </p>
                <p>
                    <span>{{ __('pages.updated_at') }}</span>: <span>31/2/2020</span>
                </p>
                <p>
                    <a href="{{ route('user.edit', 1) }}" class="btn pull-right btn-primary"
                        title="{{ __('pages.user-tooltips.edit') }}">{{ __('pages.update') }}</a>
                    <a href="#" class="btn pull-left btn-danger" title="{{ __('pages.user-tooltips.delete') }}"
                        onclick="event.preventDefault;document.getElementById('delete-id').submit()"><i
                            class="fa fa-trash"></i></a>
                <form class="" id="delete-id" action="{{ route('user.destroy', 1000) }}" method="post">
                    @csrf
                    @method('delete')
                </form>
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
