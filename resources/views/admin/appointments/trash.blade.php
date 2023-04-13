@extends('admin.master')

@php
    $name = 'name_'.app()->currentLocale();
@endphp

@section('title', 'Trashed appointments | ' . env('APP_NAME'))

@section('content')

    <h1>All Trashed appointments</h1>
    @if (session('msg'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('msg') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
                <tr>
                    <th>name</th>
                    <th>email</th>
                    <th>coursetype</th>
                    <th>cartype</th>
                    <th>message</th>
                </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($appointments as $appointment)
                <td>{{ $appointment->id}}</td>
                <td>{{ $appointment->name}}</td>
                <td>
                    {{ $appointment->email }}
                </td>
                <td>
                    {{ $appointment->coursetype }}
                </td>
                <td>
                    {{ $appointment->cartype }}
                </td>
                <td>
                    {{ $appointment->message }}
                </td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.appointments.restore', $appointment->id) }}"><i class="fas fa-undo"></i></a>
                        <form class="d-inline" action="{{ route('admin.appointments.forcedelete', $appointment->id) }}" method="POST">
                            @csrf
                            @method('delete')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure')"><i class="fas fa-times"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@stop
