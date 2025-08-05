@extends('layouts.app')

@section('title', 'Daftar Perbup')

@section('content')
<div class="container">
    <h1>Daftar Perbup</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Tahun</th>
            </tr>
        </thead>
        <tbody>
            @foreach($years as $year)
            <tr>
                <td><a href="{{ route('perbup.year', $year) }}">{{ $year }}</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection