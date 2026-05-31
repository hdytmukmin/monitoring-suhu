@extends('admin.layouts.app')

@section('title', 'Edit Device')
@section('page-title', 'Edit Device')
@section('page-eyebrow', 'Master Data')

@section('content')
    @include('admin.devices.partials.form', [
        'title' => 'Form Edit Device',
        'description' => 'Perbarui data device. Token lama tidak ditampilkan demi keamanan.',
        'action' => route('admin.devices.update', $device),
        'method' => 'PUT',
    ])
@endsection
