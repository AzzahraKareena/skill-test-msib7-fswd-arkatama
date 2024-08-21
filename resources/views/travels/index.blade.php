<!-- resources/views/travels/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Travel List</h1>
    <a href="{{ route('travels.create') }}" class="btn btn-primary">Add New Travel</a>

    @if (session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Kuota</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($travels as $travel)
                <tr>
                    <td>{{ $travel->id }}</td>
                    <td>{{ $travel->id_tanggal_keberangkatan }}</td>
                    <td>{{ $travel->kuota }}</td>
                    <td>
                        <a href="{{ route('travels.edit', $travel) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('travels.destroy', $travel) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
