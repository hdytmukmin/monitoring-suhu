@extends('admin.layouts.app')

@section('title', 'Edit Ruangan')
@section('page-title', 'Edit Ruangan')
@section('page-eyebrow', 'Master Data')

@section('content')
    @include('admin.rooms.partials.form', [
        'title' => 'Form Edit Ruangan',
        'description' => 'Perbarui data ruangan dan batas suhu. Perubahan threshold akan memengaruhi pembacaan sensor berikutnya.',
        'action' => route('admin.rooms.update', $room),
        'method' => 'PUT',
    ])
@endsection
