@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'Trashed teams | ' . env('APP_NAME'))

@section('content')

    <h1>All Trashed teams</h1>
    @if (session('msg'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('msg') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>id</th>
                <th>image</th>
                <th>name</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($teams as $team)
                    <td>{{ $team->id }}</td>
                    <td><img width="80" src="{{ asset('uploads/teams/'.$team->image) }}" alt=""></td>
                    <td>
                        {{ $team->name }}
                    </td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.teams.restore', $team->id) }}"><i class="fas fa-undo"></i></a>
                        <form class="d-inline" action="{{ route('admin.teams.forcedelete', $team->id) }}" method="POST">
                            @csrf
                            @method('delete')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure')"><i class="fas fa-times"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@stop
