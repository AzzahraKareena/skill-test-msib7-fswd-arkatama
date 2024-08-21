<!-- resources/views/passengers/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Passenger</h1>

    <form action="{{ route('passengers.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="passenger_data">Passenger Data</label>
            <input type="text" name="passenger_data" id="passenger_data" class="form-control" placeholder="John Doe 30 Jakarta" required>
        </div>
        <div class="form-group">
            <label for="id_travel">Travel</label>
            <select name="id_travel" id="id_travel" class="form-control" required>
                @foreach($travels as $travel)
                    <option value="{{ $travel->id }}">{{ $travel->id_tanggal_keberangkatan }} - Quota: {{ $travel->kuota }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
