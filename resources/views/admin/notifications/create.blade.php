@extends('admin.layouts.app')

@section('title', 'Tambah Notifikasi')
@section('page-title', 'Tambah Notifikasi')
@section('page-eyebrow', 'Monitoring')

@section('content')
    @include('admin.notifications.partials.form', [
        'title' => 'Form Tambah Channel',
        'description' => 'Tambahkan channel tujuan alert suhu. Credential provider tetap disimpan di environment.',
        'action' => route('admin.notifications.store'),
        'method' => 'POST',
    ])
@endsection
