@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'courses | ' . env('APP_NAME'))

@section('content')

    <h1>All courses</h1>
    @if (session('msg'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('msg') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>id</th>
                <th>price</th>
                <th>name</th>
                <th>content</th>
                <th>time</th>
                <th>level</th>
                <th>image</th>
                <th>team_id</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($courses as $course)
                <td>{{ $course->id}}</td>
                    <td>{{ $course->price}}</td>
                    <td>{{ $course->name}}</td>
                    <td>
                        {{ $course->content }}
                    </td>
                    <td>{{ $course->time}}</td>
                    <td>{{ $course->level}}</td>
                    <td><img width="80" src="{{ asset('uploads/courses/'.$course->image) }}" alt=""></td>
                    <td>
                        {{ $course->team_id }}
                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.courses.edit', $course->id) }}"><i class="fas fa-edit"></i></a>
                        <form class="d-inline" action="{{ route('admin.courses.destroy', $course->id) }}" method="POST">
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
