<!-- resources/views/passengers/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Passenger</h1>

    <form action="{{ route('passengers.update', $passenger) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="passenger_data">Passenger Data</label>
            <input type="text" name="passenger_data" id="passenger_data" class="form-control" value="{{ $passenger->nama }} {{ $passenger->usia }} {{ $passenger->kota }}" required>
        </div>
        <div class="form-group">
            <label for="id_travel">Travel</label>
            <select name="id_travel" id="id_travel" class="form-control" required>
                @foreach($travels as $travel)
                    <option value="{{ $travel->id }}" {{ $travel->id == $passenger->id_travel ? 'selected' : '' }}>
                        {{ $travel->id_tanggal_keberangkatan }} - Quota: {{ $travel->kuota }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
