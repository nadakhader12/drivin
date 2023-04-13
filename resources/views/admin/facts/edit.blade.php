@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'Edit fact | ' . env('APP_NAME'))

@section('content')

    <h1>Edit fact</h1>
    @include('admin.errors')
    <form action="{{ route('admin.facts.update', $fact->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="mb-3">
            <label>title</label>
            <input type="text" name="title" placeholder="title" class="form-control" value="{{ $fact->title }}">
        </div>


        <div class="mb-3">
            <label>content</label>
            <input type="text" name="content" placeholder="content" class="form-control" value="{{ $fact->content }}">
        </div>

        <div class="mb-3">
            <label>Icon</label>
            <input type="file" name="icon"  class="form-control">
            <img width="80" src="{{ asset('uploads/facts/'.$fact->icon) }}" alt="">
        </div>

        <div class="mb-3">
            <label>type</label>
            <select name="type" class="form-control" >

                <option value="features">features</option>
                <option value="facts">facts</option>

            </select>
        </div>
        <button class="btn btn-success px-5">Update</button>
    </form>

@stop
