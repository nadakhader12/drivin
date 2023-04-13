@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'Add New course | ' . env('APP_NAME'))

@section('content')

    <h1>Add new course</h1>
    @include('admin.errors')
    <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>price</label>
            <input type="text" name="price" placeholder="price" class="form-control">
        </div>

        <div class="mb-3">
            <label>name</label>
            <input type="text" name="name" placeholder="name" class="form-control">
        </div>


        <div class="mb-3">
            <label>content</label>
            <input type="text" name="content" placeholder="content" class="form-control">
        </div>

        <div class="mb-3">
            <label>time</label>
            <input type="text" name="time" placeholder="time" class="form-control">
        </div>

        <div class="mb-3">
            <label>level</label>
            <input type="text" name="level" placeholder="level" class="form-control">
        </div>


        <div class="mb-3">
            <label>image</label>
            <input type="file" name="image"  class="form-control">
        </div>
        <div class="mb-3">
            <label>team_id</label>
            <input type="text" name="team_id" placeholder="team_id" class="form-control">
        </div>

        <button class="btn btn-success px-5">Add</button>
    </form>

@stop
