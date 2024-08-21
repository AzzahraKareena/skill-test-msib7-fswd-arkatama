<!-- resources/views/passengers/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Passenger List</h1>
    <a href="{{ route('passengers.create') }}" class="btn btn-primary">Add New Passenger</a>

    @if (session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID_Travel</th>
                <th>Kode Booking</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Kota</th>
                <th>Usia</th>
                <th>Tahun Lahir</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($passengers as $passenger)
                <tr>
                    <td>{{ $passenger->id }}</td>
                    <td>{{ $passenger->id_travel }}</td>
                    <td>{{ $passenger->kode_booking }}</td>
                    <td>{{ $passenger->nama }}</td>
                    <td>{{ $passenger->jenis_kelamin }}</td>
                    <td>{{ $passenger->kota }}</td>
                    <td>{{ $passenger->usia }}</td>
                    <td>{{ $passenger->tahun_lahir }}</td>
                    <td>{{ $passenger->created_at }}</td>
                    <td>
                        <a href="{{ route('passengers.edit', $passenger) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('passengers.destroy', $passenger) }}" method="POST" style="display:inline;">
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
