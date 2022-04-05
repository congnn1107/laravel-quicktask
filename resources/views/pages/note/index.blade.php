{{-- Nếu user là admin --}}
{{-- Hiển thị danh sách note của mình --}}
{{-- Hiển thị danh sách note của người khác --}}
{{-- Nếu không phải admin thì chỉ hiển thị danh sách note của mình --}}

@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row bg-white">
            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="card-header">
                        <h1 class="h4 text-success card-title">{{ __('pages.note_list') }}</h1>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('note.create') }}" class="btn btn-primary btn-sm pull-right"><i
                                class="fa fa-plus"></i> {{ __('pages.create_new_note') }}</a>
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
                                            <a href="{{ route('note.edit', $note->id) }}"
                                                class="btn no-border text-primary"
                                                title="{{ __('pages.user-tooltips.edit') }}"><i
                                                    class="fa fa-pencil"></i></a>
                                            <a href="#" class="btn no-border text-danger"
                                                title="{{ __('pages.user-tooltips.delete') }}"
                                                onclick="event.preventDefault;document.getElementById('delete-{{ $note->id }}').submit()"><i
                                                    class="fa fa-trash"></i></a>
                                            <form class="" id="delete-{{ $note->id }}'"
                                                action="{{ route('note.destroy', $note->id) }}" method="post">
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
