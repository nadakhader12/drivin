@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'Add New fact | ' . env('APP_NAME'))

@section('content')

    <h1>Add new fact</h1>
    @include('admin.errors')
    <form action="{{ route('admin.facts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" placeholder="title" class="form-control">
        </div>

        <div class="mb-3">
            <label>content</label>
            <input type="text" name="content" placeholder="content" class="form-control">
        </div>



        <div class="mb-3">
            <label>icon</label>
            <input type="file" name="icon"  class="form-control">
        </div>
        <div class="mb-3">
            <label>type</label>
            <select name="type" class="form-control">

                <option value="features">features</option>
                <option value="facts">facts</option>

            </select>
        </div>


        <button class="btn btn-success px-5">Add</button>
    </form>

@stop
