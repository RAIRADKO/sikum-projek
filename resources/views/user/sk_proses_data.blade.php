@extends('layouts.app')

@section('title', 'Data Proses SK Tahun ' . $year)

@section('content')
<div class="container">
    <h1>Data Proses SK Tahun {{ $year }}</h1>
    {{-- Tampilkan data proses SK untuk tahun {{ $year }} di sini --}}
</div>
@endsection