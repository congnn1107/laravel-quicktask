@extends('layouts.app')
@section('title', 'Quicktask - Home')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('pages.welcome') }}
                    </div>
                </div>

                @if (Auth::user()->is_admin)
                    @php
                        $users->load('notes');
                    @endphp
                    <div class="card mt-4">
                        <div class="card-header">
                            <h1 class="h4 card-title text-success">{{ __('pages.home_list') }}</h1>
                        </div>
                        <div class="card-body">
                            <div class="accordion" id="accordion">
                                @foreach ($users as $key => $user)
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link btn-block text-left" type="button"
                                                    data-toggle="collapse" data-target="#collapse{{ $key }}"
                                                    aria-expanded="true" aria-controls="collapse{{ $key }}">
                                                    {{ $user->full_name }}
                                                </button>
                                            </h2>
                                        </div>

                                        <div id="collapse{{ $key }}" class="collapse"
                                            aria-labelledby="heading{{ $key }}" data-parent="#accordion">
                                            <div class="card-body table-full-width table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <th>{{ __('pages.title') }}</th>
                                                        <th>{{ __('pages.created_at') }}</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($user->notes as $note)
                                                            <tr>
                                                                <td><a
                                                                        href="{{ route('note.show', $note->id) }}">{{ $note->title }}</a>
                                                                </td>
                                                                <td>{{ $note->created_at }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="card card-plain">
                                    <div class="card-body">
                                        {!! $users->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
