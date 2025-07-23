@extends('layouts.app')

@section('title', 'Data Proses Perbup Tahun ' . $year)

@section('content')
<div class="container">
    <h1>Data Proses Perbup Tahun {{ $year }}</h1>
    {{-- Tampilkan data proses Perbup untuk tahun {{ $year }} di sini --}}
</div>
@endsection