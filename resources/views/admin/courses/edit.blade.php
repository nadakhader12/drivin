@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'Edit course | ' . env('APP_NAME'))

@section('content')

    <h1>Edit course</h1>
    @include('admin.errors')
    <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="mb-3">
            <label>price</label>
            <input type="text" name="price" placeholder="price" class="form-control" value="{{ $course->price }}">
        </div>

        <div class="mb-3">
            <label>name</label>
            <input type="text" name="name" placeholder="name" class="form-control" value="{{ $course->name }}">
        </div>

        <div class="mb-3">
            <label>content</label>
            <input type="text" name="content" placeholder="content" class="form-control" value="{{ $course->content }}">
        </div>

        <div class="mb-3">
            <label>time</label>
            <input type="text" name="time" placeholder="time" class="form-control" value="{{ $course->time }}">
        </div>
        <div class="mb-3">
            <label>level</label>
            <input type="text" name="level" placeholder="level" class="form-control" value="{{ $course->level }}">
        </div>
        <div class="mb-3">
            <label>image</label>
            <input type="file" name="image"  class="form-control">
            <img width="80" src="{{ asset('uploads/courses/'.$course->image) }}" alt="">
        </div>

        <div class="mb-3">
            <label>team_id</label>
            <input type="text" name="team_id" placeholder="team_id" class="form-control" value="{{ $course->team_id }}">
        </div>
        <button class="btn btn-success px-5">Update</button>
    </form>

@stop
