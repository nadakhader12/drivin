@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'Add New team | ' . env('APP_NAME'))

@section('content')

    <h1>Add new team</h1>
    @include('admin.errors')
    <form action="{{ route('admin.teams.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label>name</label>
            <input type="text" name="name" placeholder="name" class="form-control">
        </div>



        <button class="btn btn-success px-5">Add</button>
    </form>

@stop
