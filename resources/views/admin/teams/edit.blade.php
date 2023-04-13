@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'Edit team | ' . env('APP_NAME'))

@section('content')

    <h1>Edit team</h1>
    @include('admin.errors')
    <form action="{{ route('admin.teams.update', $team->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="mb-3">
            <label>image</label>
            <input type="file" name="image"  class="form-control">
            <img width="80" src="{{ asset('uploads/teams/'.$team->image) }}" alt="">
        </div>
        <div class="mb-3">
            <label>name</label>
            <input type="text" name="name" placeholder="name" class="form-control" value="{{ $team->name }}">
        </div>


        <button class="btn btn-success px-5">Update</button>
    </form>

@stop
