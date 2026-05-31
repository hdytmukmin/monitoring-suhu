@extends('admin.layouts.app')

@section('title', 'Tambah Ruangan')
@section('page-title', 'Tambah Ruangan')
@section('page-eyebrow', 'Master Data')

@section('content')
    @include('admin.rooms.partials.form', [
        'title' => 'Form Tambah Ruangan',
        'description' => 'Isi data ruangan dan ambang batas suhu yang akan dipakai sistem monitoring.',
        'action' => route('admin.rooms.store'),
        'method' => 'POST',
    ])
@endsection
