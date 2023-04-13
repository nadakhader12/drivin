@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'Add New appointment | ' . env('APP_NAME'))

@section('content')

    <h1>Add new appointment</h1>
    @include('admin.errors')
    <form action="{{ route('admin.appointments.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>name</label>
            <input type="text" name="name" placeholder="name" class="form-control">
        </div>

        <div class="mb-3">
            <label>email</label>
            <input type="email" name="email" placeholder="email" class="form-control">
        </div>

        <div class="mb-3">
            <label>coursetype</label>
            <input type="text" name="coursetype" placeholder="coursetype" class="form-control">
        </div>
        <div class="mb-3">
            <label>cartype</label>
            <input type="text" name="cartype" placeholder="cartype" class="form-control">
        </div>
        <div class="mb-3">
            <label>message</label>
            <input type="text" name="message" placeholder="message" class="form-control">
        </div>



        <button class="btn btn-success px-5">Add</button>
    </form>

@stop
