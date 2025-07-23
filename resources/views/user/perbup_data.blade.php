@extends('layouts.app')

@section('title', 'Data Perbup Tahun ' . $year)

@section('content')
<div class="container">
    <h1>Data Perbup Tahun {{ $year }}</h1>
    {{-- Tampilkan data Perbup untuk tahun {{ $year }} di sini --}}
</div>
@endsection