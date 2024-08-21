<!-- resources/views/travels/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Travel</h1>

    <form action="{{ route('travels.update', $travel) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="id_tanggal_keberangkatan">Date</label>
            <input type="date" name="id_tanggal_keberangkatan" id="id_tanggal_keberangkatan" class="form-control" value="{{ $travel->id_tanggal_keberangkatan }}" required>
        </div>
        <div class="form-group">
            <label for="kuota">Quota</label>
            <input type="number" name="kuota" id="kuota" class="form-control" value="{{ $travel->kuota }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
