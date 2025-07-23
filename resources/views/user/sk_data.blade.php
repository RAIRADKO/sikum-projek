@extends('layouts.app')

@section('title', 'Data SK Tahun ' . $year)

@section('content')
<div class="container">
    <h1>Data SK Tahun {{ $year }}</h1>
    {{-- Tampilkan data SK untuk tahun {{ $year }} di sini --}}
</div>
@endsection