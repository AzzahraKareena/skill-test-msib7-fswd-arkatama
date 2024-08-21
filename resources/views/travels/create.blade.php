<!-- resources/views/travels/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Travel</h1>

    <form action="{{ route('travels.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_tanggal_keberangkatan">Tanggal</label>
            <input type="date" name="id_tanggal_keberangkatan" id="id_tanggal_keberangkatan" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="kuota">Kuota</label>
            <input type="number" name="kuota" id="kuota" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
