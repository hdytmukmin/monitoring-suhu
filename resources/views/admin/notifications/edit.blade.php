@extends('admin.layouts.app')

@section('title', 'Edit Notifikasi')
@section('page-title', 'Edit Notifikasi')
@section('page-eyebrow', 'Monitoring')

@section('content')
    @include('admin.notifications.partials.form', [
        'title' => 'Form Edit Channel',
        'description' => 'Tampilan edit disiapkan dulu. Credential provider tetap diatur lewat environment/config.',
        'action' => route('admin.notifications.update', $notificationSetting),
        'method' => 'PUT',
    ])
@endsection
