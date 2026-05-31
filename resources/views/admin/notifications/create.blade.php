@extends('admin.layouts.app')

@section('title', 'Tambah Notifikasi')
@section('page-title', 'Tambah Notifikasi')
@section('page-eyebrow', 'Monitoring')

@section('content')
    @include('admin.notifications.partials.form', [
        'title' => 'Form Tambah Channel',
        'description' => 'Tampilan form disiapkan dulu. Proses simpan credential dan recipient akan kita sambungkan pada tahap CRUD.',
    ])
@endsection
