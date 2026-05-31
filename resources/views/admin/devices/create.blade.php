@extends('admin.layouts.app')

@section('title', 'Tambah Device')
@section('page-title', 'Tambah Device')
@section('page-eyebrow', 'Master Data')

@section('content')
    @include('admin.devices.partials.form', [
        'title' => 'Form Tambah Device',
        'description' => 'Isi data device. Token API akan dibuat otomatis setelah device disimpan.',
        'action' => route('admin.devices.store'),
        'method' => 'POST',
    ])
@endsection
