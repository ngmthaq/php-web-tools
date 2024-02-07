@extends('layouts.main')

@section('title')
    Product {{ $id }}
@endsection

@section('body')
    <h1>Product {{ $id }}</h1>
@endsection

@push('meta')
    <meta name="description" content="Product {{ $id }}">
@endpush
