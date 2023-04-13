@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'facts | ' . env('APP_NAME'))

@section('content')

    <h1>All facts</h1>
    @if (session('msg'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('msg') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>id</th>
                <th>title</th>
                <th>content</th>
                <th>icon</th>
                <th>type</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($facts as $fact)
                <td>{{ $fact->id}}</td>
                    <td>{{ $fact->title}}</td>
                    <td>
                        {{ $fact->content }}
                    </td>
                    <td><img width="80" src="{{ asset('uploads/facts/'.$fact->icon) }}" alt=""></td>
                    <td>
                        {{ $fact->type }}
                    </td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.facts.edit', $fact->id) }}"><i class="fas fa-edit"></i></a>
                        <form class="d-inline" action="{{ route('admin.facts.destroy', $fact->id) }}" method="POST">
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
