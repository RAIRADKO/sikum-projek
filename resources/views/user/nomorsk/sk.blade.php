@extends('layouts.app')

@section('title', 'Daftar SK')

@section('content')
<div class="container">
    <h1>Daftar SK</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Tahun</th>
            </tr>
        </thead>
        <tbody>
            @foreach($years as $year)
            <tr>
                <td><a href="{{ route('sk.year', $year) }}">{{ $year }}</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection