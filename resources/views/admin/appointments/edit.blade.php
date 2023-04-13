@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'Edit appointment | ' . env('APP_NAME'))

@section('content')

    <h1>Edit appointment</h1>
    @include('admin.errors')
    <form action="{{ route('admin.appointments.update', $appointment->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="mb-3">
            <label>name</label>
            <input type="text" name="name" placeholder="name" class="form-control" value="{{ $appointment->name }}">
        </div>

        <div class="mb-3">
            <label>email</label>
            <input type="email" name="email" placeholder="email" class="form-control" value="{{ $appointment->email }}">
        </div>
        <div class="mb-3">
            <label>coursetype</label>
            <input type="text" name="coursetype" placeholder="coursetype" class="form-control" value="{{ $appointment->coursetype }}">
        </div>
        <div class="mb-3">
            <label>cartype</label>
            <input type="text" name="cartype" placeholder="cartype" class="form-control" value="{{ $appointment->cartype }}">
        </div>
        <div class="mb-3">
            <label>message</label>
            <input type="text" name="message" placeholder="message" class="form-control" value="{{ $appointment->message }}">
        </div>


        <button class="btn btn-success px-5">Update</button>
    </form>

@stop
