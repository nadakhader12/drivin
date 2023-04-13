@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'teams | ' . env('APP_NAME'))

@section('content')

    <h1>All teams</h1>
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
                <td>{{ $team->id}}</td>
                    <td><img width="80" src="{{ asset('uploads/teams/'.$team->image) }}" alt=""></td>
                    <td>
                        {{ $team->name }}
                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.teams.edit', $team->id) }}"><i class="fas fa-edit"></i></a>
                        <form class="d-inline" action="{{ route('admin.teams.destroy', $team->id) }}" method="POST">
                            @csrf
                            @method('delete')
                        <button class="btn btn-danger" onclick="return confirm('Are you sure')"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@stop
